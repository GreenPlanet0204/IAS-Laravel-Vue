<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Agency_email_send extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->data = $emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->data->status == 'reject' || $this->data->status == 'approve' || $this->data->status == 'accept' || $this->data->status == 'cancel') {
            return $this->from('support@lifeanalytics.org', 'Lifeanalytics')
                        ->view('email.agency_email_send')
                        ->with([
                            'status' => $this->data->status,
                            'message' => $this->data->message
                        ]);
        } elseif ($this->data->status == 'pending') {
            return $this->from('support@lifeanalytics.org', 'Lifeanalytics')
                        ->view('email.agency_email_send')
                        ->with([
                            'id' => $this->data->user_id,
                            'status' => $this->data->status,
                            'message' => $this->data->message,
                            'transaction_con' => $this->data->transaction_con,
                            'deposit_amount' => $this->data->deposit_amount
                        ]);
        }
        
    }
}
