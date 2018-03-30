<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Product;
use Cart;

class AddToCompareController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $product = Product::where('id', $data['id'])->first();
        $result = array();
        $result['id'] = $product->id;
        $result['name'] = $product->name;
        $result['price'] = $product->price;
        $result['available'] = $product->available;
        $result['count'] = 0;

        $compare_content = Cart::instance('compare')->content();

        $result['inlist'] = "no";
        foreach ($compare_content as $value) {
          if ($value->id == $product->id) {
              $result['inlist'] = "yes";
          }
        }

        if($result['inlist'] == "no") {
            Cart::instance('compare')->add($product->id, $product->name, 1, $product->price);
            $result['count'] = Cart::instance('compare')->count();
           
        }

        return \Response::json(['success' => TRUE, 'data' => $result]);
    }
   
}
