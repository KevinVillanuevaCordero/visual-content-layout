<?php

/**
 * @file
 * Filter that enable the use patterns to create visual content more easy.
 * Drupal\visual_content_layout\Plugin\Filter\FilterVisualContent.
 *
 */

namespace Drupal\visual_content_layout\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use \Drupal\visual_content_layout\VisualContentLayoutSwapper;


/**
 * Provides a filter to use swaps as a shortcodes for replace with code.
 *.
 *
 * @Filter(
 *   id = "filter_visualcontentlayout",
 *   title = @Translation("Visual Content Layout"),
 *   description = @Translation("Provides a ShortCode filter format to easily generate content layout."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 *   settings = {
 *     "allowed_swaps" = "[box] [quote] [button] [random] [texto]"
 *   }
 * )
 */
class FilterVisualContentLayout extends FilterBase{

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
      return new FilterProcessResult(VisualContentLayoutSwapper::swapProcess($text));
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {


  }

}