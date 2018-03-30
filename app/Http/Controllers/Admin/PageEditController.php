<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Config;
use Image;
use Validator;
use App\Page;
use App\Mitem;
use App\Block;

class PageEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    public function execute(Page $page, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
        	$mitem = $page->mitem;

        	$mitems = Mitem::all();
            $currpos = 1;
                foreach ($mitems as $key => $m_item) {
                    if ($m_item->alias == $page->mitem->alias) {
                        $currpos = $key + 1;
                    }
                }
        	
        	if ($request->isMethod('delete')) {
                $page->blocks()->detach();
        		$page->delete();
        		return redirect('admin/pages?page=' . $currpos)->with('status', 'Страница удалена…');
        	}

        	if ($request->isMethod('post')) {
        		$input = $request->except('_token');

        		$input['permanent'] = '0';
        		$input['mitem_id'] = $mitem->id;

        		if ($mitem->mtype_id == 1) {
	        		$input['alias'] = $mitem->alias;
	        		$input['name'] = $input['title'];
	        	} else {
                    if (!($input['alias'])) {
                        $input['alias'] = $this->p_rep->transliterate($input['title']);
                    }
	        	}

        		$ext = 'jpg';
        		if($request->img) {
        			$ext = explode('.',$request->img->getClientOriginalName() )[1];
        		}
        		$messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
        			'max' => 'Поле :attribute должно быть не более :max символов',
        		];
        		$validator = Validator::make($input,[
                        'title' => 'required|max:100',
                        'text' => 'required',
                        'keywords' => 'max:255',
                        'meta_desc' => 'max:255'
                    ], $messages);
        		if ($validator->fails()) {
                    return redirect()->route('pageEdit',['page'=>$input['id']])->withErrors($validator);
                }
                if($request->hasFile('img')) {
                	$file = $request->file('img');

                	if ($file->isValid()) {
                		$str = str_random(6);
                		$obj = new \stdClass;
                        $obj->max = $str.'_max.'.$ext;
						$obj->mini = $str.'_mini.'.$ext;
						
						$img = Image::make($file);

                        $img->fit(Config::get('settings.page_img')['max']['width'],
                            Config::get('settings.page_img')['max']['height'])->save(public_path().'/assets/img/others/'.$obj->max);
						$img->fit(Config::get('settings.page_img')['mini']['width'],
						Config::get('settings.page_img')['mini']['height'])->save(public_path().'/assets/img/others/'.$obj->mini);

						$input['img'] = json_encode($obj);
                	}
                	
                }

                $page->fill($input);
                
                $url = $request->only('redirects_to');
                if ($page->update()) {

                    $page->blocks()->detach();
                    if (isset($input['bottom_block_id'])) {
                        $page->blocks()->attach($input['bottom_block_id']);
                    }
                    if (isset($input['aside_block_id'])) {
                        foreach ($input['aside_block_id'] as $key => $value) {
                            $page->blocks()->attach($input['aside_block_id'][$key]);
                        }
                    }
                	return redirect()->to($url['redirects_to'])->with('status','Страница обновлена');
                }
                unset($input);

        	}

        	$old = $page->toArray();

            $fact_blocks = array();
            $bls = Page::find($page->id)->blocks()->get();
            foreach ($bls as $bl) {
                array_push($fact_blocks, $bl->id);
            }

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
	            'title' => 'Page Edit',
	            'data' => $old,
	            'mitem' => $mitem,
                'bottom_available_blocks' => $bottom_available_blocks,
                'bottom_available_bl_ids' => $bottom_available_bl_ids,
                'aside_available_blocks' => $aside_available_blocks,
                'aside_available_bl_ids' => $aside_available_bl_ids,
                'fact_blocks' => $fact_blocks,
                'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.page_edit')) {
            
            	return view('admin.page_edit',$data);
	        }
	        abort(404);

        }
        return redirect('profile');
   }
}
