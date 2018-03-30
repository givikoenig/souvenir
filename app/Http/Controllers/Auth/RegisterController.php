<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\Permission;

use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    public function redirectTo()
    {
        if(!empty($_POST['croute'])) {
            $return  = url('/'.$_POST['croute']);
        } else {
            $return  = url('/');
        }
        return $return;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            // 'login' => 'required|max:50|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            // 'login' => $data['login'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function register(Request $request) {

        $messages = [
                        'required' => "Поле :attribute обязательно к заполнению",
                        'email' => "Поле :attribute должно соответствовать email адресу",
                        'min' => "Поле :attribute должно содержать не менее :min символов",
                        'max' => "Поле :attribute должно содержать не более :max символов",
                        'unique' => "Пользователь с таким E-mail уже зарегистрирован"
                        ];

                        $this->validate($request,[
                        'email' => 'required|email|unique:users',
                        // 'login' => 'required|max:50|unique:users',
                        'password' => 'required|min:6'
                        ], $messages);

                        $data = $request->all();

                        $created_data = $this->create($data)->toArray();

                        $data['token'] = str_random(25);

                        $user = User::find($created_data['id']);
                        $user->token = $data['token'];

                        if($user->save()) {

                            Mail::send('emails.confirmation', ['data'=>$data], function($message) use($data) {
                                $message->to($data['email']);
                                $message->subject('Подтверждение регистрации');
                            });
                            return redirect(route('home'))->with('status','На Ваш E-mail было отправлено сообщение для подтверждения регистрации');
                        }
        
        // return redirect(route('home'))->with('status', $validator->errors()->first());
    }

    public function confirmation($token) {
        $commenter_role_id = Role::where('name', 'commenter')->first()->id;
        $user = User::where('token', $token)->first();

        if (!is_null($user)) {
            $user->confirmed = 1;
            $user->token = '';
            $user->save();
            $user->attachRole($commenter_role_id);
            return redirect(route('home'))->with('status','Регистрация завершена');

        }
        return redirect(route('home'))->with('status','Регистрация не подтверждена');
    }
}
