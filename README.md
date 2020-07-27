# Custom modules demonstrating the use of Drupal 8 essential APIs 

## Mission module

###### The Mission module is a custom entity with bundles. This means that you can create fully-fieldable entity types to store any type of data without all the overhead that comes with a custom content type. This entity type module also has some advantages over using the Paragraphs module, namely menus that link to entity types and the entities themselves. Also a useful entity type list, lists of the created entities, and an easy way to delete entities when necessary. Finally providing navigation, messages to the user, and a helpful administration experience.

## Probe Block module

###### Programmatically creates a custom block displaying a list of a Drupal sites enabled modules. It illustrates implementing the Block API  and by extension the Plugin API, as well as, Drupal coding standards. This module also shows use of a configuration form,  simple form validation, access control and hook_help. The first version makes a call to the global Drupal service container to get the list of enabled modules. Second version, takes advantage of dependency injection. Gets the core Module Handler service from the service container, injecting this service into the constructor of the ProbeBlock class and finally uses the Module Handler service to fetch then display a list of enabled modules in a custom block.

## Probe Event Subscriber module

###### This module shows the use of an event subscriber. Register a listener and an event subscriber with a service tag in the services.yml. Provide a list of subscribed events along with callback functions for each. Log a message in response to the event using a service from the container. Create a custom form, fetch the event dispatch service from the container to trigger an event. Insatiate a custom class that wraps the Event object. Register an event subscriber with custom logic to determine which message appears on the page.

## Probe Orbit module

###### A Drupal 8 module which demonstrates the use of both custom and core services. With a wildcard in the routing.yml and a new Response object in the controller the custom page displays the string "OrBBBBBBit!" The number of B's in the string is depend on the number used in the URL. The module teaches the service container to instantiate a custom service. It then grabs an existing service from the container using it in the controller to log a message that can be found under the admin menu Reports/Recent log messages. This module also contains an alternative controller and generator  which explores another method to pass services into the controller without needing to use the create function.

## Space Craft module

###### Define a new plugin type, the probe plugin, which includes the following: the base class, an interface, and the plugin manager. Also the annotation definition, a controller for a new page, as well as, the probe plugins themselves.

## Space Craft Plugin module

###### This custom module uses plugins to extend another modules behavior.  The module demonstrates use of Drupal Console on the command line to generate a new custom module. It also pulls a custom service from the container then injects it into a new controller. "mars2020_probe" is an example of creating an instance of an existing plugin type called probe (see the Space_craft module). Finally the module displays definitions and descriptions of all plugins of this type on a custom page.
