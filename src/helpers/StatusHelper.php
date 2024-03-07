<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy\helpers;

use craftquest\buggy\Buggy;

/**
 * Class StatusHelper
 *
 * Dynamically gets correct service based on settings.
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.4
 *
 */
class StatusHelper
{
    /**
     * @return \craftquest\buggy\services\BuggyService|\craftquest\buggy\services\BugService
     */
    public function getService(): \craftquest\buggy\services\BugService|\craftquest\buggy\services\BuggyService
    {
        if (Buggy::$plugin->getSettings()->automaticBugSpawning) {
            return Buggy::$plugin->buggyService;
        }

        return Buggy::$plugin->bugService;
    }
}
