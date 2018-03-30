<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use LaravelCaptcha\Facades\Captcha;

use Validator;
use Auth;
use App\Comment;
use App\Article;

class CommentController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token','comment_post_ID','comment_parent');
        
        $data['article_id'] = $request->input('comment_post_ID');
        $data['parent_id'] = $request->input('comment_parent');
        
        $validator = Validator::make($data,[
        
            'article_id' => 'integer|required',
            'parent_id' => 'integer|required',
            'text' => 'string|required|max:1000',
            'captcha' => 'required|bone_captcha'
        
        ]);
        
        $validator->sometimes(['name','email'],'required|max:255',function($input) {
            
            return !Auth::check();
            
        });
        
        if($validator->fails()) {
            return \Response::json(['error'=>$validator->errors()->all()]);
        }
        
        $user = Auth::user();
        
        $comment = new Comment($data);
        
        if($user) {
            $comment->user_id = $user->id;
        }
        
        $post = Article::find($data['article_id']);
        
        $post->comments()->save($comment);
        
        $comment->load('user');
        $data['id'] = $comment->id;
        $data['name'] = (!empty($data['name'])) ? $data['name'] : $comment->user->name;

        $view_comment = view('site.content_one_comment')->with('data',$data)->render();

        return \Response::json(['success' => TRUE,'comment'=> $view_comment, 'data' => $data]);       
        
        exit();

    }

}
