<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use App\Category;


class CategoriesController extends Controller
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
	    	if (view()->exists('admin.categories')) {
	    		$categories = Category::where('parent_id', '<>', 0)->get();
				$data = [
					'title' => 'Темы блога',
					'categories' => $categories,
					'ords_new' => $ords_new,
				];
					return view('admin.categories',$data);
			}
			abort(404);
		}
		return redirect('profile');
    }
}
