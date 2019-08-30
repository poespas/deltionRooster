<?php
require_once(__DIR__ . "/../vendor/autoload.php");


class ConvertRooster {
    public $data = null;

    function __construct($data) {
        $this->data = $data;
    }

    function toIcal() {
        $cal = new \Eluceo\iCal\Component\Calendar('roosters.deltion.nl');

        foreach ($this->data as $day) {
            foreach ($day["items"] as $lesson) {
                $event = new \Eluceo\iCal\Component\Event();

                $start = new \DateTime();
                    $start->setTimestamp(($lesson["st"] / 1000));
                $end = new \DateTime();
                    $end->setTimestamp(($lesson["et"] / 1000));

                $event
                    ->setDtStart($start)
                      ->setDtEnd($end)
                    ->setSummary($lesson["v"] . " - " . $lesson["r"] . " - " . $lesson["l"])
                    ->setUseTimezone(true);
                
                $cal->addComponent($event);
            }
        }

        return $cal->render();

    }
}