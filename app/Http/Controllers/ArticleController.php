<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;

use Illuminate\Support\Facades\Input;
use LaravelCaptcha\Facades\Captcha;

use Config;
use App\Category;
use App\Article;
use App\Product;
use App\Comment;
use App\Like;
use Validator;
use \Carbon\Carbon;

class ArticleController extends Controller
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
    public function execute(Request $request, $alias) {

        \Carbon\Carbon::setLocale('ru');
        setlocale(LC_TIME, 'Russian');
        
    	if (!$alias) {
    		abort(404);
    	}

        $this->title = FALSE;
        $this->meta_desc = FALSE;
        $this->keywords = FALSE;
        $this->company = 'Souvenir Co.';
       
        $new_arrivals = Product::take(Config::get('settings.article_page_comments_count'))->orderBy('created_at','desc')->get();
        $cats = Category::where('parent_id','<>', 0)->with('articles')->get();

    	if (view()->exists('site.article')) {

    		$article = Article::where('alias', strip_tags($alias))->with('comments')->first();
            if ($article) {
                $this->title = $article->title;
                $this->meta_desc = $article->title;
                $this->keywords = $article->title;

                $comments_count = $this->plural_form(count($article->comments) , array('комментарий','комментария','комментариев'));
                $likes_count = count(Like::where('article_id',$article->id)->get());

                $data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);

            return view('site.article', $data,[
                'article' => $article,
                'cats' => $cats,
                'new_arrivals' => $new_arrivals,
                'comments_count' => $comments_count,
                'likes_count' => $likes_count,
                'captcha' => Captcha::html()

                ]);

            } 
            abort(404);
            
    	}
    	abort(404);
    }

    public function plural_form($number, $after) {
      $cases = array (2, 0, 1, 1, 1, 2);
      return  $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];

    }

}
