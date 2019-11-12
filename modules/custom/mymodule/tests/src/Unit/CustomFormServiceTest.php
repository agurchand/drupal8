<?php 

namespace Drupal\Tests\mymodule\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\mymodule\Services\CustomFormService;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Tests MyCustomService
 * @group mymodule
 */
class CustomFormServiceTest extends UnitTestCase {
  
  use StringTranslationTrait;

	/**
	 * {@inheritdoc} 
	 */
	function setUp() {		
    parent::setUp();

    $custom_form_service = new CustomFormService();
    
    // Mock the StringTranslation & CustomFormService
    $container = new ContainerBuilder();
    $translations = $this->getMock(TranslationInterface::class);
    $container->set('string_translation', $translations);
    $container->set('mymodule.custom_form_service', $custom_form_service);
    \Drupal::setContainer($container);

	}
		
	/**
	 * @covers Drupal\mymodule\Services\CustomFormService::stateList
	 * assertEquals();
	 */
	function testCustomForm_stateArrayAssertion() {
        
    $state_list_actual = \Drupal::service('mymodule.custom_form_service')->stateList();;
    $state_list_expect = [
      'tn' => $this->t('Tamilnadu'),
      'ka' => $this->t('Karnataka'),
      'ap' => $this->t('Andhra Pradesh')
    ];
		$this->assertEquals($state_list_expect, $state_list_actual);

	}

}

