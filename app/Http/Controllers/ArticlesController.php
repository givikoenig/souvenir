<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;
use Illuminate\Support\Facades\Input;

use Config;
use App\Category;
use App\Article;
use App\Comment;

class ArticlesController extends Controller
{

    protected $m_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $company;

    public function __construct(MenusRepository $m_rep) {
            $this->m_rep = $m_rep;
    }
    //
    public function execute(Request $request) {
        $this->title = 'Блог';
        $this->meta_desc = 'Блог';
        $this->keywords = 'Блог';
        $this->company = 'Souvenir Co.';

        $cats = Category::where('parent_id','<>', 0)->with('articles')->get();

        //filtering articles
        $cat_alias = $request->route()->cat_alias;
        $category = FALSE;
        if($cat_alias) {
        	$category = Category::where('alias',$cat_alias)->first();
            if ( $category && $cat_alias ) {
                $this->title = $category->title;
                $this->meta_desc = $category->title;
                $this->keywords = $category->title;
            } else {
                abort(404);
            }
        }

        $category_id = $category['id'];
        $articles = array();

        if(!$category_id) {
        	$articles = Article::orderBy('created_at','desc')->paginate(Config::get('settings.articles_pages_count'));
    	} else {
    		$articles = Article::where('category_id',$category_id)->orderBy('created_at','desc')->paginate(Config::get('settings.articles_pages_count'));
    	}

        $keyword = Input::get('keyword');

        if($keyword){
            $articles = Article::SearchByKeyword($keyword)->paginate(Config::get('settings.articles_pages_count'));
        }

        $comments = Comment::take(Config::get('settings.articles_pages_comments_count'))->orderBy('created_at','desc')->get();

    	if (view()->exists('site.articles')) {

            $data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);
    		
    		return view('site.articles', $data, [
                'category' => $category,
                'cats' => $cats,
                'articles' => $articles,        
                'comments' => $comments,
    			]);
    	}
    	abort(404);
        
    }
}
