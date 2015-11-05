<?php

/**
 * @file
 * Filter that enable the use patterns to create visual content more easy.
 * Drupal\visual_content_layout\Plugin\Filter\FilterVisualContent.
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
 *   description = @Translation("Provides a ShortCode filter
 *                                format to easily generate content layout."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 *   settings = {
 *     "bootstrap" = TRUE,
 *     "fontAwesome" = TRUE
 *   }
 * )
 */
class FilterVisualContentLayout extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    drupal_set_message("true", "enable_bootstrap");
    $result = new FilterProcessResult(VisualContentLayoutSwapper::swapProcess($text));
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    $manager = \Drupal::service('plugin.manager.swaps');
    $swaps = $manager->getDefinitions();
    $tips = "Swaps examples:";
    // Iterate all swaps to make the tips.
    foreach ($swaps as $swap) {
      if (!$swap['tip'] == "") {
        $tips = $tips . "<li><b><u>" . $swap['id'] . "</u> = </b> " . $swap['tip'] . "</li>";
      }
    }
    $tips = $tips . "</ol>";
    $tips = str_replace("'", "\"", $tips);
    return $tips;
  }

}
