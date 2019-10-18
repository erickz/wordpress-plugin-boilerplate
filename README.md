# Wordpress Plugin Boilerplate

**This boilerplate provides a clean structure with helpers, functions and loaders which helps the development of wordpress plugins**

- [Usage](#usage)
- [Namespaces](#namespaces)
- [Config](#config)
- [Switches](#switches)
- [Modules](#modules)
- [Hook](#hooks)
- [Controllers](#controllers)
- [View](#view)
- [Helpers](#helpers)
- [Thanks](#thanks)

# <a id='usage'></a> Usage
Simply clone: 
```git clone git@github.com:erickz/wordpress-plugin-boilerplate.git```

This boilerplate counts with Composer, so include your dependencies on `composer.json` 
and run ``composer-update`` to be ready to roll.

**Tips:** In your editor or IDE, replace all the words from `WordpressPluginBoilerplate` to your plugin`s name

# <a id='namespaces'></a> Namespaces 
This boilerplate use namespaces, some folders and classes are auto-loaded with composer, these are the following:
- Switches;
- Registers;
- Loaders;
- Lang;
- Global Helpers.

You can use any function in these directories by mentioning It's namespace like:

`use WordpressPluginBoilerplate\Loaders\View`

# <a id='config'></a> Config
In the `config.php` (located at the root directory) are stored the plugin's info, It includes:  
- Name;
- Version;
- Modules.

Most of info's are self-explanatory but the modules - which is an array responsible for register all the modules of your application, so **be sure to include them**, 
in order for It be all loaded. The pattern of the modules are an array with each index `'name'` as snake-case with no caps.

Example:
```
'modules' => [
     ['name' => 'settings-pages'],
     ['name' => 'my-other-module'],
     ['name' => 'module']
] 
```

# <a id='switches'></a> Switches
The classes `On.php` and `Off.php` are fired when your plugin is activated or desactivated (consecutively). 
Each of them come with a function representing the fired state: `activated()` and `deactivated()`.   

# <a id='modules'></a> Modules
The modules aren't autoloaded, so as stated in the [Config Section](#config), the list of modules should to be included in the `config.php`,
so the boilerplate will look for folders with the exact same. Here is the expected structure of each module:

[img]

The modules are not meant to be named as domains but as subject, in a sense of being **actions united by a single purpose**, for example:
`feature-selling` or `product-subscription`.

# <a id='hooks'></a> Hooks
Hooks are the means by which your plugin interacts with Wordpress, It's separated by actions and filters. 
The boilerplate provides two classes to handle that:   

- WordpressPluginBoilerplate\Registers\Actions;
- WordpressPluginBoilerplate\Registers\Filters.

Both of them come with the function:
 `add('hook_name', $your_component, $callback, $priority, $accepted_args)`, which stores and later execute the given hooks. 


# <a id='controllers'></a> Controllers

The Controller is always in the root directory, if you want you can mention the controller of each module in the config like this:
`['name' => 'settings-pages', 'controller' => 'MyController']`. You don't need to mention the controller`s name though, the boilerplate will look for It 
with the same name of the folder (if the folder has more than one word, It will use just the first word).

The hook classes are always passed into the `construct()` of your controllers as this: 

```__construct($actions, $filters)```

**Due to Wordpress nature, all hooks of your plugin that should be triggered by Wordpress must be called in the `__construct()` of the controller.**

Each Controller should be an extension the `BaseController.php` (Doesn't require to be loaded, simply use with Its namespace). 


# <a id='view'></a> View
The class View provide the function to handle the templates of yur plugin, you must use statically:
 
`View::load('myViewName', plugin_dir_name(__FILE__), $data)`

# <a id='helpers'></a> Helpers
The place for helpers is `src/app/helpers`. There is also the globals helpers which are meant to be used in the whole plugin and not just a single module.

# <a id='thanks'></a> Thanks
This plugin was inspired by [this project](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate) and designed with the knowledge I've gathered working with Laravel and other plugins.  