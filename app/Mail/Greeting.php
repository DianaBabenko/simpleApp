<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

/**
 * Class Greeting
 * @package App\Mail
 */
class Greeting extends Mailable
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var int $messages
     */
    private $messages;

    /**
     * @var string
     */
    private $attachmentPath;

    /**
     * Greeting constructor.
     * @param string $name
     * @param int $messages
     * @param string $attachmentPath
     */
    public function __construct(string $name, int $messages, string $attachmentPath)
    {
        $this->name = $name;
        $this->messages = $messages;
        $this->attachmentPath = $attachmentPath;
    }


    /**
     * @return Greeting
     */
    public function build(): Greeting
    {
        return $this->view('emails.greeting')
            ->subject('Header')
            ->attach($this->attachmentPath, [
                'as' => basename($this->attachmentPath),
                'mime' => 'plaintext',
            ])
            ->with([
                'name' => $this->name,
                'messages' => $this->messages,
            ]);
    }
}
