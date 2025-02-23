<?php

namespace App\Services;

class PaymentNoteService
{
    /**
     * Create a new class instance.
     */
    public $payment_note;

    public function __construct($payment_note)
    {
        $this->payment_note = $payment_note;
    }

    public function update_amount()
    {
        $this->payment_note->amount = $this->payment_note->payment_note_amount_collectors->sum('value');
        $this->payment_note->save();
    }
    
}
