<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\Contact_send;

class ContactController extends Controller
{
    /**
     * Contact email
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */    
    public function contact_store_send(Request $request) {

        $input = $request->all();
        Validator::make($input, [
            'message'=> 'required',
            'name'=> 'required|string',
            'email'=> 'required|email',
            'phone'=> 'required',
        ])->validate();

        $file = $request->file('file');
        if($file) {
            $file_name = time()."_".$file->getClientOriginalName();
            $input['file'] = $file_name;
        } else {

        }

        $contact = Contact::create($input);

        if($contact && $file) {
            $destinationPath = public_path('upload/contact');
            $file->move($destinationPath, $file_name);
        }

        //Send mail to admin

        $mail_check = Mail::to('support@lifeanalytics.com', 'Daisukekubota')
            ->send(new contact_send($contact));

        return $mail_check;
    }
}
