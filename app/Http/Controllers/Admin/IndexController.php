<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

class IndexController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute() {

    	$permit = $this->p_rep->checkEnter();
    	$ords_new = $this->p_rep->checkNewOrders();
    	if ($permit) {

	    	if (view()->exists('admin.index')) {
				$data = ['title' => 'Admin Panel',];
					return view('admin.index',$data, [
						'ords_new' => $ords_new,
					]);
			}
		}
		return redirect('profile');

    }
}
