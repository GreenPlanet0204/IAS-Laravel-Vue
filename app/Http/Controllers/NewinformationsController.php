<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class NewinformationsController extends Controller
{
    public function get_informations($lang) {
        $data = DB::table('new_informations')->where('lang_page', $lang)->leftJoin('users', 'new_informations.user_id', '=', 'users.id')->select('new_informations.*', 'users.name', 'users.nikename', 'users.email', 'users.photo_url')->get();
        
        return response()->json($data);
    }

    public function get_info_detail_data($id) {
        $data = DB::table('new_informations')->where('id', $id)->first();
        return response()->json($data);
    }

    public function new_information_create(Request $request) {
        $data = $request->all();
        Validator::make($data, [
            'lang_page' => 'required',
            'display_page' => 'required',
            'title' => 'required',
            'content' => 'required'
        ])->validate();

        if($data['date']=="") {
            $data['date'] = date("Y-m-d h:i:s");
        }

        $check = DB::table('new_informations')->insert([
            'user_id' => $data['user_id'],
            'lang_page' => $data['lang_page'],
            'display_page' => $data['display_page'],
            'title' => $data['title'],
            'content' => $data['content'],
            'created_at' => $data['date']
        ]);

        return $check;
    }

    public function information_update(Request $request) {
        $input = $request->all();

        $check = DB::table('new_informations')->where('id', $input['info_id'])->update([
            'title' => $input['title'],
            'content' => $input['content']
        ]); 
        
        if($check) {
            $data = DB::table('new_informations')->where('id', $input['info_id'])->first();
            return response()->json($data);
        }
    }

    public function get_dealer_informations($lang) {
        $data = DB::table('new_informations')->where('display_page', 'dealer')->where('lang_page', $lang)->leftJoin('users', 'new_informations.user_id', '=', 'users.id')->select('new_informations.*', 'users.name', 'users.nikename', 'users.email')->get();
        
        return response()->json($data);
    }
}
