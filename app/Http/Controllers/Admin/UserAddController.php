<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Validator;
use App\User;
use App\Models\Role;
use Mail;

class UserAddController extends Controller
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

        		if (is_null($input['password'])) {
        			$input['password'] = str_random(6);
        		}
        		$input['clearpwd'] = $input['password'];
        		$messages = [
	    		'required' => 'Поле :attribute обязательно к заполнению',
	    		'max' => 'Поле :attribute должно быть не более :max символов',
	    		];
	    		$validator = Validator::make($input, [
	    			'email' => 'required|email',
	    			'password' => 'required|min:6',
	    			], $messages);
	    		if ($validator->fails()) {
        			return redirect()->route('userAdd')->withErrors($validator)->withInput();
        		}
        		if (is_null($input['name'])) {
        			$input['name'] = explode('@', $input['email'])[0] ;
        		}
        		$input['password'] = bcrypt($input['password']);
        		$input['confirmed'] = 1;

        		$user = new User;
        		$user->fill($input);

        		$commenter_role_id = Role::where('name','commenter')->first()->id;
        		$url = $request->only('redirects_to');
                if ($user->save()) {
                	$user->attachRole($commenter_role_id);
                	Mail::send('emails.useraddbyadmin', ['data'=>$input], function($message) use($input) {
                                $message->to($input['email']);
                                $message->subject('Подтверждение регистрации');
                            });
                	return redirect()->to($url['redirects_to'])->with('status','Пользователь добавлен');
                }
        	}

    		if (view()->exists('admin.user_add')) {
	    		$data = [
	                'title' => 'Новый пользователь',
                    'ords_new' => $ords_new,
	            ];
		        return view('admin.user_add',$data);
		        
	        }
	        abort(404);

    	}
    	return redirect('profile');
    }
}
