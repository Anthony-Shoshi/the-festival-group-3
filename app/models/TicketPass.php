<?php

namespace App\Models;

use App\Interfaces\BasketItemInterface;

class TicketPass implements BasketItemInterface
{

    private int $pass_id;
    private string $passName;
    private string $passDescription;
    private int $passPrice;
    private string $passType;
    private $total_cost;



    public function __construct(
        int    $pass_id,
        string $passName,
        string $passDescription,
        int    $passPrice,
        string $passType,
        $total_cost
    )
    {
        $this->pass_id = $pass_id;
        $this->passName = $passName;
        $this->passDescription = $passDescription;
        $this->passPrice = $passPrice;
        $this->passType = $passType;
        $this->total_cost = $total_cost;
    }

    public function getPassId()
    {
        return $this->pass_id;
    }

    public function setPassId(int $pass_id)
    {
        $this->pass_id = $pass_id;
    }

    public function getPassName()
    {
        return $this->passName;
    }

    public function setPassName($passName)
    {
        $this->passName = $passName;
    }

    public function getPassDescription()
    {
        return $this->passDescription;
    }

    public function setPassDescription($passDescription)
    {
        $this->passDescription = $passDescription;
    }

    public function getPassPrice()
    {
        return $this->passPrice;
    }

    public function setPassPrice($passPrice)
    {
        $this->passPrice = $passPrice;
    }


    public function getPassType()
    {
        return $this->passType;
    }

    public function setPassType($passType)
    {
        $this->passType = $passType;
    }


    public function toArray()
    {
        return [
            'passName' => $this->passName,
            'passDescription' => $this->passDescription,
            'passPrice' => $this->passPrice,
        ];
    }

    public function getCost()
    {
        return $this->total_cost;
    }
}