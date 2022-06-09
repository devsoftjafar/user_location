<?php

namespace Drupal\user_location\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "my_custom_block",
 *   admin_label = @Translation("My Custom block"),
 * )
 */
class LocationBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $country = \Drupal::config('user_location.settings')->get('country');
    $city = \Drupal::config('user_location.settings')->get('city');
    $timezone = \Drupal::config('user_location.settings')->get('timezone');

    $timezoneService = \Drupal::service('user_location.timezone');
    $dateTime = $timezoneService->getTime($timezone);

    $block = [
      '#theme' => 'location_block',
      '#attributes' => [
        'class' => ['location_block'],
      ],
      '#country' => $country,
      '#city' => $city,
      '#timezone' => $timezone,
      '#dateTime' => $dateTime,

    ];

    $build[] = $block;
    $build['#cache']['max-age'] = 0;

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

}
