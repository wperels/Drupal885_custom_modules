<?php

/* 
 * @file
 * Contains \Drupal\probe_block\Plugin\Block\ProbeBlock.
 * 
 * A custom Block that displays a list of enabled
 * modules in our Drupal site. It also demonstrates a few
 * API methods provided by the Block sub-system, such as 
 * configuration form, form validation and access control.
 */

namespace Drupal\probe_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Extension\ModuleHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a simple block with a list of enabled modules
 *
 * @Block(
 *   id = "probe_block",
 *   admin_label = @Translation("Probe Block"),
 *   category = @Translation("Drupal 8 Development")
 * )
 */
class ProbeBlock extends BlockBase implements ContainerFactoryPluginInterface {
  
  protected $moduleHandler;
  
  /**
   * 
   * @param ModuleHandler $module_handler
   * The core Module Handler service. Injecting this service
   *  to access a core service not a call to the global Drupal object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ModuleHandler $module_handler) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->moduleHandler = $module_handler;
  }
  
  public function build(){
  
     /**
   * Implements \Drupal\Core\Block\BlockPluginInterface::build().
   *  
   * Displays the currently enabled modules in our Drupal site. 
   */
  
    $build = array();
    
    // Use the global Drupal Service container to get
    // the list of enabled modules
    $modules = $this->moduleHandler->getModuleList();
    
    // Set an index for the loop to count the 
    // number of iterations
    $index = 1;
    
    // Loop through the modules and save them in a variable
    $list = array();
    foreach ($modules as $module => $path) {
      $list[$module] = $module;
      
      // Stop the loop here if $index equals the value 
      // set in the configuration form
      if ($index == $this->configuration['number_of_items']) {
        break;
      }
      $index++;
    }
    
    // Return the output in a Render array
    $build = array(
      '#theme' => 'item_list',
      '#items' => $list,
      '#list_type' => 'ol',
    );
    return $build;
 }
 
 /**
 * Overrides \Drupal\block\BlockBase::blockAccess().
 */
 protected function blockAccess(AccountInterface $account) {
   // Only grant access to users with the 'administer blocks' permission.
   return AccessResult::allowedIfHasPermission($account, 'administer blocks');
 }
 
  /**
   * Overrides \Drupal\block\BlockBase::blockForm().
   */
 public function blockForm($form, FormStateInterface $form_state) {
   // Add a simple text field on the Block configuration form
   // to limit the number of enabled modules to display
   $form['number_of_items'] = array(
     '#type' => 'textfield',
     '#title' => t('Number of items in list'),
     '#default_value' => $this->configuration['number_of_items'],
     '#description' => t('Define the number of items returned in the list.')
   ); 
   return $form;
 }
 
  /**
   * Overrides \Drupal\block\BlockBase::blockSubmit().
   * 
   * Stores the configuration setting based on the form
   * submission value.
   */
 public function blockSubmit($form, FormStateInterface $form_state) {
   $this->configuration['number_of_items'] = intval($form_state->getValue
     ('number_of_items'));
 }
 
 /**
   * Overrides \Drupal\block\BlockBase::blockValidate().
   * 
   * Validates the configuration form.
   */
 public function blockValidate($form, FormStateInterface $form_state) {
   if(!is_numeric($form_state->getValue('number_of_items'))) {
     $form_state->setErrorByName('number_of_items', t('Please enter a numeric value.'));
   }
 }
 
   /**
   * Dependency injection override the parent method
   *   inject the Module Handler service into the controller.
   * 
   * @param ContainerInterface $container
   * @return \static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition, $container->get('module_handler'));
  }
}