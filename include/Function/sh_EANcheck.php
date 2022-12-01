<?php 

function sh_EANcheck($ean) {
    $ean = strrev($ean);
    // Split number into checksum and number
    $checksum = substr($ean, 0, 1);
    $number = substr($ean, 1);
    $total = 0;
    for ($i = 0, $max = strlen($number); $i < $max; $i++) {
        if (($i % 2) == 0) {
            $total += ($number[$i] * 3);
        } else {
            $total += $number[$i];
        }
    }
    $mod = ($total % 10);
    $calculated_checksum = (10 - $mod);
    if ($calculated_checksum == $checksum) {
        return true;
    } else {
        return false;
    }
}