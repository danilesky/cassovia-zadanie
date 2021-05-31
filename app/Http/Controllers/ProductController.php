<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request){

        $name = $request->input('name');
        $img = $request->input('img');
        $price = $request->input('price');

        $messages = [
            'name.required' => 'name required',
            'price.required' => 'price required',
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:250'],
            'price' => ['required','integer'],
        ], $messages);


        //making unique serial number for each product
        $chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $code = '';
        $max = count($chars)-1;
        for($i=0;$i<20;$i++){
            $code .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
        }
        //////////////////////

        if($validator->fails()){

            $errors = $validator->errors()->all();
            return $errors;
        }
        else{

            $new_product = new Product();

            $new_product->name = $name;
            if($img){
                $new_product->img = $img;
            }
            $new_product->price = $price;
            $new_product->code = $code;

            $new_product->save();

            return "Produkt bol úspešne vytvorený";

        }
        

    }

    public function get(Request $request){
        $code = $request->input('code');
        $from = $request->input('from');
        $to = $request->input('to');

        $filtered_product=Product::where('code', $code)->orWhere(function($query) use($from,$to){
            $query->where('price','>=', $from);
            $query->where('price','<=', $to);
        })->get();

        return $filtered_product;
    }

    public function update(Request $request){

        $product_id = $request->input('id');
        $product=Product::findOrFail($product_id);

        $name= $request->input('name');
        $price= $request->input('price');
        $img= $request->input('img');

        if($name){
            $product->name=$name;
        }
        if($price){
            $product->price = $price;
        }
        if($img){
            $product->img = $img;
        }

        $product->save();
        
        return "Tvoj produkt bol aktulizovaný.";
    }

    public function delete(Request $request){
        $product_id = $request->input('id');

        $product = Product::findOrFail($product_id);

        $product->delete();

        return "Produkt bol zmazaný.";
    }
}
