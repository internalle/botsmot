<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('.*(Play|Speak|play|speak).*', BotManController::class.'@startConversation');
$botman->hears('list locals', BotManController::class.'@localesMenu');

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});
