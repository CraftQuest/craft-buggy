<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy\variables;

use craftquest\buggy\Buggy;
use craftquest\buggy\services\BuggyService;

use Craft;
use yii\db\ActiveRecord;

/**
 * Buggy Variable
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class BuggyVariable
{
    // Public Methods
    // =========================================================================

    /**
     *
     * @return array
     */

    public function swarms()
    {
        return Buggy::$plugin->buggyService->getSwarms();
    }


    /**
     * @param $count
     * @param $strength
     */
    public function createSwarm($count, $strength)
    {
        Buggy::$plugin->buggyService->createSwarm($count, $strength);
    }

    /**
     * @param $swarmId
     */
    public function getSwarm($swarmId)
    {
        return Buggy::$plugin->buggyService->getSwarm($swarmId);
    }

    /**
     * @param $swarmId
     * @param $swarmStrength
     * @param $count
     * @return int
     */
    public function spray($swarmId, $swarmStrength, $count): int
    {
        return Buggy::$plugin->buggyService->spray($swarmId, $swarmStrength, $count);
    }




}
