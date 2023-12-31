<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Log;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('channel', function (Request $request) {
    Log::info('ROUTE CHANNEL', $request->all());
    return true;
});
Broadcast::channel('private-channel', function (Request $request) {
    Log::info('ROUTE CHANNEL', $request->all());
    return true;
});
