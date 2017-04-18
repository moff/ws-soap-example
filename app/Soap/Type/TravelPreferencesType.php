<?php
namespace App\Soap\Type;

class TravelPreferencesType
{
  /**
   * @var string
   */
  protected $OfficeId;

  /**
   * @var string
   */
  protected $VendorPref;

  /**
   * @var string
   */
  protected $BookingClassPref;

  /**
   * @var boolean
   */
  protected $OnlyDirectPref;

  /**
   * TravelPreferencesType constructor.
   *
   * @param string $OfficeId
   * @param string $VendorPref
   * @param string $BookingClassPref
   * @param boolean $OnlyDirectPref
   */
  public function __construct($OfficeId, $VendorPref, $BookingClassPref, $OnlyDirectPref)
  {
    $this->OfficeId = $OfficeId;
    $this->VendorPref = $VendorPref;
    $this->BookingClassPref  = $BookingClassPref;
    $this->OnlyDirectPref  = $OnlyDirectPref;
  }

  /**
   * @return string
   */
  public function getOfficeId()
  {
    return $this->OfficeId;
  }

  /**
   * @return string
   */
  public function getVendorPref()
  {
    return $this->VendorPref;
  }

  /**
   * @return string
   */
  public function getBookingClassPref()
  {
    return $this->BookingClassPref;
  }

  /**
   * @return boolean
   */
  public function getOnlyDirectPref()
  {
    return $this->OnlyDirectPref;
  }
}