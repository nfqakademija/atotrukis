<?php

namespace Atotrukis\MainBundle\Service;

class DateFormatService
{
    function changeDate($time)
    {
        $date = "";
        if ($time->format("Y-m-d") == (new \DateTime())->format("Y-m-d")) {
            $date .= "Šiandien ";
        } elseif ($time->format("Y-m-d") == (new \DateTime("tomorrow"))->format("Y-m-d")) {
            $date .= "Rytoj ";
        } else {
            $mon = $time->format('n');
            $months = array("Sausio", "Vasario", "Kovo", "Balandžio", "Gegužės", "Birželio",
                "Liepos", "Rugpjūčio", "Rugsėjo", "Spalio", "Lapkričio", "Gruodžio");
            if ($time->format('Y') != (new \DateTime())->format('Y')) {
                $date .= $time->format('Y \m. ');
            }
            $date .= $months[$mon - 1];
            $date .= $time->format(' j \d. ');
        }
        $date .= $time->format("H:i");
        return $date;
    }
}