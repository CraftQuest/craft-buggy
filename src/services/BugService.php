<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 * Oh, and it generates bugs.
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
use yii\base\BaseObject;
use yii\base\Exception;


/**
 * BugService Service
 *
 * This service is used when bug mode is set to manual. We use it to allow
 * manual generation of swarms of bugs!
 *
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class BugService extends Component
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
            ->orderBy('count', 'strength')
            ->where(['seeded' => null])
            ->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getBugs()
    {
        return SwarmRecord::find()
                ->orderBy('count', 'strength')
                ->all();
    }

    /**
     * @return int
     */
    public function getBugsCount(): int
    {
        $bugsCount = 0;

        $swarms = SwarmRecord::find()
            ->select('count')
            ->where(['seeded' => null])
            ->all();

        foreach ($swarms as $swarm) {
            $bugsCount += $swarm->getAttribute('count');
        }

        return $bugsCount;
    }

    /**
     * @param $swarmId
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getSwarm($swarmId)
    {
        return SwarmRecord::find()
            ->select('id', $swarmId);
    }

    /**
     * @param $swarmId
     * @param $swarmStrength
     * @param $swarmCount
     * @return int
     */
    public function spray($swarmId, $swarmStrength, $swarmCount): int
    {
        // swarm strength is an integer amount you can reduce from effectiveness of spray.

        $effectiveness = rand(10,100) / ($swarmStrength * 0.5);

        if ($swarmCount > 0 or $swarmCount <= $effectiveness)
        {
            $newCount = max($swarmCount - $effectiveness, 0);
            $this->updateSwarm($swarmId, $newCount);
            return $newCount;
        }

        return $swarmCount;

    }


    /**
     * @param $swarmId
     * @param $count
     */
    public function updateSwarm($swarmId, $count)
    {
        $swarmRecord = SwarmRecord::find()
            ->where(['id' => $swarmId])
            ->one();

        if ($swarmRecord) {
            $swarmRecord->setAttribute('count',$count);
            $swarmRecord->save();
        }
    }

}