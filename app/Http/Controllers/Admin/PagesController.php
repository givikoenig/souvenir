<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use App\Mitem;

class PagesController extends Controller
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
	    	if (view()->exists('admin.pages')) {
	    		$mitems = Mitem::with('pages')->paginate(1);
				$data = [
					'title' => 'Single Pages',
					'mitems' => $mitems,
					'ords_new' => $ords_new,
				];
					return view('admin.pages',$data);
			}
			abort(404);
		}
		return redirect('profile');
    }
}
