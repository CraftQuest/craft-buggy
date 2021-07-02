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
use craftquest\buggy\models\Settings;
use craftquest\buggy\services\BuggyService;
use craftquest\buggy\helpers\StatusHelper;

use Craft;
use yii\db\ActiveRecord;

/**
 * Buggy Variable
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 *
 *  * @method    Settings getSettings()
 */
class BuggyVariable
{
    // Public Methods
    // =========================================================================


    /**
     * @return BuggyService|\craftquest\buggy\services\BugService
     */

    /**
     *
     * @return array
     */

    public function swarms()
    {
        return StatusHelper::getService()->getSwarms();
    }


    /**
     * @param $count
     * @param $strength
     */
    public function createSwarm($count, $strength)
    {
        StatusHelper::getService()->createSwarm($count, $strength);
    }

    /**
     * @param $swarmId
     */
    public function getSwarm($swarmId)
    {
        return StatusHelper::getService()->getSwarm($swarmId);
    }

    /**
     * @param $swarmId
     * @param $swarmStrength
     * @param $count
     * @return int
     */
    public function spray($swarmId, $swarmStrength, $count): int
    {
        return StatusHelper::getService()->spray($swarmId, $swarmStrength, $count);
    }

}
