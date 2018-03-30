<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Validator;
use App\Brand;

class BrandsAddController extends Controller
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

        		$input['alias'] = $this->p_rep->transliterate($input['alias']);

        		$messages = [
	    		'required' => 'Поле :attribute обязательно к заполнению',
	    		'max' => 'Поле :attribute должно быть не более :max символов',
	    		];
	    		$validator = Validator::make($input, [
	    			'name' => 'required|max:255',
	    			'alias' => 'required|max:255',
	    			'keywords' => 'max:255',
	    			'meta_desc' => 'max:255',

	    			], $messages);
	    		if ($validator->fails()) {
        			return redirect()->route('brandsAdd')->withErrors($validator)->withInput();
        		}
        		$brand = new Brand;
        		$brand->fill($input);

        		if ($brand->save()) {
        			return redirect('admin/brands')->with('status','Категория товаров добавлена');
        		}

        	}

    		if (view()->exists('admin.brands_add')) {

	    		$data = [
                    'title' => 'Новая категория товаров',
	                'ords_new' => $ords_new,
	            ];
		        return view('admin.brands_add',$data);
		        
	        }
	        abort(404);

    	}
    	return redirect('profile');
    }
}
