<?php
use App\Http\Controllers\CmsController;

function getNatecaji($id_skupine) {
           $groups =  CmsController::getNatecaji($id_skupine);
           return $groups;
}