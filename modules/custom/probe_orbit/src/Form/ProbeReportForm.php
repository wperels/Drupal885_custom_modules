<?php

/* 
 *  Create a custom form.
 *  Fetch an existing service from the container.
 *  Use service inside submitForm method to dispatch a custom event.
 *  Create a unique class to wrap the Event object and pass in the form submissions.  
 */

namespace Drupal\probe_orbit\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\probe_orbit\Event\SightingEvents;
use Drupal\probe_orbit\Event\SightingReportEvent;


class ProbeReportForm extends FormBase {
  
  protected $eventDispatcher;
  
  public function __construct(EventDispatcherInterface $event_dispatcher) {
    $this->eventDispatcher = $event_dispatcher;
  }
  
  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('event_dispatcher')
      );
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['intro'] = [
      '#markup' => '<p>' . $this->t('This form demonstrates subscribing to, and dispatching, events. When the form is submitted an event is dispatched indicating a new report has been submitted. Event subscribers respond to this event with various messages depending on the sighting type. ') . '</p>',
    ];
    $form['sighting_type'] = [
      '#type' => 'radios',
      '#required' => TRUE,
      '#title' => $this->t('What type of sighting do you want to report?'),
      '#options' => [
        'new_horizons' => $this->t('The New Horizons spacecraft'),
        'ufo' => $this->t('An unidentified flying object'),
        'satellite' => $this->t('Something flying higher than an airplane'),
      ],
    ];
    $form['sighting'] = [
      '#type' => 'textarea',
      '#required' => FALSE,
      '#title' => $this->t('Sighting report'),
      '#description' => $this->t('Describe the sighting in detail. This information will be passed along to all space agencies.'),
      '#cols' => 60,
      '#rows' => 5,
    ];
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }
  
  public function getFormId() {
    return 'probe_orbit_form';
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $type = $form_state->getValue('sighting_type');
    $report = $form_state->getValue('sighting');
    
    $event = new SightingReportEvent($type, $report);
    $this->eventDispatcher->dispatch(SightingEvents::NEW_REPORT, $event);
  }
  
}
