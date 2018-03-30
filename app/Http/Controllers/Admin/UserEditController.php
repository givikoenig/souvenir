<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use Config;
use Image;
use Validator;
use App\User;
use App\Models\Role;

class UserEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(User $user, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
        	if ($request->isMethod('delete')) {
        		foreach ($user->orders as $order) {
        			foreach($order->zakaz_tovar as $tovar ) {
	        			$tovar->delete();
	        		}
        			$order->delete();
        		}
        		foreach($user->comments as $comment ) {
        			$comment->delete();
        		}
        		foreach($user->articles as $article ) {
        			$article->delete();
        		}
        		foreach($user->likes as $like ) {
        			$like->delete();
        		}
        		$user->delete();
        		return redirect()->back()->with('status', 'Пользователь удален');
        	}
        	if ($request->isMethod('detach')) {
        		$user->roles()->detach($request['role_id']);
        		if ($request['role_name'] == 'commenter') {
        			$user->update(['confirmed' => 0]);
        		}
        		return back();
        	}
        	if ($request->isMethod('attach')) {
        		$user->attachRole($request['role_id']);
        		if ($request['role_name'] == 'commenter') {
        			$user->update(['confirmed' => 1]);
        		}
        		return back();
        	}
        	if ($request->isMethod('post')) {
        		$input = $request->except('_token');
        		$ext = 'jpg';
        		if($request->avatar) {
        			$ext = explode('.',$request->avatar->getClientOriginalName() )[1];
        		}
        		$messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
        			'max' => 'Поле :attribute должно быть не более :max символов',
        		];
        		$validator = Validator::make($input,[
                        'email' => 'required|email',
                    ], $messages);
        		if ($validator->fails()) {
                    return redirect()
                        ->route('userEdit',['user'=>$input['id']])
                        ->withErrors($validator);
                }
                // if input fio exists in the request replace fio in the user object
                if ($request["fio"]) {
	    			$this->validate($request, [
	    				'fio' => 'required|max:255',
	    				]);
	    			$input['fio'] = $request["fio"];
	    		}
	    		// if input phone exists in the request replace phone in the user object
                if ($request["phone"]) {
	    			$this->validate($request, [
	    				'phone' => 'required|min:18',
	    				]);
	    			$input['phone'] = $request["phone"];
	    		}
        		// if input name exists in the request replace name in the user object
	    		if ($request["name"]) {
	    			$this->validate($request, [
	    				'name' => 'max:255'
	    				]);
	    			$input['name'] = $request["name"];
	    		}
	    		// if input password exists in the request replace password in the user object
	    		if ($request['new_password']) {
	    			$this->validate($request, [
	    				'new_password' => 'min:6|required'
	    				]);
	    			$input['password'] = bcrypt($request['new_password']);
	    		}
	    		if($request->hasFile('avatar')) {
	    			$file = $request->file('avatar');
	    			if ($file->isValid()) {
	    				$str = str_random(8);
	    				$imgname = $str.'.'.$ext;
	    				$img = Image::make($file);
	    				$img->fit(Config::get('settings.avatar_image')['width'],
	    					Config::get('settings.avatar_image')['height'])->save(public_path().'/assets/img/author/'.$imgname);
	    				$input['avatar'] = $imgname;
	    			}

	    		}
        		$user->fill($input);
        		$url = $request->only('redirects_to');
        		if ($user->update()) {
        			return redirect()->to($url['redirects_to'])->with('status','Профиль обновлен');
        		}
        		unset($input);

        	}


        	$roles = Role::all();
        	$old = $user->toArray();
        	$data = [
	            'title' => 'UserEdit',
	            'data' => $old,
                'user' => $user,
                'roles' => $roles,
	            'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.user_edit')) {
            	return view('admin.user_edit',$data);
	        }
	        abort(404);
        }
		return redirect('profile');
	}
}
