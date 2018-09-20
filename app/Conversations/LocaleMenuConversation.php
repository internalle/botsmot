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

        $foods = ["Погача","Ѓеврек","Дебармалски"];
        $question = Question::create("Please choose a local?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason');
   /*         ->addButtons([
                Button::create('Tell a joke')->value('joke'),
            ]);*/

   foreach ($locals as $local) {
       $question->addButton(Button::create($local)->value('silbo_1'));
   }
        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'joke') {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);
                } else {
                    $this->say('Please choose from the menu');
                    $foods = ["Погача","Ѓеврек","Дебармалски"];
                    $question_foods = Question::create("Одберете од менито")
                        ->fallback('Unable to ask question')
                        ->callbackId('ask_foods');

                    foreach ($foods as $local) {
                        $question_foods->addButton(Button::create($local)->value('silbo_1'));
                    }
                }
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
