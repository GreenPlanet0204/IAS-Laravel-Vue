<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register_confirm_mail_send extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['role']=='customer') {
            return $this->view('email.customer_register_email_view')
                ->with('message', '新規顧客登録。')
                ->with('customer_email', $this->data->email)
                ->with('customer_phone', $this->data->phone);
        } elseif ($this->data->role=='agency') {
            return $this->view('email.agency_register_email_view')
                ->with('message', '新しい代理店が登録を要求しました。')
                ->with('id', $this->data->id)
                ->with('company', $this->data->company_name)
                ->with('agency_email', $this->data->email)
                ->with('company_address', $this->data->address_1)
                ->with('company_phone', $this->data->phone)
                ->with('company_website', $this->data->company_site)
                ->with('transaction_condition', $this->data->transaction_con)
                ->with('deposit_amount', $this->data->deposit_amount);
        }
    }
}
