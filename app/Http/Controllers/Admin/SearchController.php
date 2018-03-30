<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Repositories\PblRepository;

use Validator;
use App\Banner;
use App\Product;
use App\Article;

class SearchController extends Controller
{
    //
    protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }

    public function execute() {
    	$permit = $this->p_rep->checkEnter();
    	$ords_new = $this->p_rep->checkNewOrders();
    	if ($permit) {

	     	if (view()->exists('admin.banners_search')) {

	     		$keyword = Input::get('keyword');
	     		$srchs = Product::where('visible', '1')->SearchByKeyword($keyword)->get();
	     		$art_srchs = Article::SearchByKeyword($keyword)->get();
		        $searches = array();
		        if (!is_null($keyword)) {
		        	if (is_object($srchs)) {
				        foreach ($srchs as $srch) {
				            $tmp = array( 'id'=>$srch->id ,'articul'=>$srch->articul, 'name'=>$srch->name, 'price'=>$srch->price, 'anons'=>$srch->anons, 'techs'=>$srch->techs, 'created_at' => $srch->created_at ,'images'=>$srch->images);
				            array_push($searches,$tmp);
				        }
				    } elseif (is_object($art_srchs)) {
				    	foreach ($art_srchs as $srch) {
				            $tmp = array( 'id'=>$srch->id ,'title'=>$srch->title, 'desc'=>$srch->desc, 'text'=>$srch->text, 'excerption'=>$srch->excerption, 'post'=>$srch->post, 'created_at' => $srch->created_at ,'category_id'=>$srch->category_id,'user_id'=>$srch->user_id);
				            array_push($searches,$tmp);
				        }
				    }
			    }
			    $fromctl = FALSE;
			    if (Route::current()->parameters() && Route::current()->parameters()['alias'] == 'upcommings') {
			    	$fromctl = 'upcommings';
			     }
	     			$data = [
			            'title' => 'Выбор товара для баннера',
			        	'searches' => $searches,
			        	'keyword' => $keyword,
			        	'fromctl' => $fromctl,
			        	'ords_new' => $ords_new,
			        ];
			            return view('admin.banners_search',$data);
	    	}
	   		abort(404);
	   	}
	   	return redirect('profile');
     }
}
