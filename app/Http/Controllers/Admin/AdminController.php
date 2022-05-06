<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class AdminController extends Controller
{
    public function fetch_users() {
        $users = DB::table('users')->select(['id', 'name', 'nikename', 'email', 'phone', 'role', 'permission','created_at'])->get();
        return response()->json($users);
    }

    public function fetch_user_id($id) {
        $user = DB::table('users')->where('id', $id)->first();
        $user = json_decode(json_encode($user), true);
        $usermetas = DB::table('usermetas')-> where('user_id', $id)->get();
        foreach($usermetas as $usermeta) {
            $user[$usermeta->key] = $usermeta->value;
        }
        return response()->json($user);
    }

    public function user_role_update(Request $request) {
        $input = $request->all();
        print_r($input);
        $check = DB::table('users')->where('id', $input['user_id'])->update(['role' => $input['role'], 'permission' => $input['permission']]);
        if($check) {
            $user = DB::table('users')->where('id', $input['user_id'])->first();
            $user = json_decode(json_encode($user), true);
            $usermetas = DB::table('usermetas')-> where('user_id', $input['user_id'])->get();
            foreach($usermetas as $usermeta) {
                $user[$usermeta->key] = $usermeta->value;
            }
            return response()->json($user);
        } else {
            return response()->json(['message' => 'update is faild.']);
        }
    }

    public function fetch_applications() {
        $apps = DB::table('applications')->get();
        return response()->json($apps);
    }

    public function fetch_application_by_id($id) {
        $app = DB::table('applications')->where('id', $id)->first();
        return response()->json($app);
    }

    public function application_create(Request $request) {
        $data = $request->all();
        Validator::make($data, [
            'app_name' => 'required',
            'cat_id' => 'required|numeric',
            'cat_tab' => 'required',
            'currency' => 'required',
            'price' => 'required|numeric',
            'period_date' => 'required|numeric',
            'capacity' => 'required|numeric',
            'capacity_unit' => 'required'
        ])->validate();
        
        if ($data['currency']=='jp') {
            $data['price'] = $data['price']/100;
            if ($data['discount_price']!='' && $data['discount_price']!='0') {
                $data['discount_price'] = $data['discount_price']/100;
            }
        }

        $check = DB::table('applications')->insert([
            'app_name' => $data['app_name'],
            'cat_id' => $data['cat_id'],
            'category_tab' => $data['cat_tab'],
            'period_date' => $data['period_date'],
            'capacity' => $data['capacity'],
            'capacity_unit' => $data['capacity_unit'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'discount_price' => $data['discount_price']
        ]);

        return $check;
    }

    public function application_update(Request $request) {
        $data = $request->all();
        Validator::make($data, [
            'cat_tab' => 'required',
            'price' => 'required|numeric',
            'period_date' => 'required|numeric',
            'capacity' => 'required|numeric',
            'capacity_unit' => 'required'
        ])->validate();

        $check = DB::table('applications')->where('id', $data['app_id'])->update([
            'category_tab' => $data['cat_tab'],
            'period_date' => $data['period_date'],
            'capacity' => $data['capacity'],
            'capacity_unit' => $data['capacity_unit'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'discount_price' => $data['discount_price']
        ]);

        return $check;
    }
}
