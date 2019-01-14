<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $plan = 'Надоело котам в Абакане От безделья дремать на диване, Сев за первую парту Изучают с азартом Поведение мышки в капкане.';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('hello@app.com', 'Ваше приложение')
        // ->subject('Ваше напоминание!')
        ->subject('Напоминание о событии')
        // ->view('emails.reminder');
        ->view('emails.reminder')
        // ->text('emails.reminder_plain');
        ->with([
            'eventName' => $this->event,
            'eventPlane' => $this->plan,
        ]);

    }

}
