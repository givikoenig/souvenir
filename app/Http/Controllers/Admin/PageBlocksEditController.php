<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;
use App\Page;
use App\Block;

class PageBlocksEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Block $block, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {

        	$main_page = Page::where('alias', 'home')->first();
        	$main_page_id = $main_page->id;
        	$page = Page::find($main_page_id);
        	
        	$fact_blocks = array();
        	$bls = Page::find($main_page_id)->blocks()->get();
        	foreach ($bls as $bl) {
        		array_push($fact_blocks, $bl->id);
        	}
        	if ($request->isMethod('detach')) {
        		$page->blocks()->detach($request->block->id);
        		return back();
        	}
        	if ($request->isMethod('attach')) {
        		$page->blocks()->attach($request->block->id);
        		return back();
        	}
        	$available_bl_ids = [1,2,3,4,5,8,9,11,12];
        	$available_blocks = array();
        	foreach ($available_bl_ids as $value) {
        		$block = Block::where('id', $value)->first();
        		array_push($available_blocks, $block);
        	}
        	$data = [
        	'title' => 'Available Page BLocks',
        	'available_blocks' => $available_blocks,
        	'available_bl_ids' => $available_bl_ids,
            'fact_blocks' => $fact_blocks,
        	'ords_new' => $ords_new,
        	];

        	if (view()->exists('admin.blocks_main_edit')) {
        		return view('admin.blocks_main_edit',$data);
        	}
        	abort(404);
        }
        return redirect('profile');
    }
}
