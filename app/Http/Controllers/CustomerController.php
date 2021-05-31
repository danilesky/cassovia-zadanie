<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function make_customer(Request $request){

        $messages = [
            'name.required' => 'name required',
            'lastname.required' => 'lastname required',
            'mail.required' => 'mail required',
            'mail.unique' => 'Použivateľ s týmto mailom už existuje',
            'phone.required' => 'phone required',
        ];

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:250'],
            'lastname' => ['required', 'string', 'max:250'],
            'mail' => ['required','unique:customers,email'],
            'phone' => ['required'],
        ], $messages);


        if($validator->fails()){

            $errors = $validator->errors()->all();

            return view('make-customer',[
                "errors"=> $errors,
                "success"=> null
            ]);
        }
        else{

            $new_customer=new Customer();
            
            $new_customer->name = $request->input('name');
            $new_customer->lastname = $request->input('lastname');
            $new_customer->email = $request->input('mail');
            $new_customer->phone = $request->input('phone');
            $new_customer->discount = rand(0, 25);
            $new_customer->last_buy=Carbon::now()->toDateString();

            $new_customer->save();

            return view('make-customer',[
                "success"=> "Zákazník bol vytvorený."
            ]);;
        }
    }
    public function get_customers(Request $request){

        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $date= $request->input('date');

        $filtered_customer= Customer::where('name', 'like', '%' . $name . '%')->orWhere('lastname', 'like', '%' . $lastname . '%')->where('last_buy', '=', $date)->get();


        return json_decode($filtered_customer);
    }
}
