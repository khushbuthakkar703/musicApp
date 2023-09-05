<?php

Route::get('/', 'ArtistManagerController@index')->middleware('artistmanager');
Route::get('/loginas', 'ArtistManagerController@loginas')->middleware('artistmanager')->name('artistmanager.loginas');