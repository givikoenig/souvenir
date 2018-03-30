<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Image;
use Validator;
use App\Article;
use App\Category;

class ArticleEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Article $article, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
            $cats = Category::where('parent_id','<>',0)->get();
            $currpos = 1;
                foreach ($cats as $key => $cat) {
                    if ($cat->alias == $article->category->alias) {
                        $currpos = $key + 1;
                    }
                }

        	if ($request->isMethod('delete')) {
        		$article->comments()->delete();
        		$article->likes()->delete();
            	$article->delete();
           		return redirect('admin/articles?page=' . $currpos)->with('status', 'Статья удалена…');
           	}

        	if ($request->isMethod('post')) {
        		$input = $request->except('_token');

        		$input['alias'] = $this->p_rep->transliterate($input['alias']);
        		$ext = 'jpg';
        		if($request->img) {
        			$ext = explode('.',$request->img->getClientOriginalName() )[1];
        		}
        		$messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
        			'max' => 'Поле :attribute должно быть не более :max символов',
        		];
        		$validator = Validator::make($input,[
                        'title' => 'required|max:255',
                        'alias' => 'required|max:255',
                        'text' => 'required',
                        'keywords' => 'max:255',
                        'meta_desc' => 'max:255'
                    ], $messages);
        		if ($validator->fails()) {
                    return redirect()
                        ->route('articleEdit',['article'=>$input['id']])
                        ->withErrors($validator);
                }
                if($request->hasFile('img')) {
                	$file = $request->file('img');

                	if ($file->isValid()) {
                		$str = str_random(8);
                		$obj = new \stdClass;
						$obj->mini = $str.'_mini.'.$ext;
						$obj->max = $str.'_max.'.$ext;

						$img = Image::make($file);

						$img->fit(Config::get('settings.article_img')['mini']['width'],
						Config::get('settings.article_img')['mini']['height'])->save(public_path().'/assets/img/blog/'.$obj->mini);
						$img->fit(Config::get('settings.article_img')['max']['width'],
							Config::get('settings.article_img')['max']['height'])->save(public_path().'/assets/img/blog/'.$obj->max);

						$input['img'] = json_encode($obj);

                	}
                }

                $article->fill($input);

                $url = $request->only('redirects_to');
                if ($article->update()) {
                	return redirect()->to($url['redirects_to'])->with('status','Статья обновлена');
                }
                unset($input);

        	}

        	
        	$old = $article->toArray();
        	$data = [
	            'title' => 'Редактирование статьи блога ',
	            'data' => $old,
                'cats' => $cats,
	            'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.article_edit')) {
            
            	return view('admin.article_edit',$data);
	        }
	        abort(404);

        }
		return redirect('profile');
	}
}
