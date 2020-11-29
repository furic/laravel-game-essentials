<?php
// Games
$app->get('/games/{gameId}', 'GameController@show');
$app->get('/games/{gameId}/versions', 'GameController@showVersions');

// Players
$app->get('/players/{playerId}', 'PlayerController@show');
$app->get('/players/name/{playerName}', 'PlayerController@showId');
$app->post('/players', 'PlayerController@create');
$app->post('/players/{playerId}', 'PlayerController@update');

// Player Games
$app->get('/games/{gameId}/players', 'PlayerGameController@showPlayers');