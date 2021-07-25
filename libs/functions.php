<?php
function debug($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function floatToInt($n) {
    $n = (string) $n;
    $arr = explode('.',$n, 2);
    if(isset($arr[1])) {
        return (float) $n;
    }
    return (int) $n;
}