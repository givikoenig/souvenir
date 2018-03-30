<?php

namespace App\Http\Controllers\Auth;
// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Config;

use App\Product;
use App\Brand;
use App\Subbrand;
use App\Page;
use App\Mitem;
use App\Category;

use App\User;

// use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $company;

    public function showLoginForm()
    {
        $this->company = 'Souvenir Co.';

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
        foreach ($mitems as $mitem) {
            $item = array('id' => $mitem->id,'title'=>$mitem->title, 'type'=>$mitem->mtype_id,'alias'=>$mitem->alias);
                array_push($menu,$item);
        }

        // Footer
        $main_page = Page::where('alias','home')->first();
        $blog_page = Category::where('parent_id',0)->first();

        return view('auth.login',[
                'menu' => $menu,
                'mitems' => $mitems,
                'brands' => $brands,
                'subbrands' => $subbrands,
                'main_page' => $main_page,
                'brands_page' => $brands_page,
                'blog_page' => $blog_page,
                'page_blocks' => $page_blocks,
                'company' => $this->company,

            ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectTo()
    {

       $confirmed = User::where('email', $_POST['email'])->first()->confirmed;
       if($confirmed == 1) {
            if(!empty($_POST['croute'])) {
                $return  = url('/'.$_POST['croute']);
            } else {
                $return  = url('/profile');
            }
            return $return;
        } else {
            return url('/logout');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        
        $request->session()->flush();

        $request->session()->regenerate();

        // return back();
        return redirect()->route('brands');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

}
