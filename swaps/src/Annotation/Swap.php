<?php
/**
 * @file
 * Contains \Drupal\visual_content_layout\Annotation\Swap.
 */

namespace Drupal\swaps\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a swap item annotation object.
 *
 * Plugin Namespace: Plugin\swaps\Swap
 *
 * @see \Drupal\swaps\SwapManager
 * @see plugin_api
 *
 * @Annotation
 */
class Swap extends Plugin {
  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;
  /**
   * The plugin Title.
   *
   * @var string
   */
  public $title;
  /**
   * The plugin Description.
   *
   * @var string
   */
  public $description;
  /**
   *
   * Indicates if the swap can contain others swaps.
   *
   * @var boolean
   */
  public $container;
  /**
   * The plugin Tip.
   *
   * @var string
   */
  public $tip;
}
