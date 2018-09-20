<?php
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    Storage::put('GGGGGG.txt', 'Contents');
    Storage::get('GGGGGG.txt');
    $bot->reply('Hello!');
});
$botman->hears('.*(Play|Speak|play|speak).*', BotManController::class.'@startConversation');
$botman->hears('list locals', BotManController::class.'@localesMenu');

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});
