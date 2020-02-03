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
     * @var string|null
     */
    private $attachmentPath;

    /**
     * Greeting constructor.
     * @param string $name
     * @param int $messages
     * @param string $attachmentPath
     */
    public function __construct(string $name, int $messages, string $attachmentPath = null)
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
        $build = $this->view('emails.greeting')
            ->subject('Header')
            ->with([
                'name' => $this->name,
                'messages' => $this->messages,
            ]);

        if (null !== $this->attachmentPath) {
            $build->attach($this->attachmentPath, [
                'as' => basename($this->attachmentPath),
                'mime' => 'plaintext',
            ]);
        }

        return $build;
    }
}
