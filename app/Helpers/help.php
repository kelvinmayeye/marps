<?php

function mydebug($array){
    echo '<pre>';
    print_r(isset($array)?$array:null);
    die();
}
