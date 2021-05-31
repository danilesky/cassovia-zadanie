<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Listing;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use PDF;

class OrderController extends Controller
{
    public function create(Request $request){
        $customer_id = $request->input('customer_id');
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');

        $customer = Customer::findOrFail($customer_id);
        $product= Product::findOrFail($product_id);

        $new_order_id=$customer->order()->first()->id;

        $product_ordered = Listing::where('product_id',$product_id)->where('order_id', $new_order_id)->first();


        if(!$customer->order()->first()){
            $new_order = new Order();
            $new_order->customer_id = $customer_id;
            $new_order->save();

            $new_listing= new Listing();
            $new_listing->qty = $qty;
            $new_listing->product_id = $product->id;
            $new_listing->order_id = $new_order->id;
            $new_listing->save();

            return "objednavka vytvorena";
        }
        else{
            if(!$product_ordered){
                $new_listing= new Listing();
                $new_listing->qty = $qty;
                $new_listing->product_id = $product->id;
                $new_listing->order_id = $new_order_id;
                $new_listing->save();
            }
            else{
                $product_ordered->qty = $product_ordered->qty + $qty;
                $product_ordered->save();
            }

            return "objednavka aktulizovana";
        }

    }

    public function get(Request $request){
        $customer_name = $request->input('customer_name');
        $from = $request->input('date_from');
        $to = $request->input('date_to');

        $filtered_orders = (array)[];

        if($customer_name){
            $customers= Customer::where('name','like', '%' . $customer_name . '%')->get();
            foreach($customers as $customer){
                $filtered_orders[]= $customer->order()->with('customer','products')->first();
            }

            return $filtered_orders;
        }
        else if($from && $to){
            $orders = Order::where(function ($query) use ($from , $to) {
                $query->where('updated_at', '<=', $to);
                $query->where('updated_at', '>=', $from);
            })->get();
            foreach($orders as $order){
                $filtered_orders[]= $order->with('customer','products')->first();
            }
            return $filtered_orders;
        }
    }

    public function pdf($id){

        $order = Order::findOrFail($id);
        $customer = $order->customer()->get()->first();
        $listings = $order->products()->get();

        $products[]=(array)[];

        foreach($listings as $listing){
            $products[] = $listing->first()->with('customer','products')->get()->first();
        }

        $total = 0;

        foreach($products as $product){
            $total = $total + ($product->qty * $product->product->price);
        }

        $pdf= PDF::loadView('pdf',[
            'customer' => $customer,
            'products' => $products,
            'total' => $total
        ]);

        
        
        return $pdf->download('order.pdf');
    }
}
