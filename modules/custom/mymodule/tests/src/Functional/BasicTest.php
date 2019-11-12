<?php

namespace Drupal\Tests\mymodule\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test basic functionality of My Module.
 *
 * @group mymodule
 */

class BasicTest extends BrowserTestBase {

  /**
   * A simple user.
   *
   * @var \Drupal\user\Entity\User
   */
  private $user;


  /**
   * {@inheritdoc}
   */
  public static $modules = [
    // load required modules
    'node',
    'mymodule',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    // Make sure to complete the normal setup steps first.
    parent::setUp();

    // Create an article content type that we will use for testing.
    $type = $this->container->get('entity_type.manager')->getStorage('node_type')
    ->create([
      'type' => 'article',
      'name' => 'Article',
    ]);
    $type->save();
    $this->container->get('router.builder')->rebuild();
    
    //create an user
    $this->user = $this->drupalCreateUser(array(
      'administer content types'
    ));

    // Login.
    $this->drupalLogin($this->user);
    //access the page
    $this->drupalGet('node/add/article');

  }

  /**
   * Tests that the Article form page can be reached.
   */
  public function testArticleFormPageExists() {
    $this->assertSession()->statusCodeEquals(200);
  }

  /**
   * Tests that the Article page has a title field.
   */
  public function testArticleTitleFieldExists() {
    $this->assertSession()->fieldExists('Title');
  }

  /**
   * Tests that the Article title field has value.
   */
  public function testArticleTitleFieldHasValue() {
    $this->assertSession()->fieldValueEquals('Title', 'Non-Admin');
  }

}