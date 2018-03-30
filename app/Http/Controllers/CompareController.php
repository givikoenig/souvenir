<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;

use Cart;

class CompareController extends Controller
{
    protected $m_rep;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $company;

    public function __construct(MenusRepository $m_rep) {
        $this->m_rep = $m_rep;
    }
    //
    public function execute(Request $request) {
        $this->title = 'Сравнение товаров';
        $this->meta_desc = 'Сравнение товаров';
        $this->keywords = 'Сравнение товаров';
        $this->company = 'Souvenir Co.';

        $compare_content = Cart::instance('compare')->content();
        $compare_count = Cart::instance('compare')->count();

        if (view()->exists('site.compare')) {
            $data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);

			return view('site.compare', $data, [
                'compare_content' => $compare_content,
                'compare_count' => $compare_count,
            ]);

		}
		abort(404);

    }
}
