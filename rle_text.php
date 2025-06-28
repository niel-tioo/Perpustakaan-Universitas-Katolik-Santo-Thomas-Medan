<?php
function rle_compress($text) {
    $output = '';
    $length = strlen($text);
    $count = 1;
    for ($i = 1; $i < $length; $i++) {
        if ($text[$i] == $text[$i - 1]) {
            $count++;
        } else {
            $output .= $count . $text[$i - 1];
            $count = 1;
        }
    }
    $output .= $count . $text[$length - 1];
    return $output;
}

function rle_decompress($encoded) {
    $output = '';
    preg_match_all('/(\\d+)(\\D)/', $encoded, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $output .= str_repeat($match[2], (int)$match[1]);
    }
    return $output;
}
?>
