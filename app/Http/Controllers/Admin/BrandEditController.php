<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use Validator;
use App\Brand;

class BrandEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Brand $brand, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
        	if ($request->isMethod('delete')) {
        		$subs = $brand->subbrands;
        		foreach ($subs as $sub) {
        			$sub->products()->delete();
        		}
        		$brand->sliders()->delete();
        		$brand->subbrands()->delete();
        		$brand->delete();
           		return redirect('admin/brands')->with('status', ' Категория удалена …');
           	}

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
        			return redirect()
        			->route('brandEdit',['brand'=>$input['id']])
        			->withErrors($validator);
        		}
        		$brand->fill($input);

        		if ($brand->update()) {
        			return redirect('admin/brands')->with('status', 'Категория товаров обновлена…');
        		}
        		unset($input);
        	}

        	$old = $brand->toArray();
        	$data = [
	            'title' => 'Редактирование категории товаров',
                'data' => $old,
	            'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.brand_edit')) {
            
            	return view('admin.brand_edit',$data);
	        }
	        abort(404);

        }
        return redirect('profile');
	}
}
