<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Repositories\PblRepository;

use Config;
use Image;
use Validator;
use App\Upcomming;
use App\Banner;
use App\Product;
use App\Category;
use App\Mitem;
use App\Page;
use Carbon\Carbon;

class UpcommingsAddController extends Controller
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

                $mitems = Mitem::with('pages')->get();
                $categories = Category::where('parent_id','<>', 0)->with('articles')->get();

        		$input = $request->except('_token');

                if (isset($input['prod_id'])) {
                    $dta = [
                     'prod_id' => $input['prod_id'],
                     'mitems' => $mitems,
                     'categories' => $categories
                      ];
                    return view('admin.upcommings_add', $dta);
                }

                if (isset($input['until_date'])) {
                    $until_date = Carbon::createFromFormat('m/d/Y', $input['until_date'])->format('Y-m-d');
                    $input['until_date'] = $until_date;
                }
                $link = FALSE;
                if (isset($input['link1'])) {
                    $link = $input['link1'];
                }
                if (isset($input['link2'])) {
                    $link = $input['link2'];
                }
                if (isset($input['link3'])) {
                    $link = $input['link3'];
                }
                $input['link'] = $link;

                if (!isset($input['product_id'])) {
                    $input['product_id'] = Product::first()->id;
                }

        		$ext = 'jpg';
                if($request->banner_image) {
                    $ext = explode('.',$request->banner_image->getClientOriginalName())[1];
                }

                $upext = 'jpg';
                if($request->img_362x350) {
                    $upext = explode('.',$request->img_362x350->getClientOriginalName())[1];
                }

                $messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
                    'max' => 'Поле :attribute должно быть не более :max символов',
        		];

        		$validator = Validator::make($input,[
                        'banner_image' => 'required',
                        'title' => 'max:100',
                    ], $messages);

        		if ($validator->fails()) {
        			return redirect()->route('upcommingsAdd')->withErrors($validator)->withInput();
        		}

        		if($request->hasFile('banner_image')) {
                  $file = $request->file('banner_image');
                  if ($file->isValid()) {
                    $str = str_random(8);
                    $imgname = $str.'.'.$ext;
                    $img = Image::make($file);
                    $img->fit(Config::get('settings.banner_image')['width'],
                        Config::get('settings.banner_image')['height'])->save(public_path().'/assets/img/banner/'.$imgname);
                    $input['banner_image'] = $imgname;
                    }
                }

                if($request->hasFile('img_362x350')) {
                  $upfile = $request->file('img_362x350');
                  if ($upfile->isValid()) {
                    $upstr = str_random(8);
                    $upimgname = $upstr.'.'.$upext;
                    $upimg = Image::make($upfile);
                    $upimg->fit(Config::get('settings.up_banner_image')['width'],
                        Config::get('settings.up_banner_image')['height'])->save(public_path().'/assets/img/up-comming/'.$upimgname);
                    $input['img_362x350'] = $upimgname;
                    }
                }

                $upcomming = new Upcomming;

                $upcomming->fill($input);

                if ($upcomming->save()) {
                    return redirect('admin/upcommings')->with('status','Баннер добавлен');
                }

        	}

    		if (view()->exists('admin.upcommings_add')) {

    			$data = [
                        'title' => 'Новый upcomming-баннер',
                        'ords_new' => $ords_new,
		            ];
		            return view('admin.upcommings_add',$data);

    		}
    		abort(404); 

    	}
    	return redirect('profile');
     }
}
