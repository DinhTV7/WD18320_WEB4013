<?php

namespace App\Mail;

use App\Models\SanPham;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $sanPham;

    /**
     * Create a new message instance.
     */
    public function __construct(SanPham $sanPham)
    {
        $this->sanPham = $sanPham;
    }

    /**
     * Build the message.
     */
    public function build () {
        return $this->subject('Xác nhận thêm sản phẩm')
            ->markdown('admins.mails.mailconfirm')
            ->with('sanPham', $this->sanPham);
    }
}
