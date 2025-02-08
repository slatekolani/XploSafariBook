<?php

namespace App\Mail;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

class Attachment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    protected $permit;

    /**
     * Create a new message instance.
     * @param $permit
     */
    public function __construct($permit)
    {
        $this->permit = $permit;
    }

    /**
     * Build the message.
     *
     * @return Attachment
     */
    public function build()
    {
        $permit = $this->permit;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('permit.clearance', compact('permit'));
        return $this->markdown('emails.attachment')
            ->attachData($pdf->download(), 'clearance/'.$permit->number.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
