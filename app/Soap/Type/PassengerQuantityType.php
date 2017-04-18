<?php
namespace App\Soap\Type;

class PassengerQuantityType
{
  /**
   * @var string
   */
  protected $Type;

  /**
   * @var integer
   */
  protected $Quantity;

  /**
   * PassengerQuantityType constructor.
   *
   * @param string $Type
   * @param string $Quantity
   */
  public function __construct($Type, $Quantity)
  {
    $this->Type = $Type;
    $this->Quantity = $Quantity;
  }

  /**
   * @return string
   */
  public function getType()
  {
    return $this->Type;
  }

  /**
   * @return string
   */
  public function getQuantity()
  {
    return $this->Quantity;
  }
}