<?php

use App\Learning\Main;

Route::get('/', function () {

    Main::execute();

});