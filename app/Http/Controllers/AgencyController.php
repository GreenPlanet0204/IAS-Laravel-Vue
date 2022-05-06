<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Agency_email_send;
use DB;
use Exception;
use Mail;

class AgencyController extends Controller
{
    public function agency_rejection(Request $request) {
        $input = $request->all();
        $user_email = DB::table('users')->where('id', $input['user_id'])->value('email');
        try {
            DB::table('users')->where('id', $input['user_id'])->update(['permission' => 'deny']);

            $emailData['status'] = 'reject';
            $emailData['message'] = 'Your registration request rejected';

            \Mail::to($user_email)
                    ->send(new Agency_email_send($emailData));

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            echo ($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        
    }

    public function agency_approve(Request $request) {
        $input = $request->all();
        $user_email = DB::table('users')->where('id', $input['user_id'])->value('email');
        try {
            DB::table('users')->where('id', $input['user_id'])->update(['permission' => 'approved']);

            $emailData['status'] = 'approve';
            $emailData['message'] = 'Your registration request approved.';

            \Mail::to($user_email)
                    ->send(new Agency_email_send($emailData));

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            echo ($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        
    }

    public function agency_pending(Request $request) {
        $input = $request->all();
        $user_email = DB::table('users')->where('id', $input['user_id'])->value('email');
        try {
            DB::table('users')->where('id', $input['user_id'])->update(['transaction_con' => $input['transaction_con']], ['deposit_amount' => $input['deposit_amount']]);

            $emailData['status'] = 'pending';
            $emailData['message'] = 'Your transaction condition and deposit amount are modified.';
            $emailData['transaction_con'] = $input['transaction_con'];
            $emailData['deposit_amount'] = $input['deposit_amount'];
            $emailData['user_id'] = $input['user_id'];

            \Mail::to($user_email)
                    ->send(new Agency_email_send($emailData));

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            echo ($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        
    }

    public function accept($id) {
        $user_email = DB::table('users')->where('id', $id)->value('email');
        try {
            DB::table('users')->where('id', $id)->update(['permission' => 'approved']);

            $emailData['status'] = 'accept';
            $emailData['message'] = 'Agency agreed new transaction condition.';

            \Mail::to('support@lifeanalytics.org')
                    ->send(new Agency_email_send($emailData));

            return true;
        } catch (\Exception $e) {
            echo ($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        
    }

    public function cancel($id) {
        $user_email = DB::table('users')->where('id', $id)->value('email');
        try {
            DB::table('users')->where('id', $id)->update(['permission' => 'deny']);

            $emailData['status'] = 'cancel';
            $emailData['message'] = 'Your registration request approved.';

            \Mail::to('support@lifeanalytics.org')
                    ->send(new Agency_email_send($emailData));
            
            return true;
        } catch (\Exception $e) {
            echo ($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        
    }
}
