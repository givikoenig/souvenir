<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Http\Request;
use Route;
use App\Page;
use App\Brand;
use App\Subbrand;
use App\Mitem;
use App\Category;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();

            switch($statusCode) {
                case '404' :
                \Log::alert('Page not found - '. $request->url());
                $this->title = 'Страница не найдена';

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
                $categories = Category::all();

                // Footer
                $main_page = Page::where('alias','home')->first();
                $blog_page = Category::where('parent_id',0)->first();

                $data = [
                'title' => $this->title,
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

                return response()->view('errors.404', $data, 404);
            }

        }

        if ($exception instanceof MethodNotAllowedHttpException)
        {
            abort(404);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
