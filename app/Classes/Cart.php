<?php
namespace App\Classes;

use Illuminate\Support\Facades\Cookie;

class Cart
{
  /**
   * setData
   * Put data in shopping cart
   * @param  array $data
   * @return void
   */
  public static function setData(array $data)
  {
    $time = (60 * 60 * 24 * 30);
    return Cookie::queue(Cookie::make("F-Cart", json_encode($data), $time));
  }

  /**
   * getData
   *
   * @return array
   */
  public static function getData()
  {
    $data = json_decode(Cookie::get("F-Cart"), true) ?? [];
    return $data;
  }

}

  ?>