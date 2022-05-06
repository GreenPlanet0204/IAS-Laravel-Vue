<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Comment_answers;
use DB;

class CommentController extends Controller
{
    public function get_comments_by_infoid($id) {
        $data = DB::table('comments')->where('info_id', $id)->leftJoin('users', 'comments.user_id', '=', 'users.id')->select('comments.*', 'users.name', 'users.nikename', 'users.email', 'users.photo_url', 'users.phone')->get();
        return response()->json($data);
    }

    public function get_answers_get_commentid($id) {
        $data = DB::table('comment_answers')->where('comment_id', $id)->leftJoin('users', 'comment_answers.user_id', '=', 'users.id')->select('comment_answers.*', 'users.name', 'users.nikename', 'users.email', 'users.photo_url', 'users.phone')->get();
        return response()->json($data);
    }

    public function comment_post(Request $request) {
        $input = $request->all();
        $check = Comment::create($input);
        return response()->json($check);
    }

    public function comment_edit_post(Request $request) {
        $input = $request->all();
        $check = Comment::where('id', $input['id'])->update(['comment'=>$input['comment']]);
        return response()->json($check);
    }
    
    public function reply_post(Request $request) {
        $input = $request->all();
        $check = Comment_answers::create($input);
        return response()->json($check);
    }

    public function delete_comment_byid($info, $id) {
        $check = Comment::find($id)->delete();
        if($check) {            
            $data = DB::table('comments')->where('info_id', $info)->leftJoin('users', 'comments.user_id', '=', 'users.id')->select('comments.*', 'users.name', 'users.nikename', 'users.email', 'users.photo_url', 'users.phone')->get();
        }
        return response()->json($data);
    }
}
