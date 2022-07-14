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

    public function swarms(): array|null
    {
        return (new StatusHelper)->getService()->getSwarms();
    }


    /**
     * Create a new swarm of bugs
     */
    public function createSwarm(): void
    {
        (new StatusHelper)->getService()->createSwarm();
    }

    /**
     * @param $swarmId
     * @return array|ActiveRecord|null
     */
    public function getSwarm($swarmId): array|ActiveRecord|null
    {
        return (new StatusHelper)->getService()->getSwarm($swarmId);
    }

    /**
     * @param $swarmId
     * @return int
     */
    public function spray($swarmId): int
    {
        return (new StatusHelper)->getService()->spray($swarmId);
    }

}
