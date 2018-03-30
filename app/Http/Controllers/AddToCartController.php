<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Product;
use Cart;

class AddToCartController extends Controller
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

        $product = Product::where('id', $data['id'])->first();
        $result = array();
        $result['id'] = $product->id;
        $result['name'] = $product->name;
        $result['price'] = $product->price;
        $result['image'] = json_decode($product->images,true)['min'];
        $result['qty'] = $data['qty'];
        $result['one_prod_sum'] = ($result['price'] * $result['qty']);

        $validator = Validator::make($data,[
           'qty' => 'integer|required',
        ]);
        if($validator->fails()) {
            return \Response::json(['error'=> $validator->errors()->first()]);
        }
        
       Cart::instance('shopping')->add($product->id, $product->name, $data['qty'] , $product->price);
       $result['total'] = Cart::instance('shopping')->total();
       $result['count'] = Cart::instance('shopping')->count();
       $result['content'] = Cart::instance('shopping')->content();
       $result['rowid'] = false;
       foreach ($result['content'] as $item) {
           if ($item->id == $result['id']) {
               $result['rowid'] = $item->rowId;
           } else {
                 $result['rowid'] = false;
           }
       }
       
        return \Response::json(['success' => TRUE, 'data' => $result]);
        
    }

}
