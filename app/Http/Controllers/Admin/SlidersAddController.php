<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Image;
use Validator;
use App\Slider;
use App\Brand;

class SlidersAddController extends Controller
{
    //
    protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }

    public function execute(Request $request) {

    	$permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
    	if ($permit) {

    		if ($request->isMethod('post')) {

        		$input = $request->except('_token');

        		$ext = 'jpg';
                if($request->images) {
                    $ext = explode('.',$request->images->getClientOriginalName() )[1];
                }

                $messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
        			'max' => 'Поле :attribute должно быть не более :max символов',
        		];

        		$validator = Validator::make($input,[
                        'images' => 'required',
                        'price_text' => 'max:255',
                        'h1_text' => 'max:255',
                        'h2_text' => 'max:255',
                        'button_text' => 'max:100'
                    ], $messages);

        		if ($validator->fails()) {
        			return redirect()->route('slidersAdd')->withErrors($validator)->withInput();
        		}

        		if($request->hasFile('images')) {
                  $file = $request->file('images');
                  if ($file->isValid()) {
                    $str = str_random(8);
                    $imgname = $str.'.'.$ext;
                    $img = Image::make($file);
                    $img->fit(Config::get('settings.slide_image')['width'],
                        Config::get('settings.slide_image')['height'])->save(public_path().'/assets/img/slider/slider-2/'.$imgname);
                    $input['images'] = $imgname;
                    }
                }
                
                $slider = new Slider;

                $slider->fill($input);

                if ($slider->save()) {
                    return redirect('admin/sliders')->with('status','Слайд добавлен');
                }

        	}

	    	if (view()->exists('admin.sliders_add')) {

	    		$brands = Brand::with('sliders')->get();
	    		$cats = array();
		    	foreach ($brands as $brand) {
		    		$item = array('id'=>$brand->id, 'name'=>$brand->name);
		    		array_push($cats, $item);
		    	}
	            $data = [
	                'title' => 'Новый слайд',
	                'cats' => $cats,
                    'ords_new' => $ords_new,
	            ];
	            return view('admin.sliders_add',$data);
	        }
	        abort(404);

	    }
	    return redirect('profile');
    }
}
