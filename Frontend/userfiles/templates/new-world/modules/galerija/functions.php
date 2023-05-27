<?php
use App\Http\Controllers\CmsController;

function getImages($id_skupine) {
           $groups =  CmsController::getImages($id_skupine);
           return $groups;
        }
