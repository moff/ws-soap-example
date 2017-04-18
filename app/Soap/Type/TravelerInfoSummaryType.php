<?php
namespace App\Soap\Type;

class TravelerInfoSummaryType
{
  /**
   * @var PassengerQuantityType
   */
  protected $Passenger;

  /**
   * TravelerInfoSummaryType constructor.
   *
   * @param PassengerQuantityType $PassengerQuantityType
   */
  public function __construct($PassengerQuantityType)
  {
    $this->Passenger = $PassengerQuantityType;
  }

  /**
   * @return PassengerQuantityType
   */
  public function getPassenger()
  {
    return $this->Passenger;
  }
}