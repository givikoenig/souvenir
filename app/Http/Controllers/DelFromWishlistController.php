<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Product;
use Cart;

class DelFromWishlistController extends Controller
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
           'wlprodid' => 'integer|required',
        ]);
        if($validator->fails()) {
            return \Response::json(['error'=> $validator->errors()->first()]);
        }
        
       Cart::instance('wishlist')->remove($data["wlrowid"]);
       
        return \Response::json(['success' => TRUE]);

    }

}
