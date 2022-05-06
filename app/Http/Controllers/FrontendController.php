<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontendController extends Controller
{
    public function index() {
        return view('spa');
    }

    public function get_ias_cat_id() {
        $data = DB::table('applications')->where('app_name', 'IAS')->select('cat_id')->get();
        return response()->json($data);
    }

    public function get_checkout_category($app_id, $cat_id) {
        switch ($app_id) {
            case '1':
                $app_name = 'IAS';
                break;
        }
        $category_data = DB::table('applications')->where('app_name', $app_name)->where('cat_id', $cat_id)->first();
        return response()->json($category_data);
    }

    public function get_dealer_checkout_category($app_id, $cat_id) {
        switch ($app_id) {
            case '1':
                $app_name = 'IAS';
                break;
        }
        $category_data = DB::table('applications')->where('app_name', $app_name)->where('cat_id', $cat_id)->first();
        return response()->json($category_data);
    }
    
    public function get_customer_transaction_by_userid($id) {
        $data = DB::table('transactions')->where('user_id', $id)->get();
        return response()->json($data);
    }

    public function get_customer_purchaselist_by_userid($id) {
        $data = DB::table('customer_purchases')->where('user_id', $id)->get();
        return response()->json($data);
    }

    public function get_purchaseID_by_userID($id) {
        $purchased_data = DB::table('customer_purchases')->where('user_id', $id)->leftJoin('applications', 'customer_purchases.cat_tab', '=', 'applications.category_tab')->select('customer_purchases.*', 'applications.cat_id')->get();

        return response()->json($purchased_data);
    }
}
