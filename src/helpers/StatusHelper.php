<?php

namespace craftquest\buggy\helpers;

use craftquest\buggy\Buggy;

class StatusHelper {

    public static function getService()
    {
        if (Buggy::$plugin->getSettings()->automaticBugSpawning) {
            return Buggy::$plugin->buggyService;
        }

        return Buggy::$plugin->bugService;
    }

}