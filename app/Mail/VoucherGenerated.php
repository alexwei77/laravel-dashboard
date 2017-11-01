<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Vouchers;

class VoucherGenerated extends Mailable
{
    use Queueable, SerializesModels;

    public $customer_data;
    public $all_vouchers;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Vouchers $customer_data, $all_vouchers)
    {
        $this->customer_data = $customer_data;
        $this->all_vouchers = $all_vouchers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.vouchers.vouchergenerated')->subject("StaffLife Vouchers");
    }
}
