<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use App\Article;

class CommentsController extends Controller
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
    		$keyword = Input::get('keyword');
    		$art_srchs = Article::SearchByKeyword($keyword)->get();
    		$searches = array();
    		if (!is_null($keyword)) {
    			foreach ($art_srchs as $srch) {
    				$tmp = array( 'id'=>$srch->id ,'title'=>$srch->title, 'alias'=>$srch->alias, 'desc'=>$srch->desc, 'text'=>$srch->text, 'excerption'=>$srch->excerption, 'post'=>$srch->post, 'created_at' => $srch->created_at, 'img'=>$srch->img ,'category_id'=>$srch->category_id,'user_id'=>$srch->user_id);
    				array_push($searches,$tmp);
    			}
    		}
	    	if (view()->exists('admin.comments')) {
	    		if ($keyword) {
		    		$articles = Article::with('comments')->get();
		    	} else {
		    		$articles = Article::with('comments')->paginate(1);
		    	}
		    	$currentpos = 1;
	    		// dd($articles->currentPage());
	    		$fromctl = 'comments';
				$data = [
					'title' => 'Комментарии к статье блога',
					'articles' => $articles,
					'searches' => $searches,
					'keyword' => $keyword,
					'currentpos' => $currentpos,
					'fromctl' => $searches,
					'ords_new' => $ords_new,
				];
					return view('admin.comments',$data);
			}
			abort(404);
		}
		return redirect('profile');
    }
}
