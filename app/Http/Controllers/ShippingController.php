<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Cart;

class ShippingController extends Controller
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

        if (empty($data['address'])) {
            $valid_array = [
            'region' => 'required',
            ];
        } else {
            $valid_array = [];
        }

        $validator = Validator::make($data, $valid_array );
        if($validator->fails()) {
            return \Response::json(['error'=> $validator->errors()->first()]);
        }

        $result = array();

        if (mb_stristr($data['address'], 'обл. московская' )  || mb_stristr($data['address'], 'г. москва' ) ) {
            $shipping = 0;
        } else {
            $shipping = 250;
        }

        $total = Cart::instance('shopping')->total();
        $result['total'] = $total;
        $result['shipping'] = $shipping;
        $result['itogo'] = $total + $shipping;
        $result['address'] = $data['address'];
        $result['prim'] = $data['prim'];

        return \Response::json(['success' => TRUE, 'data' => $result]);
    }

    
}
