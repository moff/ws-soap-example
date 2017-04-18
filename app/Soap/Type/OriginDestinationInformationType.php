<?php
namespace App\Soap\Type;

class OriginDestinationInformationType
{
  /**
   * @var string
   */
  protected $DepartureDateTime;

  /**
   * @var string
   */
  protected $OriginLocation;

  /**
   * @var string
   */
  protected $DestinationLocation;

  /**
   * OriginDestinationInformationType constructor.
   *
   * @param string $DepartureDateTime
   * @param string $OriginLocation
   * @param string $DestinationLocation
   */
  public function __construct($DepartureDateTime, $OriginLocation, $DestinationLocation)
  {
    $this->DepartureDateTime = $DepartureDateTime;
    $this->OriginLocation = $OriginLocation;
    $this->DestinationLocation  = $DestinationLocation;
  }

  /**
   * @return string
   */
  public function getDepartureDateTime()
  {
    return $this->DepartureDateTime;
  }

  /**
   * @return string
   */
  public function getOriginLocation()
  {
    return $this->OriginLocation;
  }

  /**
   * @return string
   */
  public function getDestinationLocation()
  {
    return $this->DestinationLocation;
  }
}