<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Product;
use Cart;

class AddToWishlistController extends Controller
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
        $result['available'] = $product->available;
        $result['image'] = json_decode($product->images,true)['min'];
        $result['count'] = 0;

        $wishlist_content = Cart::instance('wishlist')->content();

        $result['inlist'] = "no";
        foreach ($wishlist_content as $value) {
          if ($value->id == $product->id) {
              $result['inlist'] = "yes";
          }
        }

        if($result['inlist'] == "no") {
            Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price);
            $result['count'] = Cart::instance('wishlist')->count();
        }

        return \Response::json(['success' => TRUE, 'data' => $result]);
    }

}
