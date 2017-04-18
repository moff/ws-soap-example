<?php
namespace App\Soap\Request;

use App\Soap\Type\OriginDestinationInformationType;
use App\Soap\Type\SecurityType;
use App\Soap\Type\TravelerInfoSummaryType;
use App\Soap\Type\TravelPreferencesType;

class DoAirFareRQ
{
    /**
     * @var SecurityType
     */
    protected $Security;

    /**
     * @var OriginDestinationInformationType
     */
    protected $OriginDestinationInformation;

    /**
     * @var TravelerInfoSummaryType
     */
    protected $TravelerInfoSummary;

    /**
     * @var TravelPreferencesType
     */
    protected $TravelPreferences;

    /**
     * DoAirFareRQ constructor.
     *
     * @param SecurityType $Security
     * @param OriginDestinationInformationType $OriginDestinationInformation
     * @param TravelerInfoSummaryType $TravelerInfoSummary
     * @param TravelPreferencesType $TravelPreferences
     */
    public function __construct($Security, $OriginDestinationInformation, $TravelerInfoSummary, $TravelPreferences)
    {
        $this->Security = $Security;
        $this->OriginDestinationInformation = $OriginDestinationInformation;
        $this->TravelerInfoSummary  = $TravelerInfoSummary;
        $this->TravelPreferences  = $TravelPreferences;
    }

    /**
     * @return SecurityType
     */
    public function getSecurity()
    {
        return $this->Security;
    }

    /**
     * @return OriginDestinationInformationType
     */
    public function getOriginDestinationInformation()
    {
        return $this->OriginDestinationInformation;
    }

    /**
     * @return TravelerInfoSummaryType
     */
    public function getTravelerInfoSummary()
    {
        return $this->TravelerInfoSummary;
    }

    /**
     * @return TravelPreferencesType
     */
    public function getTravelPreferences()
    {
        return $this->TravelPreferences;
    }
}