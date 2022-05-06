<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class payment_confirm_send extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment_email_data)
    {
        $this->data = $payment_email_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.transaction_email_view')
            ->with('app_name', $this->data['app_name'])
            ->with('cat_tab', $this->data['cat_tab'])
            ->with('period_data', $this->data['period_date'])
            ->with('capacity', $this->data['capacity'])
            ->with('capacity_unit', $this->data['capacity_unit'])
            ->with('price', $this->data['price']);
    }
}
