<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Mail\Mailable;

class PaymentRejectedMail extends Mailable
{
    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $code = $this->booking->booking_code ?: ('#' . $this->booking->id);
        return $this->subject('Payment Rejected: ' . $code)
            ->view('emails.payment_rejected');
    }
}

