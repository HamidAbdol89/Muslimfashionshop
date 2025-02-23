<?php 
namespace App\Mail; 
use App\Models\DonHang; 
use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Mail\Mailable; 
use Illuminate\Mail\Mailables\Content; 
use Illuminate\Mail\Mailables\Envelope; 
use Illuminate\Queue\SerializesModels; 
 
class DatHangThanhCongEmail extends Mailable 
{ 
    use Queueable, SerializesModels; 
     
    public $donhang; 
     
    /** 
     * Create a new message instance. 
     */ 
    public function __construct(DonHang $dh) 
    { 
        $this->donhang = $dh; 
    } 
     
    /** 
     * Get the message envelope. 
     */ 
    public function envelope(): Envelope 
    { 
        return new Envelope( 
            subject: 'Đặt hàng thành công tại ' . config('app.name', 'Laravel'), 
        ); 
    } 
     
    /** 
     * Get the message content definition. 
     */ 
    public function content(): Content 
    { 
        return new Content( 
            markdown: 'emails.dathangthanhcong', 
            with: [ 
                'donhang' => $this->donhang, 
            ], 
        ); 
    } 
     
    /** 
     * Get the attachments for the message. 
     * 
     * @return array<int, \Illuminate\Mail\Mailables\Attachment> 
     */ 
    public function attachments(): array 
    { 
        return []; 
    } 
}