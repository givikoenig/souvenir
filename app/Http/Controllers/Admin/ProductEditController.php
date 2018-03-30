<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use Illuminate\Support\Facades\Input;

use Validator;
use Config;
use Image;

use App\Product;
use App\Brand;

class ProductEditController extends Controller
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

			$product = Product::find($request->segment(4));

			if ($request->isMethod('delete')) {

				$input = $request->except('_token');
				$product->banner()->delete();
				$product->upcomming()->delete();
				$product->delete();

				return redirect('admin/prods')->with('status','Товар удален');
			}

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

				if ($validator->fails()) {
					return redirect()
					->route('prodEdit',['product'=>$input['id']])
					->withErrors($validator);
				}

				if ($request->hasFile('images')) {

					$image = $request->file('images');

					if ($image->isValid()) {

						$str = str_random(8);
						$obj = new \stdClass;

						// $obj->mic = $str.'_mic.'.$ext;
						$obj->min = $str.'_min.'.$ext;
						$obj->med = $str.'_med.'.$ext;
						$obj->max = $str.'_max.'.$ext;

						$img = Image::make($image);

						// $img->fit(Config::get('settings.product_img')['mic']['width'],
						// 	Config::get('settings.product_img')['mic']['height'])->save(public_path().'/assets/img/product/'.$obj->mic);
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
					$slcount = count(explode('|',$product->img_slide));
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

							if(!isset($galleryfiles)) {
								if (is_null($product->img_slide) || empty($product->img_slide)) {
									$galleryfiles = "{$imgname}";
								} else {
									$galleryfiles = "{$product->img_slide}|{$imgname}";
								}
							}else{
								$galleryfiles .= "|{$imgname}";
							}
						}
					}
					$input['img_slide']  = $galleryfiles;
				}

				$product->fill($input);
				$url = $request->only('redirects_to');

				if ($product->update()) {
					return redirect('admin/prods')->with('status','Товар обновлен');
				}
				unset($input);

			}

			if (view()->exists('admin.product_edit')) {
				$brands = Brand::with('subbrands')->get();

				$old = $product->toArray();
				$img_slides = explode('|' ,$product['img_slide']);

				$data = [
					'title' => 'Редактирование товара ',
					'data' => $old,
					'brands' => $brands,
					'img_slides' => $img_slides,
					'ords_new' => $ords_new,
				];

				return view('admin.product_edit',$data);
			}
			abort(404);

		}
		return redirect('profile');
	}

	public function delProdSlide(Product $product, Request $request) {
		$product = Product::find($request->segment(4));

		$img_to_del = Input::get('img');

		if ($img_to_del) {
			if (preg_match("/|/", $product->img_slide)) {
				$imgs = explode('|', $product->img_slide);
			} else {
				$imgs = $product->img_slide;
			}

			foreach ($imgs as $item) {
				if ($item == $img_to_del) {
					continue;
				}

				if(!isset($gallerydel)){
					$gallerydel = $item;
				} else {
					$gallerydel .= "|{$item}";
				}

			}
			if(!isset($gallerydel)) {
				$gallerydel = '';
			}

			$inp = $request->except('_token');

			$inp['img_slide']  = $gallerydel;

			$product->fill($inp);

			if ($product->update()) {
				$resp = '<div class="success"><h4 style="padding-top: 50px;">Изображение удалено</h4></div>';
				return \Response::json($resp);
			} 
			unset($inp);

		}

	}
}
