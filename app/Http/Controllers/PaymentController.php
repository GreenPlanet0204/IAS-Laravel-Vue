<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClinet;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Order;
use Mail;
use App\Mail\payment_confirm_send;
use App\Models\Transaction;
use App\Models\Customer_purchase;
use DB;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function creditcard_checkout(Request $request) {
        $input = $request->all();
        $user = User::where('email', $input['email'])->first();
        try {
            $payment = $user->charge(
                $input['amount'],
                $input['payment_method_id']
            );

            $payment = $payment->asStripePaymentIntent();

            $order = $user->orders()
                ->create([
                    'transaction_id' => $payment->charges->data[0]->id,
                    'price' => $payment->charges->data[0]->amount
                ]);

            return $order;

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function transaction_save(Request $request) {
        $input = $request->all();
        $transaction = Transaction::create([
            'user_id' => $input['user_id'],
            'app_id' => $input['app_id'],
            'transaction_id' => $input['transaction']['id'],
            'transaction_status' => $input['transaction']['status'],
            'transaction_price' => $input['transaction']['amount']['value'],
            'payee_email' => $input['payee']['email_address'],
            'payee_id' => $input['payee']['merchant_id'],
            'payer_email' => $input['payer']['email_address'],
            'payer_id' => $input['payer']['payer_id'],
            'created_at' => date('Y-m-d h:i:s', strtotime($input['transaction']['create_time'])),
            'updated_at' => date('Y-m-d h:i:s', strtotime($input['transaction']['update_time'])),
        ]);

        if($transaction) {
            $user = DB::table('users')->where('id', $input['user_id'])->select('email', 'name')->first();
            $application = DB::table('applications')->where('id', $transaction->app_id)->select('app_name', 'category_tab', 'period_date', 'capacity', 'capacity_unit')->first();

            $payment_email_data['app_name'] = $application->app_name;
            $payment_email_data['cat_tab'] = $application->category_tab;
            $payment_email_data['period_date'] = $application->period_date;
            $payment_email_data['capacity'] = $application->capacity;
            $payment_email_data['capacity_unit'] = $application->capacity_unit;
            $payment_email_data['price'] = $transaction->transaction_price;
            $payment_email_data['app_url'] = "";  
            $payment_email_data['user_email'] = $user->email;             

            //web app send data has to be noted in here 
            // $web_app_pass = $this->transfer_email_pass($payment_email_data);
            //$payment_email_data['user_pass'] = $transaction->transaction_price; 
            
            //if web app request and response is success, save some data on customer_purchases table
            if (DB::table('customer_purchases')->where('user_id', $input['user_id'])->where('app_name', $application->app_name)->first()) {
                $period_date = DB::table('customer_purchases')->where('user_id', $input['user_id'])->where('app_name', $application->app_name)->value('period_date');
                $payment_email_data['period_date'] = $application->period_date + $period_date;
                Customer_purchase::where('user_id', $input['user_id'])->where('app_name', $application->app_name)->update([
                    'cat_tab' => $payment_email_data['cat_tab'],
                    'period_date' => $payment_email_data['period_date'],
                    'capacity' => $payment_email_data['capacity'],
                    'capacity_unit' => $payment_email_data['capacity_unit']

                ]);
            } else {
                Customer_purchase::create([
                    'user_id' => $input['user_id'],
                    //'app_url' => $payment_email_data['app_url'],
                    'app_name' => $payment_email_data['app_name'],
                    'cat_tab' => $payment_email_data['cat_tab'],
                    'period_date' => $payment_email_data['period_date'],
                    'capacity' => $payment_email_data['capacity'],
                    'capacity_unit' => $payment_email_data['capacity_unit']
                ]);
            }            
            
            //if customer_purchase table save is success, send email to customer
            //sending data is payment_data, web_app url, user_email and user_pass

            // $payment_email_check = Mail::to($user->email, $user->name)
            // ->send(new payment_confirm_send($payment_email_data));

            return response()->json($transaction->transaction_id);

        } else {
            return false;
        }
    }

    public function request_to_app(Request $request) {
        $input = $request->all();
        //definition sending data to web application
        $send_to_app_data['user_email'] = $input['email'];
        $send_to_app_data['app_url'] = "";
        $send_to_app_data['app_name'] = $input['app_name'];
        $send_to_app_data['cat_tab'] = $input['category_tab'];
        $send_to_app_data['period_date'] = $input['period_date'];
        $send_to_app_data['capacity'] = $input['capacity'];
        $send_to_app_data['capacity_unit'] = $input['capacity_unit'];
        $send_to_app_data['price'] = $input['transaction_price'];

        //web app send data has to be noted in here 
        $web_app_pass = $this->transfer_email_pass($send_to_app_data);
        //$send_to_app_data['user_pass'] = $transaction->transaction_price; 
        
        //if customer_purchase table save is success, send email to customer
        //sending data is payment_data, web_app url, user_email and user_pass

        // $payment_email_check = Mail::to($user->emailinput['email'], $input['user_name'])
        // ->send(new payment_confirm_send($send_to_app_data));

        return true;
    }

    public function paypal_checkout(Request $request) {
        $input = $request->all();
    }

    public function transfer_checkout(Request $request) {
        print_r($request->all());
    }

    public function furikomi_checkout(Request $request) {
        print_r($request->all());
    }

    public function dealer_application_checkout(Request $request) {
        print_r($request->all());
    }

    public function get_payment_confirmData($id) {
        $data = DB::table('transactions')->where('transaction_id', $id)->join('users', 'transactions.user_id', '=', 'users.id')->join('applications', 'transactions.app_id', '=', 'applications.id')->select('transactions.*', 'users.name', 'users.nikename', 'users.email', 'users.photo_url', 'users.phone', 'applications.app_name', 'applications.category_tab', 'applications.period_date', 'applications.capacity', 'applications.capacity_unit')->first();
        return response()->json($data);
    }

    protected function transfer_email_pass(array $payment_email_data) {
        print_r($payment_email_data);
        // $response = Http::get('https://www.guru.com');
        // return $response;
        $client = new Client();
        $res = $client->request('GET', 'https//www.guru.com');
        print_r($res->getBody());
    }
}
