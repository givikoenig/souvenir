<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Image;
use Validator;
use App\Banner;
use App\Brand;

class BannerEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Banner $banner, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
           
        	if ($request->isMethod('delete')) {
        		$banner->delete();
        		return redirect('admin/banners')->with('status', 'Блок удален');
        	}

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
        			], $messages);

        		if ($validator->fails()) {
        			return redirect()
        			->route('sliderEdit',['slider'=>$input['id']])
        			->withErrors($validator);
        		}

        		if($request->hasFile('images')) {
        			$file = $request->file('images');
        			if ($file->isValid()) {
        				$str = str_random(8);
        				$imgname = $str.'.'.$ext;
        				$img = Image::make($file);
        				$img->fit(Config::get('settings.banner_image')['width'],
        					Config::get('settings.banner_image')['height'])->save(public_path().'/assets/img/banner/'.$imgname);
        				$input['images'] = $imgname;
        			}
        		}
        		$banner->fill($input);

        		if ($banner->update()) {
        			return redirect('admin/banners')->with('status','Баннер обновлен');
        		}
        		unset($input);

        	}

        	
           $old = $banner->toArray();

           $data = [
           'title' => 'Редактирование баннера ',
           'data' => $old,
           'ords_new' => $ords_new,
           ];

           if (view()->exists('admin.banner_edit')) {
            
               return view('admin.banner_edit',$data);
           }
           abort(404);

       }
       return redirect('profile');
   }
}
