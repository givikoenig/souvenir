<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Validator;
use Image;
use Config;
use App\Subbrand;
use App\Brand;
use App\Product;

class ProductsAddController extends Controller
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

				if (!isset($input['visible'])) {
					$input['visible'] = '0';
				}
				if (!isset($input['available'])) {
					$input['available'] = '0';
				}
				if (!isset($input['sale'])) {
					$input['sale'] = '0';
				}
				if (!isset($input['new'])) {
					$input['new'] = '0';
				}
				if (!isset($input['hits'])) {
					$input['hits'] = '0';
				}
				if (!isset($input['spec'])) {
					$input['spec'] = '0';
				}

				$subbrand_id = $input['subbrand_id'];
				$brand_id = Subbrand::find($subbrand_id)->brand->id;

				$ext = 'jpg';
	            if($request->images) {
	                $ext = explode('.',$request->images->getClientOriginalName() )[1];
	            }

				$messages = [
	    			'required' => 'Поле :attribute обязательно к заполнению',
	    			'max' => 'Поле :attribute должно быть не более :max символов',
	    		];

	    		$validator = Validator::make($input,[
	                    'name' => 'required|max:255',
	                    'anons' => 'required',
	                    'subbrand_id' => 'required'
	                ], $messages);

	    		$url = $request->only('redirects_to');
	    		if ($validator->fails()) {
	    			return redirect()->route('productsAdd', [$brand_id, $subbrand_id] )->withErrors($validator)->withInput();
	    		}

	    		if ($request->hasFile('images')) {

    				$image = $request->file('images');

    				if ($image->isValid()) {

	    				$str = str_random(6);
						$obj = new \stdClass;

						$obj->min = $str.'_min.'.$ext;
						$obj->med = $str.'_med.'.$ext;
						$obj->max = $str.'_max.'.$ext;

						$img = Image::make($image);
						
						
						$img->fit(Config::get('settings.product_img')['min']['width'],
							Config::get('settings.product_img')['min']['height'])->save(public_path().'/assets/img/product/'.$obj->min);
						$img->fit(Config::get('settings.product_img')['med']['width'],
							Config::get('settings.product_img')['med']['height'])->save(public_path().'/assets/img/product/'.$obj->med);
						$img->fit(Config::get('settings.product_img')['max']['width'],
							Config::get('settings.product_img')['max']['height'])->save(public_path().'/assets/img/product/'.$obj->max);

						$input['images'] = json_encode($obj);

	    			}

    			}

    			if ($request->hasFile('galleryimg')) {

	                $files = $request->file('galleryimg');
	                
	                foreach ($files as $k => $file) {
	                    $slext = 'jpg';
	                    if($request->galleryimg[$k]) {
	                        $slext = explode('.',$request->galleryimg[$k]->getClientOriginalName() )[1];
	                    }

	                    if ($file->isValid()) {
	                        $str = str_random(6);
	                        $imgname = $str.'_'.$k.'.'.$slext;
	                        $img = Image::make($file);
	                        $img->fit(Config::get('settings.product_slide_image')['width'],
	                    Config::get('settings.product_slide_image')['height'])->save(public_path().'/assets/img/product/slides/'.$imgname);

	                        $input['img_slide'] = $imgname;

	                        if( !isset($galleryfiles) ){
	                            $galleryfiles = $imgname;
	                        }else{
	                            $galleryfiles .= "|{$imgname}";
	                        }

	                    }

	                }

	                $input['img_slide']  = $galleryfiles;
	            }

	            $product = new Product();
	    		$product->fill($input);

	    		if ($product->save()) {
	    			return redirect()->to($url['redirects_to'])->with('status','Товар добавлен');
	    		}
	    		unset($input);

			}

    		if (view()->exists('admin.products_add')) {

    			$brandid = 0;
    			if ($request->route('brandid')) {
    				$brandid = $request->route('brandid');
    			}
    			$subbrandid = 0;
    			if ($request->route('subbrandid')) {
    				$subbrandid = $request->route('subbrandid');
    			}

    			$brands = Brand::with('subbrands')->get();
	    		$data = [
	                'title' => 'Новый товар',
	                'brands' => $brands,
	                'brandid' => $brandid,
	                'subbrandid' => $subbrandid,
	                'ords_new' => $ords_new,
	            ];
		        return view('admin.products_add',$data);
		        
	        }
	        abort(404);

    	}
    	return redirect('profile');
    }
}
