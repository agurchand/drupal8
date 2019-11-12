<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\mymodule\Services\CustomFormService;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class MyCustomForm.
 */
class MyCustomForm extends FormBase {


  /**
   * @var CustomFormService $customFormService
   */
  protected $customFormService;

  /**
   * Class constructor.
   */
  public function __construct(CustomFormService $customFormService) {
    $this->customFormService = $customFormService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    return new static(
      // Load the service required to construct this class.
      $container->get('mymodule.custom_form_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_custom_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('Enter your fullname'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
      "#default_value" => 'Agurchand',
      '#required' => TRUE
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Enter your email'),
      '#weight' => '0',
    ];
    $form['select_state'] = [
      '#type' => 'select',
      '#title' => $this->t('Select State'),
      '#options' => $this->customFormService->stateList(),
      '#ajax' => [
        'callback' => [$this,'ajax_update_city_list'],
        'event' => 'change',
        'wrapper' => 'city_list'
      ]
    ];
    $form['select_city'] = [
      '#type' => 'select',
      '#title' => $this->t('Select City'),
      '#options' => $this->customFormService->cityList('tn'),
      '#prefix' => '<div id="city_list">',
      '#suffix' => '</div>',
      '#validated' => TRUE
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }
  
  public function ajax_update_city_list(array &$form, FormStateInterface $form_state){
    $state = $form_state->getValue('select_state');
    $form['select_city']['#options'] = $this->customFormService->cityList($state);
    return $form['select_city'];
  }

}