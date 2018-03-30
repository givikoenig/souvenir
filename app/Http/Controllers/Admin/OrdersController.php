<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use App\Order;

class OrdersController extends Controller
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
	    	if (view()->exists('admin.orders')) {
                $ords_total = Order::count();
                $ords_old = Order::where('status', 1)->count();
	    		$orders = $this->GetOrdersStatusView($request);
				$data = [
					'title' => 'Orders',
                    'orders' => $orders,
                    'ords_total' => $ords_total,
                    'ords_new' => $ords_new,
					'ords_old' => $ords_old,
				];
					return view('admin.orders',$data);
			}
			abort(404);
		}
		return redirect('profile');
    }

    public function GetOrdersStatusView($request) {
    	$orders = array();

    	if (basename($request->path()) == 'orders') {
    		$orders = Order::OrderBy('created_at', 'desc')->with('zakaz_tovar')->paginate(Config::get('settings.adm_orders_pages_count'));
    	} elseif (basename($request->path()) == 'new') {
    		$orders = Order::where('status', 0)->OrderBy('created_at', 'asc')->with('zakaz_tovar')->paginate(Config::get('settings.adm_orders_pages_count'));
    	} elseif (basename($request->path()) == 'old') {
    		$orders = Order::where('status', 1)->OrderBy('created_at', 'desc')->with('zakaz_tovar')->paginate(Config::get('settings.adm_orders_pages_count'));
    	}  else {
            abort(404);
        }
        return $orders;

    }
}
