<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;

use Config;

use App\Product;
use Cart;

class ProductController extends Controller
{

    protected $m_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $company;

    public function __construct(MenusRepository $m_rep) {
        $this->m_rep = $m_rep;
    }
    //
    public function execute(Request $request, $id) {
        $this->company = 'Souvenir Co.';
    	// widgets
    	$new_products = Product::where('new','1')->take(5)->orderBy('created_at','desc')->get();

        $product = Product::where('id', $id )->first();
        if($product) {
            $this->title = $product->name;
            $this->meta_desc = $product->name;
            $this->keywords = $product->name;
            $slides = explode('|', $product->img_slide);
            $prod_price = $product->price;
            $min_related = ( $prod_price - ($prod_price/100)*( Config::get('settings.related_percent')) );
            $max_related = ( $prod_price + ($prod_price/100)*( Config::get('settings.related_percent')) );
            $related = Product::where([
                    ['subbrand_id', $product->subbrand->id],
                    ['id','<>',$id],
                ])->whereBetween('price', [$min_related , $max_related])
                  ->take(3)->orderBy('created_at','desc')->get();
        } else {
            $this->title = 'Нет такого товара';
            $this->meta_desc = 'Нет такого товара';
            $this->keywords = 'Нет такого товара';
            $slides = false;
            $prod_price = false;
            $min_related = false;
            $max_related = false;
            $related = false;
        }

    	if (view()->exists('site.product')) {
            
            $data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);

    		return view('site.product', $data, [
                'product' => $product,
                'new_products' => $new_products,
                'slides' => $slides,
                'related' => $related,
            ]);
    	}
    	abort(404);

    }
    
}
