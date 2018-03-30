<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Validator;
use App\Subbrand;
use App\Brand;
use App\User;

class SubbrandEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Subbrand $subbrand, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {

        	$brands = Brand::all();
        	$currpos = 1;
                foreach ($brands as $key => $brand) {
                	if ($brand->alias == $subbrand->brand->alias) {
                		$currpos = $key + 1;
                	}
                }

        	if ($request->isMethod('delete')) {
        		$subbrand->products()->delete();
        		$subbrand->delete();
        		return redirect('admin/subbrands?page=' . $currpos)->with('status', 'Категория удалена удалена…');
        	}

        	if ($request->isMethod('post')) {
        		$input = $request->except('_token');

        		$input['alias'] = $this->p_rep->transliterate($input['alias']);

        		$messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
        			'max' => 'Поле :attribute должно быть не более :max символов',
        		];
        		$validator = Validator::make($input,[
                        'name' => 'required|max:255',
                        'alias' => 'required|max:255',
                        'keywords' => 'max:255',
                        'meta_desc' => 'max:255'
                    ], $messages);
        		if ($validator->fails()) {
                    return redirect()
                        ->route('subbrandEdit',['subbrand'=>$input['id']])
                        ->withErrors($validator);
                }

                $subbrand->fill($input);

                $url = $request->only('redirects_to');
                if ($subbrand->update()) {
                	return redirect()->to($url['redirects_to'])->with('status','Субкатегория обновлена');
                }
                unset($input);

        	}

        	
        	$old = $subbrand->toArray();
        	$data = [
	            'title' => 'Редактирование субкатегории ',
	            'data' => $old,
	            'brands' => $brands,
                'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.subbrand_edit')) {
            
            	return view('admin.subbrand_edit',$data);
	        }
	        abort(404);

        }
        return redirect('profile');
	}
}
