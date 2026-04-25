<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Tool;

class PurchaseSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tool;

    public function __construct(User $user, Tool $tool)
    {
        $this->user = $user;
        $this->tool = $tool;
    }

    public function build()
    {
        return $this->subject('Order Successful - ' . $this->tool->name)
                    ->view('emails.purchase_success');
    }
}
