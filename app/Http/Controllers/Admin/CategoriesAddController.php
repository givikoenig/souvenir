<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Validator;
use App\Category;

class CategoriesAddController extends Controller
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
    		if ($request->isMethod('post')) {

        		$input = $request->except('_token');
        		$input['parent_id'] = 1;

        		$input['alias'] = $this->p_rep->transliterate($input['alias']);

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
        			return redirect()->route('categoriesAdd')->withErrors($validator)->withInput();
        		}

        		$category = new Category;
        		$category->fill($input);

        		if ($category->save()) {
        			return redirect('admin/categories')->with('status','Тема блога добавлена');
        		}

        	}

    		if (view()->exists('admin.categories_add')) {

	    		$data = [
                    'title' => 'Новая тема блога',
	                'ords_new' => $ords_new,
	            ];
		        return view('admin.categories_add',$data);
		        
	        }
	        abort(404);

    	}
    	return redirect('profile');
    }
}
