<?php
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('Hi', function (Botman $bot) {
    $bot->reply('Hello!');
});
$botman->hears('.*(Play|Speak|play|speak).*', BotManController::class.'@startConversation');
//$botman->hears('list locals', BotManController::class.'@localesMenu');

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
    $bot->reply('Hi');
    $bot->reply('Play');
    $bot->reply('list locals');
});
