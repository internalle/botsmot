<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class LocaleMenuConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {
        $locals = ["Пекара","Силбо","Trend"];

        $question = Question::create("Please choose a local?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason');

        foreach ($locals as $local) {
            $question->addButton(Button::create($local)->value($local));
        }

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->say($answer->getValue());
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
