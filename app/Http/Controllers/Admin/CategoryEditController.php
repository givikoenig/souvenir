<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Validator;
use App\Category;
use App\Article;
use App\Comment;

class CategoryEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Category $category, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {

        	if ($request->isMethod('delete')) {
        		$arts = $category->articles;
        		foreach ($arts as $art) {
        			$art->comments()->delete();
        			$art->likes()->delete();
        		}
            	$category->articles()->delete();
            	$category->delete();
           		return redirect('admin/categories')->with('status', 'Тема удалена…');
           	}

        	if ($request->isMethod('post')) {
        		$input = $request->except('_token');
        		$input['parent_id'] = 1;

        		$tr_alias = $this->p_rep->transliterate($input['alias']);
        		$input['alias'] = $tr_alias;

        		$messages = [
        		'required' => 'Поле :attribute обязательно к заполнению',
        		'max' => 'Поле :attribute должно быть не более :max символов',
        		];
        		$validator = Validator::make($input, [
        			'title' => 'required|max:255',
        			'alias' => 'required|max:255',
        			'keywords' => 'max:255',
        			'meta_desc' => 'max:255',

        			], $messages);

        		if ($validator->fails()) {
        			return redirect()
        			->route('categoryEdit',['category'=>$input['id']])
        			->withErrors($validator);
        		}

        		$category->fill($input);

        		if ($category->update()) {
        			return redirect('admin/categories')->with('status', 'Тема блога обновлена…');
        		}
        		unset($input);

        	}

        	$old = $category->toArray();
        	$data = [
	            'title' => 'Редактирование темы блога ',
                'data' => $old,
	            'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.category_edit')) {
            
            	return view('admin.category_edit',$data);
	        }
	        abort(404);

        }
		return redirect('profile');
	}
}
