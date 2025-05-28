<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendActionMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $subject;
    protected $content;
    protected $recipient;
    protected $cc;
    protected $replyTo;

    public function __construct($subject, $content, $recipient, $cc = null, $replyTo = null)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->recipient = $recipient ?? 'test@gmail.com';
        $this->cc = $cc;
        $this->replyTo = $replyTo;
    }


    public function handle()
    {
        Mail::send('mail', ['newContain' => $this->content], function ($message) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            // $message->from('test@gmail.com');
            $message->to($this->recipient);
            $message->subject($this->subject);
            if ($this->replyTo) {
                $message->replyTo($this->replyTo); 
            }
            if ($this->cc) {
                $message->cc($this->cc);
            }
        });
    }
}