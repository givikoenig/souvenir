<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PblRepository;

use Validator;
use App\Comment;
use App\Article;

class CommentEditController extends Controller
{
	protected $p_rep;

	public function __construct(PblRepository $p_rep) {
        $this->p_rep = $p_rep;
    }
    //
    public function execute(Comment $comment, Request $request) {
        $permit = $this->p_rep->checkEnter();
        $ords_new = $this->p_rep->checkNewOrders();
        if ($permit) {
        	$arts = Article::all();
        	$currpos = 1;
                foreach ($arts as $key => $art) {
                	if ($art->alias == $comment->article->alias) {
                		$currpos = $key + 1;
                	}
                }
        	if ($request->isMethod('delete')) {
        		$comment->delete();
        		return redirect('admin/comments?page=' . $currpos)->with('status','Комментарий удален');
        	}

        	if ($request->isMethod('post')) {
        		$input = $request->except('_token');
        		$messages = [
        			'required' => 'Поле :attribute обязательно к заполнению',
        			'max' => 'Поле :attribute должно быть не более :max символов',
        		];
        		$validator = Validator::make($input,[
                        'text' => 'required|max:1000',
                    ], $messages);
        		if ($validator->fails()) {
                    return redirect()
                        ->route('commentEdit',['comment'=>$input['id']])
                        ->withErrors($validator);
                }
                $comment->fill($input);
                
                if ($comment->update()) {
                	return redirect('admin/comments?page=' . $currpos)->with('status','Комментарий обновлен');
                }
                unset($input);
        	}

        	$old = $comment->toArray();
        	$data = [
	            'title' => 'Редактирование комментария ',
	            'data' => $old,
                'comment' => $comment,
	            'ords_new' => $ords_new,
	        ];

	    	if (view()->exists('admin.comment_edit')) {
            
            	return view('admin.comment_edit',$data);
	        }
	        abort(404);
        }
		return redirect('profile');
	}
}
