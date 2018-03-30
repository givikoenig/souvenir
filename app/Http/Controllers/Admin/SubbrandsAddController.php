<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Validator;
use App\Subbrand;
use App\Brand;

class SubbrandsAddController extends Controller
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
        			return redirect()->route('subbrandsAdd', $input['brand_id'])->withErrors($validator)->withInput();
        		}
        		$subbrand = new Subbrand;
        		$subbrand->fill($input);
        		$url = $request->only('redirects_to');
                if ($subbrand->save()) {
                	return redirect()->to($url['redirects_to'])->with('status','Субкатегория добавлена');
                }

        	}

    		if (view()->exists('admin.articles_add')) {

    			$brands = Brand::all();
	    		$data = [
	                'title' => 'Новая субкатегория',
	                'brands' => $brands,
                    'ords_new' => $ords_new,
	                'brand_id' => $request->route('brand_id'),
	            ];
		        return view('admin.subbrands_add',$data);
		        
	        }
	        abort(404);

    	}
    	return redirect('profile');
    }
}
