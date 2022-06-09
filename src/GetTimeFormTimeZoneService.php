<?php

namespace Drupal\user_location;

/**
 * Class Scoopdb.
 */
class GetTimeFormTimeZoneService {
  /**
   * Define database variables.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * {@inheritdoc}
   */
  public function __construct() {

  }

  /**
   * Returns list of nids from icecream table.
   */
  public function getTime($timezone) {

    $date = new \DateTime("now", new \DateTimeZone($timezone));
    $dateTime = $date->format('dS F Y, h:i A');
    return $dateTime;
  }

}
