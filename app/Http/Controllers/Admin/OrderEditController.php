<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use Illuminate\Support\Facades\Input;

use DB;
use Config;
use Validator;
use App\Order;
use App\Delivery;

class OrderEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function recalculateOrder($order_id, $price_array, $qty_array, $dostavka) {
        $ord = Order::find($order_id);
        $ordnum = $ord->order_num;
        $tovars = $ord->zakaz_tovar;
        $onetovarsum =  array();
        foreach ($tovars as $key => $tovar) {
            DB::table('zakaz_tovar')->where('id', $tovar->id)->update([
                'price' => $price_array[$key],
                'quantity' => $qty_array[$key],
            ]);
            array_push($onetovarsum, ($price_array[$key] * $qty_array[$key]) );
        }
        $ordersum = array_sum($onetovarsum);
        $ord->update(['order_total' => $ordersum, 'shipping' => $dostavka]);
        return $ordnum;
    }
    public function changeStatus($order_id) {
        $ord = Order::find($order_id);
        $ordnum = $ord->order_num;
        $new_stat = false;
        if ($ord->status == 0) {
            $new_stat = 1;
        } elseif ($ord->status == 1) {
            $new_stat = 0;
        }
        DB::table('orders')->where('id', $order_id)->update(['status' => $new_stat]);
        return $ordnum;
    }

    public function execute(Order $order, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
        	if ($request->isMethod('delete')) {
        		foreach($order->zakaz_tovar as $key => $tovar ) {
        			$tovar->delete();
        		}
        		$order->delete();
        		return redirect()->back()->with('status', 'Заказ удален');
        	}

        	if ($request->isMethod('post')) {

                $input = $request->except('_token');

                if (Input::get('save_order')) {

            		$messages = [
            			'required' => 'Поле :attribute обязательно к заполнению',
            			'max' => 'Поле :attribute должно быть не более :max символов',
            		];
            		$validator = Validator::make($input,[
                            'fio' => 'required|max:255',
                            'phone' => 'required|max:255',
                            'delivery_address' => 'required|max:255',
                        ], $messages);
            		if ($validator->fails()) {
                        return redirect()
                            ->route('orderEdit',['order'=>$input['id']])
                            ->withErrors($validator);
                    }

                    $user_input = array();
                    $user_input['fio'] = $input['fio'];
                    $user_input['phone'] = $input['phone'];
                    $user_input['id'] = $input['customer_id'];
                    DB::table('users')
                        ->where('id', $user_input['id'])
                        ->update(['fio' => $user_input['fio'], 'phone' => $user_input['phone'] ]);

                    $order->fill($input);
                    if ($order->update()) {
                        return redirect()->route('orders', ['status' => 'new'])->with('status','Данные пользователя и заказ обновлены');
                    }

                } elseif (Input::get('recalc_order')) {
                    $this->recalculateOrder($input['id'], $input['price'], $input['quantity'], $input['shipping']);
                    return back()->with('status', 'Заказ ' . $order->order_num . ' пересчитан');
                } elseif (Input::get('ch_status')) {
                    $this->changeStatus($input['id']);
                    return back()->with('status', 'Заказ ' . $order->order_num . ' помечен как ' . ($order->status == 1 ? 'необработанный' : 'обработанный') );
                } else {
                    return back()->with('status', 'Ошибка обработки');
                }

        	}

        	$old = $order->toArray();
            $customer = $order->user;
            $deliveries = Delivery::all();
        	$data = [
	            'title' => 'OrderEdit',
	            'data' => $old,
                'order' => $order,
                'customer' => $customer,
                'deliveries' => $deliveries,
	            'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.order_edit')) {
            	return view('admin.order_edit',$data);
	        }
	        abort(404);
        }
		return redirect('profile');
	}
}
