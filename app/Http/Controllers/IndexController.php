<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Config;
use App\Brand;
use App\Slider;
use App\Mitem;
use App\Mtype;
use App\Page;
use App\Subbrand;
use App\Product;
use App\Block;
use App\Banner;
use App\Upcomming;
use App\Subscriber;
use App\Category;
use App\Article;
use App\User;
use App\Models\Role;
use App\Models\Permission;
use Cart;
// use Notification;
use Mail;
use App;
use DB;
use Validator;
use IP2LocationLaravel;
use Igaster\LaravelCities\Geo;

class IndexController extends Controller
{

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

    public function execute(Request $request) {

        $this->title = 'Souvenir Co.';
        $this->meta_desc = 'Souvenir Co.';
        $this->keywords = 'Souvenir Co.';
        $this->company = 'Souvenir Co.';

        //=======roles/permissions seeding ================//
        // $guest_role_id = Role::where('name', 'guest')->first()->id;
        // dd($guest_role_id);

        // $users = User::all();
        // foreach ($users as  $usr) {
        //     if ($usr->hasRole('commenter')) {
        //        dump($usr->name);
        //     }
        // }

        // $user2 = User::where('id', 36)->first();
        // $user2->attachRole($guest_role_id);
        // $ss = $user2->hasRole('admin');
        // dd($ss);

        //  $options = array(
        //     'validate_all' => false,
        //     'return_type' => 'array'
        // );
        // $ss = $user2->ability('commenter','make-comments', $options);


    //===================geolocation==================//
    
        // $records = IP2LocationLaravel::get('195.135.212.117');

        // dump($records['cityName']);    
        // dump($records['regionName']); 
        // dd($records);   

        // dd($_SERVER);

    //================= geonames ======================//

        // $geo = new Geo();
        // dd($geo);
        // dd(Geo::getCountries());
        // dd( Geo::getByIds(['554230'])->getChildren() );


    //     $geos  =  Geo::getCountry('RU')
    // ->children()
    // ->orderBy('name')
    // ->get();
        
    //     foreach ($geos   as $geo) {
    //         dump($geo->alternames);
    //     }

        // dd( Geo::search('калинин')->get() );

        // $aa = Postindex::where('INDEX', 101000)->first();
        // dd($aa);
        

    //=================================================//

        // Cart::instance('shopping')->destroy();
        // dd(Cart::instance('wishlist')->content());
        // dd(Cart::instance('shopping')->get("c42f6beec9c93fd6afea6eb0684aa99a"));

    //============
    
        // $id = Auth::id();
        // dump(Auth::check());

    //============    
        if($request->isMethod('post') && !$request['qty']) {
                        $messages = [
                        'required' => "Поле :attribute обязательно к заполнению",
                        'email' => "Поле :attribute должно соответствовать email адресу",
                        'unique' => "Пользователь с таким E-mail адресом уже отправлял запрос на подписку. Возможно Вы ее не активировали. Проверьте Вашу почту и щелкните по ссылке для активации подписки."
                        ];

                        $this->validate($request,[
                            'email' => 'required|email|unique:subscribers',
                        ], $messages);

                        $data = $request->all();
                        
                        $created_data = $this->create($data)->toArray();

                        $data['token'] = str_random(25);

                        $subscriber = Subscriber::find($created_data['id']);
                        $subscriber->token = $data['token'];

                        if($subscriber->save()) {

                            Mail::send('emails.subscribe', ['data'=>$data], function($message) use($data) {
                                $message->to($data['email']);
                                $message->subject('Подтверждение подписки на новости');
                            });
                            return redirect(route('home'))->with('status','На Ваш E-mail было отправлено сообщение для подтверждения подписки');
                        }
                        
        }

    	$brands = Brand::with('subbrands')->get();
        $mitems = Mitem::with('pages')->get();
        $main_page = Page::where('alias','home')->first();
        $brands_page = Page::where('alias','brands')->first();
        $blog_page = Category::where('parent_id',0)->first();
        $p_blocks = $main_page->blocks;
        $categories = Category::with('articles')->get();

        $main_page_blocks = array();
        foreach ($p_blocks as $value) {
            $block = $value->name;
            array_push($main_page_blocks, $block);
        }
        $menu = array();
        foreach ($mitems as $mitem) {
            $item = array('id' => $mitem->id,'title'=>$mitem->title, 'type'=>$mitem->mtype_id,'alias'=>$mitem->alias);
            array_push($menu,$item);
        }

        $banns = Banner::take(3)->orderBy('position','asc')->get();
        $upcomming = Upcomming::orderBy('created_at','desc')->first();
        $sliders = Slider::all();
        $new_arrivals = Product::take(20)->orderBy('created_at','desc')->get();
        $articles = Article::take(Config::get('settings.article_page_comments_count'))->orderBy('created_at','desc')->get();
        $new_products = Product::where('new','1')->take(Config::get('settings.main_page_yeystoppers_count'))->orderBy('created_at','desc')->get();
        $sale_products = Product::where('sale','1')->take(Config::get('settings.main_page_yeystoppers_count'))->orderBy('created_at','desc')->get();
        $hits_products = Product::where('hits','1')->take(Config::get('settings.main_page_yeystoppers_count'))->orderBy('created_at','desc')->get();
        $spec_products = Product::where('spec','1')->take(Config::get('settings.main_page_yeystoppers_count'))->orderBy('created_at','desc')->get();
        $banners =  array();
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

        $token = str_random(25);

        // Newsletter::subscribe('givi.koenig@ya.ru', ['firstName'=>'Iv', 'lastName'=>'Gar']);

        if(view()->exists('site.index')) {
        	return view('site.index', [
                    'title' => $this->title,
                    'meta_desc' => $this->meta_desc,
                    'keywords' => $this->keywords,
                    'company' => $this->company,
                    'menu' => $menu,
        			'brands' => $brands,
                    'blog_page' => $blog_page,
                    'categories' => $categories,
        			'sliders' => $sliders,
                    'mitems' => $mitems,
                    'main_page' => $main_page,
                    'brands_page' => $brands_page,
                    'main_page_blocks' => $main_page_blocks,
                    'new_arrivals' => $new_arrivals,
                    'new_products' => $new_products,
                    'sale_products' => $sale_products,
                    'hits_products' => $hits_products,
                    'spec_products' => $spec_products,
                    'banners' => $banners,
                    'banner2txt' => $banner2txt,
                    'upcomming' => $upcomming,
                    'upcomming_txt' => $upcomming_txt,
                    'token' => $token,
                    'articles' => $articles,
                    'i' => $i
        		]);
        }
        abort(404);

    }
}
