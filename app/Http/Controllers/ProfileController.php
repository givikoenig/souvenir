<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MenusRepository;

use Config;
use Session;
use Validator;
use Image;

use App\User;
use App\Order;

class ProfileController extends Controller
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
	public function execute(Request $request) {

        if (Auth::check()) {
        	$user = User::find($request->user()->id);
            $this->title = 'Профиль ' . $user->name;
            $this->meta_desc = 'Профиль ' . $user->name;
            $this->keywords = 'Профиль ' . $user->name;
            $this->company = 'Souvenir Co.';

        	$orders = Order::where('user_id', $user->id)->take(config('settings.orders_limit'))->orderBy('created_at', 'desc')->with('zakaz_tovar')->get();
        	
            $data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);
        	return view('laravelauthprofile::viewprofile', $data,[
        		'orders' => $orders,
                'user' => $user,
        		]) ;
        } else {
        	return redirect()->route('login');
        }

    }

    public function editCurrentUserProfile(Request $request)
    {

    	// Find the current authenticated user object
    	$user = User::find($request->user()->id);

    	if ($request->has('user_data')) {
    		

    		$ext = 'jpg';
    		if($request->avatar) {
    			$ext = explode('.', $request->avatar->getClientOriginalName() )[1];
    		}

	        // if input name exists in the request replace name in the user object
    		if ($request["name"]) {
    			$this->validate($request, [
    				'name' => 'max:255'
    				]);
    			$user->name = $request["name"];
    		}

    		if($request->hasFile('avatar')) {
    			$file = $request->file('avatar');
    			if ($file->isValid()) {
    				$str = str_random(8);
    				$imgname = $str.'.'.$ext;
    				$img = Image::make($file);
    				$img->fit(Config::get('settings.avatar_image')['width'],
    					Config::get('settings.avatar_image')['height'])->save(public_path().'/assets/img/author/'.$imgname);
    				$user->avatar = $imgname;
    			}

    		}

	        // if input password exists in the request replace password in the user object
    		if ($request["password"]) {
    			$this->validate($request, [
    				'password' => 'min:6|required'
    				]);
    			$user->password = bcrypt($request["password"]);
    		}

    		$user->save(); 

    		Session::flash('message', "Данные успешно сохранены!");
    		return redirect()->back();


    	}	

        if ($request->has('delivery_data')) {

	    	// if input fio exists in the request replace fio in the user object
	    	if ($request["fio"]) {
	    		$this->validate($request, [
	    			'fio' => 'max:255'
	    			]);
	    		$user->fio = $request["fio"];
	    	}

	    	// if input phone exists in the request replace phone in the user object
	        if ($request["phone"]) {
	            $this->validate($request, [
	                'phone' => 'min:18'
	            ]);
	            $user->phone = $request["phone"];
	        }

	        // if input address exists in the request replace address in the user object
    		if ($request["address"]) {
    			$this->validate($request, [
    				'address' => 'required'
    				]);
    			$user->address = $request["address"];
    		}

	    	$user->save(); 

		    Session::flash('message', "Данные успешно сохранены!");
		    return redirect()->back();

	    }

	}
    

}
