<?php

/* 
 * @file
 * Contains Drupal\Tests\probe_block\Functional\ProbeBlockTest
 */

namespace Drupal\Tests\probe_block\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Provides test case for our Probe Block.
 * 
 * @group probe_block
 */
class ProbeBlockTest extends BrowserTestBase {
  
  /**
   * User with permission to administer blocks.
   * @var object
   */
  protected $adminUser;
  
  /**
   * An authenticated user with no permissions.
   * @var object
   */
  protected $normalUser;
  
  /**
   * The ID of the block.
   * @var object
   */
  protected $block_id;
  
  /**
   * The title of the block.
   * @var object 
   */
  protected $title;
  
  /**
   * Default, installed theme.
   * @var object
   */
  protected $default_theme;
  
  /**
   * Modules to enable.
   * @var array
   */
  public static $modules = array('probe_block');
  
  public function setUp() {
    parent::setUp();
    
    $this->adminUser = $this->drupalCreateUser(array('administer blocks', 'administer permissions'));
    
    $this->normalUser = $this->drupalCreateUser();
    
    $this->block_id = 'probe_block';
    
    $this->title = 'Probe Block';
    
    $this->default_theme = \Drupal::config('system.theme')->get('default');
    
  }
  
  /**
   * Tests the Block creation.
   */
  public function testProbeBlockCreation() {
    
    // Log in as admin user.
    $this->drupalLogin($this->adminUser);
    
    // Create an array that contains our Block configuration.
    $configuration = array(
      'region' => 'sidebar_first',
      'settings[label]' => $this->title,
      'settings[number_of_items]' => 10
    );
    
    // Submit the Block creation form programmatically.
    $this->drupalPostForm('admin/structure/block/add/' . $this->block_id . 
      '/' . $this->default_theme, $configuration, t('Save block'));
    
    // Test if block creation was successful.
    $this->assertText(t('The block configuration has been saved.'));
  }
  
  /**
   *  Tests the Block form validation.
   */
  public function testProbeBlockValidation() {
    /**
     *  Tests the Block form validation.
     */
    $this->drupalLogin($this->adminUser);
    
    //Create an array that contains Probe Block configuration.
    $configuration = array(
      'region' => 'sidebar_first',
      'settings[label]' => '$this->title',
      'settings[number_of_items]' => t('Hey, this is not a number!')
    );
    
    // Place the Probe Block
    $this->drupalPostForm('admin/structure/block/add/' . $this->block_id . '/' . 
      $this->default_theme, $configuration, t('Save block'));
    
    // Test if custom validation callback works as expected.
    $this->assertText(t('Please enter a numeric value.'));
  }
  
  /**
   * Tests the Block access
   */
  public function testFirstBlockAccess() {

    // Log in as admin user
    $this->drupalLogin($this->adminUser);
            
    // Create an array that contains Probe Block configuration
    $configuration = array(      
      'region' => 'sidebar_first',
      'settings[label]' => $this->title,
      'settings[number_of_items]' => 10
    );

    // Place the Block
    $this->drupalPostForm('admin/structure/block/add/' . $this->block_id 
      . '/' . $this->default_theme, $configuration, t('Save block'));
  	
    // Log out admin user
    $this->drupalLogout();
	
    // Log our normal user in
    $this->drupalLogin($this->normalUser);

    // Probe Block should not be visible 
    $this->assertNoText('Probe Block');
  }  
  
}

