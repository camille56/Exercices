<?php
//== NE PAS TOUCHER
$shots = [20, 40, 17, 19, 37, 5, 37, 11, 25, 5, 9, 2, 31, 45, 5, 25, 32, 36, 27, 12, 44, 7, 13];
//== NE PAS TOUCHER

echo calculPoint($shots);

function calculPoint(array $tabShots)
{
    $pointsTotal = 0;

    foreach ($tabShots as $shot) {
        $point=0;
        switch ($shot) {
            case $shot <= 5.75:
                $point = 10;
                break;

            case $shot > 5.75 && $shot <= 13.75:
                $point = 9;
                break;
            case $shot > 13.75 && $shot <= 21.75:
                $point = 8;
                break;
            case $shot > 21.75 && $shot <= 29.75:
                $point = 7;
                break;
            case $shot > 29.75 && $shot <= 37.75:
                $point = 6;
                break;
            case $shot > 37.75 && $shot <= 45.75:
                $point = 5;
                break;
        }
        $pointsTotal+=$point;

    }
    return $pointsTotal;
}