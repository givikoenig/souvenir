<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Repositories\PblRepository;

use Config;
use Image;
use Validator;
use App\Banner;
use App\Product;

class BannersAddController extends Controller
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
            
            // $nums = array(3,2,1);
            $manqued = false;
            for ($i=3; $i >= 1 ; $i--) { 
                $banner = Banner::where('position', $i)->first();
                if ( !is_object($banner) ) {
                    $manqued = $i;
                }
            }

    		if ($request->isMethod('post')) {

        		$input = $request->except('_token');

                if (isset($input['prod_id'])) {
                    $dta = [
                    'prod_id' => $input['prod_id'],
                    'manqued' => $manqued,
                     ];
                    return view('admin.banners_add', $dta);
                }

        		$ext = 'jpg';
                if($request->images) {
                    $ext = explode('.',$request->images->getClientOriginalName() )[1];
                }

                $messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
        		];

                    $validator = Validator::make($input,[
                        'images' => 'required',

                    ], $messages);

        		if ($validator->fails()) {
        			return redirect()->route('bannersAdd')->withErrors($validator)->withInput();
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
                
                $banner = new Banner;

                $banner->fill($input);

                if ($banner->save()) {
                    return redirect('admin/banners')->with('status','Баннер добавлен');
                }

        	}

    		if (view()->exists('admin.banners_add')) {
    			$data = [
		                'title' => 'Новый баннер',
                        'manqued' => $manqued,
		                'ords_new' => $ords_new,
		            ];
		            return view('admin.banners_add',$data);
    		}
    		abort(404);
    	}
	    return redirect('profile');
     }

}
