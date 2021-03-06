<?php

class Quotation
{
    private $netTotal = 0;
    private $vatRate;

    public function addRow($row)
    {
        // including just the logic to implement the test we have
        $this->netTotal += $row;
    }

    public function specifyTaxes(VatRate $vatRate)
    {
        $this->vatRate = $vatRate;
    }

    public function getTotal()
    {
        return $this->vatRate->tax($this->netTotal);
    }

    public function getTypeOfService()
    {
        return 'Type: ' . $this->vatRate->getCode();
    }
}

class VatRate
{
    private $rate;
    private $code;

    public function __construct($rate, $code)
    {
        $this->rate = $rate;
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function tax($netAmount)
    {
        return $netAmount * (1 + $this->rate / 100);
    }
}