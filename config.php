<?php
return [
  //The capitalized full name of your plugin
  'name' => 'Wordpress Plugin Boilerplate'

  //The current version of your plugin
  ,'version' => '1.0.0'

  /**
   * The modules which should be loaded, the structure is:
   * The `is_admin` define whether the user is in the admin panel in order to execute the module
   * ['name' => 'yourModuleName', 'is_admin' => true|false]
   */
  ,'modules' => [
      ['name' => 'settings-pages']
  ]
];