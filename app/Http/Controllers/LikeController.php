<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Auth;
use App\Like;

class LikeController extends Controller
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
        $data = $request->except('_token','like_article_ID','like_user_ID');
        $data['article_id'] = $request->input('like_article_ID');
        $data['user_id'] = $request->input('like_user_ID');

        $validator = Validator::make($data,[
            'article_id' => 'integer|required',
            'user_id' => 'integer|required',
        ]);

        if($validator->fails()) {
            return \Response::json(['error'=>$validator->errors()->all()]);
        }

        $like = new Like($data);

        $double = !is_null(Like::where([
                ['user_id', $data['user_id']],
                ['article_id', $data['article_id']]
            ])->first());

        $double ? $data['double'] = 'double' : '';

        if (!$double) {
            $like->save();
        }

        return \Response::json(['success' => TRUE, 'data' => $data]);

    }

}
