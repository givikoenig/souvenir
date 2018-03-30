<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;

use Config;
use DB;
use Mail;
use Validator;
use App\Mitem;
use App\Comment;
use App\Product;
use App\Page;
use App\Banner;
use App\Upcomming;
use App\Subscriber;

class HotelController extends Controller
{
    protected $m_rep;
    protected $p_rep;
    protected $litera;
    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $company;

    public function subscribe($token) {
        $subscriber = Subscriber::where('token', $token)->first();

        if (!is_null($subscriber)) {
            $subscriber->confirmed = 1;
            $subscriber->token = '';
            $subscriber->save();
            return redirect(route('home'))->with('status','Спасибо за подписку на наши новости!');

        }
        return redirect(route('home'))->with('status','Подписка не подтверждена');

    }

    protected function create(array $data)
    {
        return Subscriber::create([
            'email' => $data['email'],
        ]);
    }

    public function __construct(MenusRepository $m_rep) {
        $this->m_rep = $m_rep;
    }
    //
    public function execute(Request $request) {
        $litera = 'hotel';
        $this->litera = $litera;
        $this->title = FALSE;
        $this->meta_desc = FALSE;
        $this->keywords = FALSE;
        $this->company = 'Souvenir Co.';


        if($request->isMethod('post') && !$request['qty']) {       
            // 
            $messages = [
                'required' => "Поле :attribute обязательно к заполнению",
                'email' => "Поле :attribute должно соответствовать email адресу",
                'unique' => "Пользователь с таким E-mail адресом уже отправлял запрос на подписку. Возможно Вы ее не активировали. Проверьте Вашу почту и щелкните по ссылке для активации подписки."
            ];

            $this->validate($request,[
                'email' => 'required|email|unique:subscribers',
            ], $messages);

            $dta = $request->all();

            $created_data = $this->create($dta)->toArray();

            $dta['token'] = str_random(25);

            $subscriber = Subscriber::find($created_data['id']);
            $subscriber->token = $dta['token'];

            if($subscriber->save()) {
                Mail::send('emails.subscribe', ['data'=>$dta], function($message) use($dta) {
                    $message->to($dta['email']);
                    $message->subject('Подтверждение подписки на новости');
                });
                return redirect()->route($litera, ['alias'=> \Route::current()->parameter()->alias])->with('status','На Ваш E-mail было отправлено сообщение для подтверждения подписки');
            }
                        
        }

        $litera = $this->litera;
        $menu_item = DB::table('mitems')->where('alias', $litera)->first();
        $submenu_item = FALSE;
        if (!is_null($request->route('alias'))) {
            $submenu_item = DB::table('pages')->where([
                    ['mitem_id', $menu_item->id],
                    ['alias', $request->route('alias')]
                ])->first();
        }

        if ( $menu_item || $submenu_item ) {

            $page_alias = $request->route()->alias;

            $this->title = $menu_item->title;
            $this->meta_desc = $menu_item->title;
            $this->keywords = $menu_item->title;
            if ($submenu_item) {
                $this->title = $submenu_item->name;
                $this->meta_desc = $submenu_item->name;
                $this->keywords = $submenu_item->name;
            }

            $comments = Comment::take(Config::get('settings.collect_articles_pages_comments_count'))->orderBy('created_at','desc')->get();
            $new_products = Product::where('new','1')->take(5)->orderBy('created_at','desc')->get();
            $hits_products = Product::where('hits','1')->take(5)->orderBy('created_at','desc')->get();
            $sale_products = Product::where('sale','1')->take(5)->orderBy('created_at','desc')->get();
            $spec_products = Product::where('spec','1')->take(5)->orderBy('created_at','desc')->get();
            $litera_pages = Page::where('mitem_id', $menu_item->id)->paginate(3);
            $upcomming = Upcomming::orderBy('created_at','desc')->first();
            $upcomming_txt = array();
            if (is_object($upcomming)) {
                $upcomming_txt = array_slice(array_chunk(explode(" " ,$upcomming->banner_text), 3), 0, 5);
            }
            $token = str_random(25);
            $banns = Banner::take(3)->orderBy('position','asc')->get();

            $banners = array();
            $banner2txt = array();
            $upcomming_txt = array();
            $i = false;
            foreach ($banns as $key => $bann) {
            $nme = '';
            $prce = 0;
            $pid = 1;
            if(is_object($bann->product)) {
                $nme = $bann->product->name;
                $prce = $bann->product->price;
                $pid = $bann->product->id;
            }
            $banner = array('text' => $bann['text'], 'images' => $bann['images'], 'name' => $nme, 'price' => $prce, 'id' => $pid);
                array_push($banners, $banner);
                if (!empty($banner['text'])) {
                    $i = $key;
                }
            }
            if (!empty($banners)) {
                $banner2txt = array_slice(array_chunk(explode(" " ,$banners[$i]['text']), 2), 0, 5);
            }
            if (is_object($upcomming) && $upcomming->banner_text) {
                $upcomming_txt = array_slice(array_chunk(explode(" " ,$upcomming->banner_text), 2), 0, 5);
            }

            $collect_pages = FALSE;
            if (is_null($page_alias) && ($menu_item->mtype_id == 2) ) {
                $collect_pages = TRUE;
                $page = FALSE;
            }

            $drop_down_pages = FALSE;
            if (!is_null($page_alias) && ($menu_item->mtype_id) == 2 ) {
                if ( $page_alias && $submenu_item && $page_alias == $submenu_item->alias) {
                    $drop_down_pages = TRUE;
                    $page = Page::where('alias', $submenu_item->alias)->first();
                } else {
                    $drop_down_pages = FALSE;
                    abort(404);
                }
                
            }

            $single_pages = FALSE;
            if (is_null($page_alias) && ($menu_item->mtype_id == 1) ) {
                $single_pages = TRUE;
                $page = Page::where('mitem_id', $menu_item->id)->first();
            }

            $litera_page_blocks = array();
            if (is_object($page)) {
                $page_blocks = $page;
            } else { 
                $page_blocks = Page::where('alias', $this->litera)->first();//->blocks;
            }
            if (is_object($page_blocks)) {
                foreach ($page_blocks->blocks as $value) {
                    $block = $value->name;
                    array_push($litera_page_blocks, $block);
                }
            }

            if (view()->exists('site.' . $litera)) {
                $data = $this->m_rep->getData($this->title,$this->meta_desc,$this->keywords,$this->company);
                return view('site.' . $litera, 
                    [
                        'litera' => $litera,
                        'collect_pages' => $collect_pages,
                        'drop_down_pages' => $drop_down_pages,
                        'single_pages' => $single_pages,
                        'menu_item' => $menu_item,
                        'comments' => $comments,
                        'new_products' => $new_products,
                        'hits_products' => $hits_products,
                        'sale_products' => $sale_products,
                        'spec_products' => $spec_products,
                        'litera_pages' => $litera_pages,
                        'page' => $page,
                        'banners' => $banners,
                        'banner2txt' => $banner2txt,
                        'upcomming' => $upcomming,
                        'upcomming_txt' => $upcomming_txt,
                        'token' => $token,
                        'litera_page_blocks' => $litera_page_blocks,
                        'i' => $i,

                    ] )->with($data);
            }

        }
        abort(404);

    }

}
