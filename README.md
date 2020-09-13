# Custom modules demonstrating the use of Drupal 8/9 essential APIs 

## Mission module

###### The Mission module is a custom entity with bundles. This means that you can create entity types with fields to store any type of data without all the overhead that comes with a custom content type. This entity type module also has some advantages over using the Paragraphs module, namely menus that link to entity types and the entities themselves. These custom entities also provide a useful entity type list, lists of the exiting entities available, and an easy way to delete entities when necessary. Finally this module provides navigation, messages to the user, and a helpful administration experience.

## Probe Block module

###### Programmatically creating a custom block is a basic example of custom module development. This module’s block displays a list of a Drupal sites installed modules. It illustrates implementing the Block API and by extension the Plug-in API, as well as, demonstrating Drupal coding standards. This module also shows use of a configuration form, simple form validation, access control and the proper use of hooks. The first version makes a call to the global Drupal service container to get the list of enabled modules. The second version takes advantage of dependency injection by getting Drupal’s core Module Handler service from the service container, injecting this service into the constructor of the probeblock class and finally displaying a list in a custom block.

## Probe Event Subscriber module

###### This module shows the use of an event subscriber. It registers a listener and an event subscriber with a service tag in the services.yml file. Providing a list of subscribed events along with callback functions for each while logging a message in response to the event using a service from the container. It creates a custom form and fetches the event dispatch service from the container to trigger an event and instantiate a custom class that wraps the Event object. This module registers an event subscriber with custom logic to determine which message appears on the page.

## Probe Orbit module

###### This is a Drupal 8 module which demonstrates the use of both custom and core services. With a wildcard in the routing.yml file and a new Response object in the controller the custom page displays the string "OrBBBBBBit!" The number of B's in the string is depends on the number used in the URL. The module teaches the service container to instantiate a custom service. It then grabs an existing service from the container using it in the controller to log a message that can be found under Reports/Recent log messages. This module also contains an alternative controller and generator which explores another method to pass services into the controller without needing to use the create function.

## Space Craft module

###### The Space Craft module defines a new plug-in type, called probe, which includes the base class, an interface, and the plug-in manager also an annotation definition, a controller for a new page, and the probe plug-ins themselves.

## Space Craft Plugin module

###### This custom module uses plug-ins to extend another modules behavior. This module demonstrates use of Drupal Console on the command line to generate a new custom module. It also pulls a custom service from the container then injects it into a new controller. "mars2020_probe" is an example of creating an instance of an existing plug-in type called probe (see the Space_craft module). Finally the module displays definitions and descriptions of all plug-ins of this type on a custom page.
