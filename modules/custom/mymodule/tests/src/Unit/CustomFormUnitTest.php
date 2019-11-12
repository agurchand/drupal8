<?php 

namespace Drupal\Tests\mymodule\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\mymodule\Form\MyCustomForm;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Form\FormState;
use Drupal\mymodule\Services\CustomFormService;

/**
 * Tests MyCustomForm
 * @group mymodule
 */
class CustomFormUnitTest extends UnitTestCase {
  
  use StringTranslationTrait;

  private $custom_form_service;

	/**
	 * {@inheritdoc} 
	 */
	public function setUp() {
    parent::setUp();

    $container = new ContainerBuilder();

    // Mock String Translation service
    $translations = $this->getMock(TranslationInterface::class);
    $container->set('string_translation', $translations);
    
    // Mock Custom Form Service
    $this->custom_form_service = new CustomFormService();
    $container->set('mymodule.custom_form_service', $this->custom_form_service);

    \Drupal::setContainer($container);
  }

  /**
   * Tests MyCustomForm is able to build
   */
  public function testFormBuilding() {
    // Create an object of MyCustomForm
    $import_form = new MyCustomForm($this->custom_form_service);
    
    $form = $import_form->buildForm(array(), new FormState());
    $this->assertArrayHasKey('select_state', $form);
  }

}

