<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use Illuminate\Support\Facades\Input;

use DB;
use App\Order;
use App\Delivery;

class OrderViewController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
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
    		if ($request->isMethod('post')) {

                $input = $request->except('_token');

                if (Input::get('just_back')) {

                	return redirect()->route('orders',  ['status' => 'new']);

                } elseif (Input::get('ch_status')) {
                    $this->changeStatus($input['id']);
                    return back()->with('status', 'Заказ ' . $order->order_num . ' помечен как ' . ($order->status == 1 ? 'необработанный' : 'обработанный') );
                }

            }

    	$old = $order->toArray();
            $customer = $order->user;
            $delivery = Delivery::find($order->delivery_id)->name;
        	$data = [
	            'title' => 'Order View',
	            'data' => $old,
                'order' => $order,
                'customer' => $customer,
                'delivery' => $delivery,
	            'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.order_view')) {
            	return view('admin.order_view',$data);
	        }
	        abort(404);
	    }
		return redirect('profile');
    }
}
