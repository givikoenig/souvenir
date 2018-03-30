<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Product;
use Cart;

class DelFromCartController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $validator = Validator::make($data,[
           'prodid' => 'integer|required',
        ]);
        if($validator->fails()) {
            return \Response::json(['error'=> $validator->errors()->first()]);
        }
        
       Cart::instance('shopping')->remove($data["rowid"]);
       $result = array(); 
       $result['total'] = Cart::instance('shopping')->total();
       $result['count'] = Cart::instance('shopping')->count();
       $result['content'] = Cart::instance('shopping')->content();
       
        return \Response::json(['success' => TRUE, 'data' => $result]);
    }

}
