<?php

/* 
 * Provides a Parker Solar Probe plugin.
 */

namespace Drupal\space_craft\Plugin\Probe;

use Drupal\space_craft\ProbeBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *  @Probe(
 *    id = "parker_solar_probe",
 *    description = @Translation("Parker Solar Probe is a nasa spacecraft currently orbiting the Sun"),
 *    instruments = 4
 * )
 */

class ParkerSolarProbe extends ProbeBase implements ContainerFactoryPluginInterface {
  
  // Use Drupal\Core\StringTranslation\StringTranslationTrait to define
  // $this->t() for string translations in plugin.
  // Must include full path for use statement before class, in addition to use statement inside plugin class.
  use StringTranslationTrait;

  /**
   * @var TranslationInterface
   */
  private $translation;

  /**
   * This is the string representation of the day of the week from the PHP function; date('D').
   * 
   * @var string
   */
  protected $day;
    
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // Get the translation service from the container, implement the ContainerFactoryPluginInterface
    // which requires the create() method and use it to get() the 'string_translation'.
    $solarProbe = new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('string_translation')
      );
    return $solarProbe;
  }
  
  public function __construct(array $configuration, $plugin_id, $plugin_description, TranslationInterface $translation ) {
   // Inject the translation service, then call setStringTranslation and pass in $transltion.
   $this->setStringTranslation($translation);
   // Store the day to generate a special description.
   $this->day = date('D');
   // Pass the other parameters up to the parent constructor.
   parent::__construct($configuration, $plugin_id, $plugin_description);
  }
  
  public function order(array $extras) {
    $payload = ['Fields Experiment (FIELDS)', 'Wide-field Imager for Solar PRobe (WISPR)', 'Integrated Science Investigation of the sun (IS☉IS)'];
    $probe = array_merge($payload, $extras);
    return 'The spacecrafts scientific payload includes; ' . implode(', ', $probe) . ' Also the Solar Wind Electrons Alphas and Protons (SWEAP) Investigation.';
  }
  public function description() {
    // Override the description() method in order to change
    // the description text based on the day of the week.
    if ($this->day == 'Sat') {
      return $this->t('Sorry no data is collected from the probe on Sundays');
    }
    return parent::description();
  }
}
