<?php

namespace Drupal\user_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class for extend configFormBase class.
 */
class MyConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_location_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'user_location.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('user_location.settings');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('country'),
      '#required' => TRUE,
      '#size' => 60,
      '#default_value' => $config->get('country'),
      '#maxlength' => 128,
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12'],
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('city'),
      '#required' => TRUE,
      '#size' => 60,
      '#default_value' => $config->get('city'),
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12'],
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => ('TimeZone'),
      '#options' => [
        'America/Chicago' => $this->t('America/Chicago'),
        'America/New_York' => $this->t('America/New_York'),
        'Asia/Tokyo' => $this->t('Asia/Tokyo'),
        'Asia/Dubai' => $this->t('Asia/Dubai'),
        'Asia/Kolkata' => $this->t('Asia/Kolkata'),
        'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
        'Europe/Oslo' => $this->t('Europe/Oslo'),
        'Europe/London' => $this->t('Europe/London'),
      ],
      '#default_value' => $config->get('timezone'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * This function use for save configuration form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('user_location.settings');
    $config->set('country', $form_state->getValue('country'));
    $config->set('city', $form_state->getValue('city'));
    $config->set('timezone', $form_state->getValue('timezone'));
    $config->save();

    return parent::submitForm($form, $form_state);
  }

}
