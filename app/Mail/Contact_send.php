<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class Contact_send extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Contact instanced
     * 
     * @var App\Models\Contact
     */

    protected $contact;

    /**
     * Create a new message instance.
     *
     * @param App\Models\Contact $contact
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->contact->email, $this->contact->name)
                        ->view('email.contact_email_view')
                        ->with([
                            'contact_name' => $this->contact->name,
                            'contact_email' => $this->contact->email,
                            'contact_phone' => $this->contact->phone,
                            'contact_message' => $this->contact->message,
                        ]);
    }
}
