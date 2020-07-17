# Drupal_custom_modules
# Custom modules that demonstrate the use of Drupal essential APIs 

## Probe Orbit module

###### Creates a new module in Drupal 8, adds a custom page while using the routing/controller/response layer. Teaches the dependency injection container to instantiate a custom service. Grabs an existing service from the container and use it in the controller to log a message. Accesses the KeyValueStore service from inside a custom service to make it cacheable. Finally explores an alternative method to pass other services into the controller without needing to use the create function.

###### Register an event subscriber with a service tag. Provide a list of subscribed events along with callback functions for each.  Log a message in response to the event using a service from the container. Create a custom form, fetch the event dispatch service from the container to trigger an event. Insatiate a custom class that wraps the Event object. Register an event subscriber with custom logic to determine which message appears on the page.

## Probe Block module

##### Programmatically creates a custom Block that displays a list of enabled modules. Demonstrates a few  API methods provided by the Block sub-system, such as configuration form, form validation and access control. First version makes a call to the global Drupal Service container to get the list of enabled modules.  Second version, takes advantage of Dependency Injection. Gets the core Module Handler service from the service container, injecting this service into a plugin class and finally uses the Module Handler service to fetch then display a list of enabled modules in a custom block.

## Space Craft module

###### Define a new plugin type, the probe plugin, which includes the following: the base class, an interface, and the plugin manager. Also the annotation definition, a controller for a new page, as well as the probe plugins themselves.

## Space Craft Plugin module

###### This custom module uses plugins to extend another modules behavior.  The module demonstrates use of Drupal Console on the command line to generate a new custom module. It also pulls a custom service from the container then injects it into a new controller. "mars2020_probe" is an example of creating an instance of an existing plugin type called probe (see the Space_craft module). Finally the module displays definitions and descriptions of all plugins of this type on a custom page.

## Mission module

#### The Mission module is a custom entity with bundles. This means that you can create fully-fieldable entity types to store any type of data without all the overhead that comes with a custom content type. This entity type module also has some advantages over using the Paragraphs module, namely menus that link to entity types and the entities themselves. Also a useful entity type list, lists of the created entities, and an easy way to delete entities when necessary. Finally providing navigation, messages to the user, and a helpful administration experience.
