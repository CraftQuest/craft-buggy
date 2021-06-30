# Buggy plugin for Craft CMS 3.x

Buggy lets you add a fun bug infestation to your Craft Control Panel.

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, use the Craft Plugin Store or follow these instructions:

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require craftquest/buggy

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Buggy.

## Buggy Overview

Buggy has two modes:

1. Automatic Bug Spawning: Learn how to debug using Xdebug by solving bugs in the code. The number of bugs crawling on the screen is related to the number of bugs in the code.
2. Manual Bug Spawning: Generate and exterminate bugs using a simple interface. The bugs you generate will appear in the Control Panel.

## Configuring Buggy

By default Buggy is turned off. To turn Buggy on, go to the plugin settings and enable either:

- Automatic Bug Spawning
- Manual Bug Spawning

The Automatic Bug Spawning will only work if the small code bugs shipped with Buggy remain unfixed. Manual Bug Spawning requires you to create bug using the interface.

## Automatic Bug Spawning

Automatic Bug Spawning exists as a learning tool for the [Debugging with Xdebug]() course from [CraftQuest.io](https://craftquest.io).

The bugs are spawned based on the number of software bugs the system detects. As each bugs is fxied, the nunber of bugs spawned is reduced until there are no more bugs.

At that point, you can enable Manual Bug Spawning, so you don't miss your crawling friends!

## Manual Bug Spawning

To set up Manual Bug Spawning, copy the contents of  example `index.twig` template in `vendor/craftquest/example-templates` to a template in your template directory.

Load that template in your web browser and you should see an interface for creating new bug swarms. Click the button "Create Swarm" and Buggy will automatically generate a new swarm of random size.

To get rid of the swarm, use the Spray Swarm button next to each swarm. 

To get rid of the bugs on the screen you can just toggle off Manual Bug Spawning to remove the bugs completely.

## Buggy Roadmap

Some things to do, and ideas for potential features:

* Release it

## Credits

* [Andrew Welch at NyStudio107](https://nystudio107.com) for ideas and help
* [AUZ Bug](https://github.com/Auz/Bug) - the library this plugin uses to get the bugs on your screen.

Brought to you by [Ryan Irelan](https://craftquest.io)
