<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy\services;

use craftquest\buggy\Buggy;

use Craft;
use craft\base\Component;
use craftquest\buggy\models\SwarmModel;
use craftquest\buggy\records\SwarmRecord;

/**
 * BuggyService Service
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class BuggyService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * @param $count
     * @param $strength
     */

    public function createSwarm($count, $strength): void
    {
        $swarmRecord = new SwarmRecord;
        $swarmRecord->setAttribute('count', $count);
        $swarmRecord->setAttribute('strength', $strength);
        $swarmRecord->save();

    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getSwarms()
    {
        return SwarmRecord::find()
            ->orderBy('count', 'strength')->all();
    }


    /**
     * @param $swarmId
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getSwarm($swarmId)
    {
        return SwarmRecord::find()
            ->select('id', $swarmId)
            ->one();
    }

    /**
     * @param $swarmId
     * @param $swarmStrength
     * @param $swarmCount
     * @return int
     */
    public function spray($swarmId, $swarmStrength, $swarmCount): int
    {
        // swarm strength is a integer amount you can reduce from effectiveness of spray. 
        
        $effectiveness = rand(1,10) / $swarmStrength;

        if ($swarmCount > 0 or $swarmCount <= $effectiveness)
        {
            $this->updateSwarm($swarmId, $swarmCount - $effectiveness);
            return $swarmCount - $effectiveness;
        }

    }



    /**
     * @param $swarmId
     * @param $count
     */
    public function updateSwarm($swarmId, $count)
    {
        // get swarm
        $swarmRecord = SwarmRecord::find()
            ->where(['id' => $swarmId])
            ->one();

        if ($swarmRecord) {
            $swarmRecord->setAttribute('count',$count);
            $swarmRecord->save();
        }
    }
}
