<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Repositories\MenusRepository;

use Config;
use App\Brand;
use App\Subbrand;
use App\Product;

class ProductsController extends Controller
{

    protected $m_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $company;

    public function __construct(MenusRepository $m_rep) {
        $this->m_rep = $m_rep;
    }

	public function execute(Request $request) {
		$this->title = 'Магазин';
        $this->meta_desc = 'Магазин';
        $this->keywords = 'Магазин';
        $this->company = 'Souvenir Co.';

        $brand_name = Brand::where('alias',$request->route()->alias)->first();
        $subbrand_name = Subbrand::where('alias',$request->route()->subalias)->first();
        if (!is_null($request->route()->alias)) {
        	is_object($brand_name) ? $this->title = $brand_name->name : $this->title = FALSE;
	        is_object($brand_name) ? $this->meta_desc = $brand_name->name : $this->meta_desc = FALSE;
	        is_object($brand_name) ? $this->keywords = $brand_name->name : $this->keywords = FALSE;
        }
        if ( (!is_null($request->route()->subalias)) && is_object($brand_name) && ($request->route()->alias == $brand_name->alias) ) {
        	is_object($subbrand_name) ? $this->title = $brand_name->name . ' - ' . $subbrand_name->name : $this->title = FALSE;
	        is_object($subbrand_name) ? $this->meta_desc = $brand_name->name . ', ' . $subbrand_name->name : $this->title = FALSE;
	        is_object($subbrand_name) ? $this->keywords = $brand_name->name . ', ' . $subbrand_name->name : $this->title = FALSE;
        }

	    //For widgets
	    $new_products = Product::where('new','1')->take(5)->orderBy('created_at','desc')->get();

	    // main products collection
	    $keyword = Input::get('keyword');
	    if ($keyword) {
	    	$products = Product::SearchByKeyword($keyword)->sortable()->paginate(Config::get('settings.products_pages_count'));
	    } else {
	     	$products = $this->getProductSubbrands($request);
	    }

	    if(view()->exists('site.products')) {
	    	$data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);

	    	return view('site.products', $data, [
                'products' => $products,
                'new_products' => $new_products,
	        ]);
	    }
	    abort(404);

	}

	public function getProductSubbrands($request) {

		$products = array();
		$page_alias = $request->route()->alias;
		$page_subalias = $request->route()->subalias;

		if ( is_null($request->segment(2)) && is_null($request->segment(3)) ) {
			$brandid = false;
			$subbrandid = false;
			$subbrands_collection = array();
			$subbrands_array = array();
			$products = Product::sortable()->paginate(Config::get('settings.products_pages_count'));

		} elseif ( !is_null($request->segment(2)) && is_null($request->segment(3)) ) {
			$brandpage = Brand::where('alias',$request->segment(2))->first();
			if (is_object($brandpage) && $page_alias == $brandpage->alias) {
				$brandid = $brandpage->id;
				$subbrandid = false;
				$subbrands_collection = Subbrand::where('brand_id', $brandid)->get();
				$subbrands_array = array();
				foreach ($subbrands_collection as $subbrand_model) {
			     	$tmp = $subbrand_model->id;
			     	array_push($subbrands_array, $tmp);
			    }
				$products = Product::whereIn('subbrand_id', $subbrands_array)->sortable()->paginate(Config::get('settings.products_pages_count'));
			} else {
				abort(404);
			}

		} elseif ( !is_null($request->segment(2)) && !is_null($request->segment(3)) ) {
			$brandpage = Brand::where('alias',$request->segment(2))->first();
			$subbrandpage = Subbrand::where('alias',$request->segment(3))->first();
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
				$products = Product::whereIn('subbrand_id', $subbrands_array)->sortable()->paginate(Config::get('settings.products_pages_count'));
			} else {
				abort(404);
			}
		}

		return $products;

	}

}
