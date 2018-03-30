<?php

namespace App\Repositories;

use Config;
use App\Page;
use App\Brand;
use App\Subbrand;
use App\Mitem;
use App\Category;

class MenusRepository {

	public function getData($title = FALSE, $meta_desc = FALSE, $keywords = FALSE, $company = FALSE) {

		// for header2
        $brands_page = Page::where('alias','brands')->first();  //for footer too
        $p_blocks = $brands_page->blocks;
        $page_blocks = array();
        foreach ($p_blocks as $value) {
            $block = $value->name;
            array_push($page_blocks, $block);
        }

        //  For Main Menu
        $brands = Brand::with('subbrands')->get(); // & for widget-categories
        $subbrands = Subbrand::all();
        $mitems = Mitem::with('pages')->get();
        $menu = array();
        foreach ($mitems as $key => $mitem) {
            $item = array('id' => $mitem->id,'title'=>$mitem->title, 'type'=>$mitem->mtype_id,'alias'=>$mitem->alias);
                array_push($menu,$item);
        }
        $categories = Category::all();

        // Footer
        $main_page = Page::where('alias','home')->first();
        $blog_page = Category::where('parent_id',0)->first();

		$data = [
				'title' => $title,
				'meta_desc' => $meta_desc,
                'keywords' => $keywords,
				'company' => $company,
				'menu' => $menu,
                'mitems' => $mitems,
                'brands' => $brands,
                'subbrands' => $subbrands,
                'main_page' => $main_page,
                'categories' => $categories,
                'brands_page' => $brands_page,
                'blog_page' => $blog_page,
                'page_blocks' => $page_blocks,
                
			];

		return $data;

	}

}

?>