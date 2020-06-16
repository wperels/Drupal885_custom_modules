<?php

/* 
 * @file
 * Hooks spaecific to the space_craft module.
 */

/**
 * Alter the definitions of all the Probe plugins.
 *
 * You can implement this hook to do things like change the properties for each
 * plugin or change the implementing class for a plugin.
 *
 * This hook is invoked by ProbePluginManager::__construct().
 *
 * @param array $probe_plugin_info
 *   This is the array of plugin definitions.
 */
function hook_probe_info_alter(array &$probe_plugin_info) {
  foreach ($probe_plugin_info as $plugin_id => $plugin_definition) {
    $probe_plugin_info[$plugin_id]['foobar'] = t('We have altered this in the alter hook');
  }
}