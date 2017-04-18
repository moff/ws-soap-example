<?php
namespace App\Soap\Request;

use App\Soap\Type\SecurityType;

class GetAirFareRQ
{
    /**
     * @var SecurityType
     */
    protected $Security;

    /**
     * @var integer
     */
    protected $RequestId;

    /**
     * DoAirFareRQ constructor.
     *
     * @param SecurityType $Security
     * @param integer $RequestId
     */
    public function __construct($Security, $RequestId)
    {
        $this->Security = $Security;
        $this->RequestId = $RequestId;
    }

    /**
     * @return SecurityType
     */
    public function getSecurity()
    {
        return $this->Security;
    }

    /**
     * @return integer
     */
    public function getRequestId()
    {
        return $this->RequestId;
    }
}