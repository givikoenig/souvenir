<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Image;
use Validator;
use App\Banner;
use App\Upcomming;
use Carbon\Carbon;

class UpcommingEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Upcomming $upcomming, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
    	
        	if ($request->isMethod('delete')) {
        		$upcomming->delete();
        		return redirect('admin/upcommings')->with('status', 'Баннер удален');
        	}

            if ($request->isMethod('post')) {

                $input = $request->except('_token');

                if (isset($input['until_date'])) {
                    $until_date = Carbon::createFromFormat('m/d/Y', $input['until_date'])->format('Y-m-d');
                    $input['until_date'] = $until_date;
                }

                $ext = 'jpg';
                if($request->banner_image) {
                    $ext = explode('.',$request->banner_image->getClientOriginalName() )[1];
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
                    ], $messages);

                if ($validator->fails()) {
                    return redirect()
                    ->route('upcommingEdit',['upcomming'=>$input['id']] )
                    ->withErrors($validator);
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

                $upcomming->fill($input);

                if ($upcomming->update()) {
                    return redirect('admin/upcommings')->with('status','Баннер обновлен');
                }
                unset($input);

            }

            $old = $upcomming->toArray();

           $data = [
           'title' => 'Редактирование баннера ',
           'data' => $old,
           'ords_new' => $ords_new,
           ];

           if (view()->exists('admin.upcomming_edit')) {
            
               return view('admin.upcomming_edit',$data);
           }
           abort(404);

        }
    }
}
