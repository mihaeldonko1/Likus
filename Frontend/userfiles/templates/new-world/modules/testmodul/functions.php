<?php

use App\Http\Controllers\WebserviceController;

function test(){
    $RawItems = WebserviceController::test();
    return $RawItems;
}