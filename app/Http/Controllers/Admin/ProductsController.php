<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use Config;
use App\Brand;
use App\Subbrand;
use App\Product;

class ProductsController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Request $request) {
    	$permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
    	if ($permit) {
    		if ($request->isMethod('post')) {
    			$input = $request->except('_token');

    			if (isset($input['kat_id'])) {
    				$katid = $input['kat_id'];

    				if ( isset( Brand::find($katid)->id ) ) {
    					$obj = 'sub';
    				} else {
    					$obj = 'brand';
    				}
    			}
    		}

    		if (view()->exists('admin.products')) {
	    		$brands = Brand::with('subbrands')->get(); //paginate(1);
                $products_count = Product::all()->count();
                $products = $this->getProductSubbrands($request);
				$data = [
					'title' => 'Products',
					'brands' => $brands,
                    'products' => $products,
                    'products_count' => $products_count,
                    'ords_new' => $ords_new,
				];
					return view('admin.products',$data);
			}
			abort(404);

    	}
    	return redirect('profile');
    }

    public function getProductSubbrands($request) {

        $products = array();
        $page_alias = $request->route()->alias;
        $page_subalias = $request->route()->subalias;

        if ( is_null($request->segment(3)) && is_null($request->segment(4)) ) {
            $brandid = false;
            $subbrandid = false;
            $subbrands_collection = array();
            $subbrands_array = array();
            $products = Product::paginate(Config::get('settings.adm_products_pages_count'));

        } elseif ( !is_null($request->segment(3)) && is_null($request->segment(4)) ) {
            $brandpage = Brand::where('alias',$request->segment(3))->first();
            if (is_object($brandpage) && $page_alias == $brandpage->alias) {
                $brandid = $brandpage->id;
                $subbrandid = false;
                $subbrands_collection = Subbrand::where('brand_id', $brandid)->get();
                $subbrands_array = array();
                foreach ($subbrands_collection as $subbrand_model) {
                    $tmp = $subbrand_model->id;
                    array_push($subbrands_array, $tmp);
                }
                $products = Product::whereIn('subbrand_id', $subbrands_array)->paginate(Config::get('settings.adm_products_pages_count'));
            } else {
                abort(404);
            }

        } elseif ( !is_null($request->segment(3)) && !is_null($request->segment(4)) ) {
            $brandpage = Brand::where('alias',$request->segment(3))->first();
            $subbrandpage = Subbrand::where('alias',$request->segment(4))->first();
            if ( is_object($brandpage) && is_object($subbrandpage) && ($page_alias == $brandpage->alias) && ($page_subalias == $subbrandpage->alias) ) {
                $brandid = $brandpage->id;
                $subbrandid = $subbrandpage->id;
                $subbrands_collection = Subbrand::where([
                        ['id', $subbrandid],
                        ['brand_id', $brandid],
                    ])->get();
                $subbrands_array = array();
                foreach ($subbrands_collection as $subbrand_model) {
                    $tmp = $subbrand_model->id;
                    array_push($subbrands_array, $tmp);
                }
                $products = Product::whereIn('subbrand_id', $subbrands_array)->paginate(Config::get('settings.adm_products_pages_count'));
            } else {
                abort(404);
            }
        }

        return $products;

    }

}
