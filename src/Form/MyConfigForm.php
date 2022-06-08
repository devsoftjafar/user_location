<?php

namespace Drupal\user_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MyConfigForm extends ConfigFormBase {
 /**
   * {@inheritdoc}
   */
    public function getFormId()
    {
        return 'user_location_config_form';
    }
 /**
   * {@inheritdoc}
   */
    protected function getEditableConfigNames()
    {
        return [
            'user_location.settings'
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
      '#required' => true,
      '#size' => 60,
      '#default_value' => ' ',
      '#maxlength' => 128,
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12']
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('city'),
      '#required' => true,
      '#size' => 60,
      '#default_value' => ' ',
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12']
    ];
    $form['timezone'] = array (
        '#type' => 'select',
        '#title' => ('TimeZone'),
        '#options' => array(
          'America/Chicago' => t('America/Chicago'),
          'America/New_York' => t('America/New_York'),
          'Asia/Tokyo' => t('Asia/Tokyo'),
          'Asia/Dubai' => t('Asia/Dubai'),
          'Asia/Kolkata' => t('Asia/Kolkata'),
          'Europe/Amsterdam' => t('Europe/Amsterdam'),
          'Europe/Oslo' => t('Europe/Oslo'),
          'Europe/London' => t('Europe/London'),
          ),
        );
    return parent::buildForm($form, $form_state);
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }


  public function submitForm(array &$form, FormStateInterface $form_state)
  {
      $config = $this->config('user_location.settings');
      $config->set('country', $form_state->getValue('country'));
      $config->set('city', $form_state->getValue('city'));
      $config->set('timezone', $form_state->getValue('timezone'));
      $config->save();


      return parent::submitForm($form, $form_state);
  }

   
}