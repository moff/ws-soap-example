<?php
namespace App\Soap\Type;

class SecurityType
{
  /**
   * @var string
   */
  protected $Username;

  /**
   * @var string
   */
  protected $Password;

  /**
   * @var string
   */
  protected $HashKey;

  /**
   * SecurityType constructor.
   *
   * @param string $Username
   * @param string $Password
   * @param string $HashKey
   */
  public function __construct($Username, $Password, $HashKey)
  {
    $this->Username = $Username;
    $this->Password = $Password;
    $this->HashKey  = $HashKey;
  }

  /**
   * @return string
   */
  public function getUsername()
  {
    return $this->Username;
  }

  /**
   * @return string
   */
  public function getPassword()
  {
    return $this->Password;
  }

  /**
   * @return string
   */
  public function getHashKey()
  {
    return $this->HashKey;
  }
}