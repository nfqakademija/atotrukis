<?php

namespace Atotrukis\MainBundle\Service;

class DateFormatService
{
    /**
     * changes date format to lithuanian, shows only month and day if event takes place this year,
     * shows what event takes place today or tomorrow if it is true
     *
     * @param $time
     * @return string of date which format was changed
     */
    public function changeDate($time)
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

    /**
     * assigns changed event start date format for each event
     *
     * @param $events
     * @return array of start dates
     */
    public function startDate($events)
    {
        $date = [];
        foreach ($events as $e) {
            $date[$e->getId()] = $this->changeDate($e->getStartDate());
        }
        return $date;
    }

    /**
     * assigns changed event end date format for each event
     *
     * @param $events
     * @return array of end dates
     */
    public function endDate($events)
    {
        $date = [];
        foreach ($events as $e) {
            $date[$e->getId()] = $this->changeDate($e->getEndDate());
        }
        return $date;
    }
}