<?php

function mydebug($array){
    echo '<pre>';
    print_r(isset($array)?$array:null);
    die();
}

function randomString($limit = 4, $with_numbers = true) {
    $characters = $with_numbers
        ? '0123456789'
        : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';
    for ($i = 0; $i < $limit; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $randomString;
}


