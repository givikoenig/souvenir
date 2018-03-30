<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Validator;
use DB;
use App\Mitem;
use App\Block;
use App\Page;

class MitemsAddController extends Controller
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

        		$messages = [
	    		'required' => 'Поле :attribute обязательно к заполнению',
	    		'max' => 'Поле :attribute должно быть не более :max символов',
	    		];
	    		$validator = Validator::make($input, [
	    			'title' => 'required|max:50',
	    		], $messages);
	    		if ($validator->fails()) {
	    			return redirect()->route('mitemsAdd')->withErrors($validator)->withInput();
	    		}
	    		$mitem = new Mitem;
	    		$mitem->fill($input);

	    		if ($mitem->save()) {
	    			$literas = ['alfa','bravo','charlie','delta','echo','foxtrot','golf','hotel'];
        			$mitems = Mitem::all();
	    			foreach ($mitems as $key => $item) {
	    				$item->update(['alias'=> $literas[$key] ]);
	    			}
	    			if ($input['mtype_id'] == 2) {
	    				$currec = Mitem::where('title', $input['title'])->first();
	    				$date = new \DateTime();
		    			DB::table('pages')->insert(
		    				['name' => $input['title'], 'alias' => $currec->alias, 'mitem_id' => $currec->id, 'created_at' => $date ]
		    			);
		    			$page = Page::where('alias', $currec->alias)->first();
			    		if (isset($input['bottom_block_id'])) {
	                		$page->blocks()->attach($input['bottom_block_id']);
	                	}
	                	if (isset($input['aside_block_id'])) {
	                		foreach ($input['aside_block_id'] as $key => $value) {
	                			$page->blocks()->attach($input['aside_block_id'][$key]);
	                		}
	                	}
		    		}

	    			return redirect()->route('mitems')->with('status','Пункт меню добавлен.');
	    		}

        	}

    		if (view()->exists('admin.mitems_add')) {

    			$bottom_available_bl_ids = [2,5,12,14];
    			$bottom_available_blocks = array();
    			foreach ($bottom_available_bl_ids as $value) {
	        		$bottom_block = Block::where('id', $value)->first();
	        		array_push($bottom_available_blocks, $bottom_block);
	        	}
	        	$aside_available_bl_ids = [15,16,17,18];
    			$aside_available_blocks = array();
    			foreach ($aside_available_bl_ids as $value) {
	        		$aside_block = Block::where('id', $value)->first();
	        		array_push($aside_available_blocks, $aside_block);
	        	}
	    		$data = [
	                'title' => 'Новый пункт главного меню',
	                'bottom_available_blocks' => $bottom_available_blocks,
        			'bottom_available_bl_ids' => $bottom_available_bl_ids,
        			'aside_available_blocks' => $aside_available_blocks,
        			'aside_available_bl_ids' => $aside_available_bl_ids,
        			'ords_new' => $ords_new,
	            ];
		        return view('admin.mitems_add',$data);
		        
	        }
	        abort(404);

    	}
    	return redirect('profile');
    }

}
