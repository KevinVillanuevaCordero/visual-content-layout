<?php
/**
 * @file
 * Contains \Drupal\visual_content_layout\Form\VisualContentLayoutForm.
 */

namespace Drupal\swaps\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\CloseDialogCommand;
use Drupal\Core\Ajax\SettingsCommand;
use Drupal\Core\Ajax\AjaxResponse;
/**
 * Contribute form.
 */
class ImageManagerForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'swap_image_manager';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $fid = NULL) {

    $form['upload_image'] = array(
      '#type' => 'managed_file',
      '#title' => t('Upload Image'),
      '#size' => 40,
      '#description' => t("Accept JPG, PNG format."),
      '#upload_location' => 'public://vcl_images/',
      '#access' => FALSE,
    );

    // Delete Image Button button ------------------------------------.

    if($fid != 0){
      $file = \Drupal\file\Entity\File::load($fid);
      $url = $file->url();
      $image = '<img class="image_preview" src="' . $url . '" height="150">';
    }

    $form['delete_image'] = array(
      '#type' => 'submit',
      '#value' => t('Delete Image'),
      '#group' => 'swaps_attributes',
      '#prefix' => $fid == 0 ? '<div class="hidden">' : '',
      '#suffix' => $fid == 0 ? '</div>' : $image,
      '#ajax' => array(
        'callback' => '::ajaxDeleteSubmit',
      ),
    );

    $form['fid'] = array(
      '#type' => 'hidden',
      '#value' => $fid
    );

    // Accept button ------------------------------------.
    $form['accept'] = array(
      '#type' => 'submit',
      '#value' => t('Accept'),
      '#group' => 'swaps_attributes',
      '#prefix' => '<div>',
      '#ajax' => array(
        'callback' => '::ajaxAcceptSubmit',
      ),
    );

    // Cancel button ------------------------------------.
    $form['cancel'] = array(
      '#type' => 'submit',
      '#value' => t('Cancel'),
      '#group' => 'swaps_attributes',
      '#suffix' => '</div>',
      '#ajax' => array(
        'callback' => '::ajaxCancelSubmit',
      ),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * Custom ajax submit for delete image.
   */
  public function ajaxDeleteSubmit(array &$form, FormStateInterface $form_state) {

    $form['upload_image']['#attributes'] = array('class' => array('block'));
    $fid = $form_state->getValue('fid');
    $file = \Drupal\file\Entity\File::load($fid);
    $file->setPermanent();
    $url = $file->url();

    $form_state->setRebuild(TRUE);

    $response = SwapDefaultAttributes::cancelAjaxResponse();
    return $response;

  }

  /**
   * Custom ajax submit for cancel button.
   */
  public function ajaxCancelSubmit(array &$form, FormStateInterface $form_state) {

    $response = SwapDefaultAttributes::cancelAjaxResponse();
    return $response;

  }

  /**
   * Custom submit for ajax call.
   */
  public function ajaxAcceptSubmit(array &$form, FormStateInterface $form_state) {

    $settings = array();

    $fid = $form_state->getValue(array('upload_image', 0));
    $file = \Drupal\file\Entity\File::load($fid);
    $file->setPermanent();
    $url = $file->url();

    $settings['url'] = $url;
    $settings['fid'] = $fid;

    $visual_settings = array(
      'visualContentLayout' => array('image_attributes' => $settings));
    $response = new AjaxResponse();
    $response->addCommand(new CloseDialogCommand("#dialog"));
    $response->addCommand(new SettingsCommand($visual_settings, FALSE));

    return $response;

  }
}