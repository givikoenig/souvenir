<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelCaptcha\Facades\Captcha;
use App\Repositories\MenusRepository;

use Config;
use Cookie;
use App\Subscriber;
use App\Article;
use App\Block;
use App\User;
use App\Order;
use App\ZakazTovar;
use App\Models\Role;
use App\Models\Permission;
use Cart;
use Auth;
use Mail;
use Validator;


class CartController extends Controller
{
    protected $m_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $company;

    public function __construct(MenusRepository $m_rep) {
        $this->m_rep = $m_rep;
    }

	public function execute(Request $request) {
        $this->title = 'Корзина';
        $this->meta_desc = 'Корзина';
        $this->keywords = 'Корзина';
        $this->company = 'Souvenir Co.';

        if ($request->isMethod('post')) {
           
            $data = $request->all(); //except('_token');
 // dd($data);
            $user = Auth::user();

            $validator = Validator::make($data,[
                'fio' => 'required',
                'email' => 'required|email',
                'phone' => 'required|min:18',
                'captcha' => 'required|bone_captcha'
            ]);

            if($validator->fails()) {
                return \Response::json(['error'=> $validator->errors()->first()]);
            }
        

            if (!$user) {
                $guest = User::where('email', $data['email'])->first();
                if(!is_null($guest) ) {  //такой user есть, но не залогинился
                    $user_id = User::where('email', $data['email'])->first()->id; //получаем его ID
                } else { //
                    $user_id = 0;
                }

            } else {
                $guest = $user;
                $user_id = $user->id;
            }

           if ($user_id == 0) {
                $pwd = str_random(8);
                $data['token'] = str_random(25);
                $data['pwd'] = $pwd;
                $nickname =  explode('@', $data['email']);
                $data['nick'] = $nickname[0];

                $user = new User;
                $user->fio = $data['fio'];
                $user->email = $data['email'];
                $user->phone = $data['phone'];
                $user->address = $data['delivery_address'];
                $user->password = bcrypt($pwd);
                $user->token = $data['token'];
                $user->name = $data['nick'];

                $guest_role_id = Role::where('name', 'guest')->first()->id;

                $user->fill($data);

                if($user->save()) {

                            Mail::send('emails.order', ['data'=>$data], function($message) use($data) {
                                $message->to($data['email']);
                                $message->subject('Подтверждение регистрации');
                            });

                    $user->attachRole($guest_role_id);
                }

           } else {
                User::where('id', $user_id)->update([
                        'fio' => $data['fio'],
                        'phone' => $data['phone'],
                        'address' => $data['delivery_address']
                    ]);
           }

            $result = array();
          
            $result['shipping'] = $data['shipping'];
            $result['user_id'] = $user_id;
            $result['email'] = $data['email'];
            $result['phone'] = $data['phone'];
            $result['contact'] = $data['fio'];
            $result['address'] = $data['delivery_address'];
            $result['total'] = Cart::instance('shopping')->total();
            $result['itogo'] = $result['shipping'] + $result['total'];

            $order = new Order;
            $order->prim = $data['prim'];
            $order->user_id = $user_id;
            $order->shipping = $data['shipping'];
            $order->order_total = $result['total'];
            $order->delivery_address = $data['delivery_address'];
            $order->save();
            $result['last_order_id'] = $order->id;
            $prefix = '';
            $order->shipping == 0 ? $prefix = 'M ' : $prefix = 'P ';
            $result['last_order_num'] = $prefix . sprintf('%08d', $order->id);
            Order::where('id', $order->id)->update(['order_num' => $result['last_order_num'] ]);

            $cart_cont = Cart::instance('shopping')->content();
            foreach($cart_cont as $row) {
                $row->associate('App\Product');
                $zakaz_tovar = new ZakazTovar;
                $zakaz_tovar->order_id = $order->id;
                $zakaz_tovar->name = $row->name;
                $zakaz_tovar->price = $row->price;
                $zakaz_tovar->quantity = $row->qty;
                $zakaz_tovar->product_id = $row->id;
                $zakaz_tovar->save();

            }

           $dta = $request->all();
           $dta['order_id'] = $order->id;
           $dta['user_fio'] = $data['fio'];
           $dta['user_email'] = $data['email'];
           $dta['user_phone'] = $data['phone'];
           $dta['user_address'] = $data['delivery_address'];
           $dta['user_prim'] = $data['prim'];
           $dta['cart'] = $cart_cont;
           $dta['cart_total'] = $result['total'];
           $dta['shipping_sum'] = $data['shipping'];
           $dta['order_total_sum'] = $result['itogo'];

            Mail::send('emails.order_notification', ['dta'=>$dta], function($message) use($dta) {
                            $mail_admin = 'givi.koenig@ya.ru';
                                $message->from($dta['user_email']);
                                $message->to($mail_admin,'Internet Shop Administrator')->subject('Отправлено через сайт ' . $this->company );
                                $message->subject('Заказ через Интернет-магазин ' . $this->company);
                            });

            Cart::instance('shopping')->destroy();
            // Cart::instance('wishlist')->destroy();
            
            return \Response::json(['success' => TRUE, 'data' => $result]);

        }

        $cart_content = Cart::instance('shopping')->content();
        $cart_count = Cart::instance('shopping')->count();
        $cart_total = Cart::instance('shopping')->total();
        $wishlist_content = Cart::instance('wishlist')->content();
        $wishlist_count = Cart::instance('wishlist')->count();

		if (view()->exists('site.cart')) {

            $data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);

			return view('site.cart', $data, [
                'cart_content' => $cart_content,
                'cart_total' => $cart_total,
                'cart_count' => $cart_count,
                'wishlist_content' => $wishlist_content,
                'wishlist_count' => $wishlist_count,
                'captcha' => Captcha::html()
            ]);

		}
		abort(404);

	}

}
