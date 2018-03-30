<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Validator;
use App\Mitem;
use App\Mtype;
use App\Page;
use App\Block;

class MitemEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Mitem $mitem, Request $request) {

        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
            $mtypes = Mtype::where('name','<>','BRANDS')->get();

        	if ($request->isMethod('delete')) {
        		$pgs = $mitem->pages;
        		foreach ($pgs as $pge) {
        			$pge->blocks()->detach();
        		}
        		$mitem->pages()->delete();
        		$mitem->delete();
        		return redirect()->route('mitems')->with('status', 'Пункт меню удален');
        	}

            if ($request->isMethod('post')) {
                $input = $request->except('_token');

                $messages = [
                    'required' => 'Поле :attribute обязательно к заполнению',
                    'max' => 'Поле :attribute должно быть не более :max символов',
                ];
                $validator = Validator::make($input,[
                        'title' => 'required|max:50',
                    ], $messages);
                if ($validator->fails()) {
                    return redirect()->route('mitemEdit',['mitem'=>$input['id']])->withErrors($validator);
                }

                $mitem->fill($input);

                $url = $request->only('redirects_to');
                if ($mitem->update()) {
                    $page = $mitem->pages[0];
                    $page->blocks()->detach();
                    if (isset($input['bottom_block_id'])) {
                        $page->blocks()->attach($input['bottom_block_id']);
                    }
                    if (isset($input['aside_block_id'])) {
                        foreach ($input['aside_block_id'] as $key => $value) {
                            $page->blocks()->attach($input['aside_block_id'][$key]);
                        }
                    }
                    return redirect()->to($url['redirects_to'])->with('status','Пункт меню обновлен');
                }
                unset($input);

            }

        	$old = $mitem->toArray();

            // dd($mitem->pages[0]->id);
            $fact_blocks = array();
            $bls = Page::find($mitem->pages[0]->id)->blocks()->get();
            foreach ($bls as $bl) {
                array_push($fact_blocks, $bl->id);
            }
            // dd($fact_blocks);
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
	            'title' => 'Редактирование пункта главного меню ',
                'data' => $old,
	            'mtypes' => $mtypes,
                'bottom_available_blocks' => $bottom_available_blocks,
                'bottom_available_bl_ids' => $bottom_available_bl_ids,
                'aside_available_blocks' => $aside_available_blocks,
                'aside_available_bl_ids' => $aside_available_bl_ids,
                'fact_blocks' => $fact_blocks,
                'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.mitem_edit')) {

            
            	return view('admin.mitem_edit',$data);
	        }
	        abort(404);
        }
        return redirect('profile');
	}
}
