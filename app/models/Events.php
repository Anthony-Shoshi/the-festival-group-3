<?php

namespace App\Models;

class Events{

    private int $event_id;
    private string $event_image;
    public string $event_type;
    private string $event_name;
    private string $description;
    private string $event_status;
    private string $event_start_date;
    private string $event_end_date;
    private string $event_primary_color;
    private string $event_secondary_color;

    public function getEventId()
    {
        return $this->event_id;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

    public function getEventImage()
    {
        return $this->event_image;
    }

    public function setEventImage($event_image)
    {
        $this->event_image = $event_image;
    }
    public function getEventType():string
    {
        return $this->event_type;
    }
    public function setEventType(string $event_type):void
    {
        $this->event_type = $event_type;
    }
    public function getEventName()
    {
        return $this->event_name;
    }

    public function setEventName($event_name)
    {
        $this->event_name = $event_name;
    }

    public function getEventDescription()
    {
        return $this->description;
    }

    public function setEventDescription($description)
    {
        $this->description = $description;
    }

    public function getEventStatus()
    {
        return $this->event_status;
    }

    public function setEventStatus($event_status)
    {
        $this->event_status = $event_status;
    }

    public function getEventStartDate()
    {
        return $this->event_start_date;
    }

    public function setEventStartDate($event_start_date)
    {
        $this->event_start_date = $event_start_date;
    }

    public function getEventEndDate()
    {
        return $this->event_end_date;
    }

    public function setEventEndDate($event_end_date)
    {
        $this->event_end_date = $event_end_date;
    }

    public function getEventPrimaryColor()
    {
        return $this->event_primary_color;
    }

    public function setEventPrimaryColor($event_primary_color)
    {
        $this->event_primary_color = $event_primary_color;
    }

    public function getEventSecondaryColor()
    {
        return $this->event_secondary_color;
    }

    public function setEventSecondaryColor($event_secondary_color)
    {
        $this->event_secondary_color = $event_secondary_color;
    }

}