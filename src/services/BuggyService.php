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
use yii\base\Exception;

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

    public function createSwarm(): void
    {

        $count = rand(1,100);
        $strength = rand(1,50);
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
        try {
            return SwarmRecord::find()
                ->orderBy('bugCount')
                ->where(['seeded' => null])
                ->all();
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getBugs()
    {
        try {
            return SwarmRecord::find()
                ->orderBy('count', 'strength')->all();
        } catch (Exception $exception) {
            return null;
        }
    }


    /**
     * @return int
     */
    public function getBugsCount(): int
    {
        $swarms = SwarmRecord::find()->orderBy('count', 'strength')->all();
        $bugsCount = 0;
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
        return SwarmRecord::find()->select('id', $swarmId);
    }


    /**
     * @param $swarmId
     * @return int
     */
    public function spray($swarmId): int
    {

        $swarm = $this->getSwarm($swarmId);

        $updatedCount = $this->calculateSprayEffectiveness($swarm);
        $this->updateSwarm($swarmId, $updatedCount);
        return $updatedCount;
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
            $swarmRecord->setAttribute('count', $count);
            $swarmRecord->save();
        }
    }


    public function calculateSprayEffectiveness($count, $strength): int
    {
        $potency = rand(2, 10);
        $bugsRemoved = (2 * $strength) - (4 * $potency);
        return $count - $bugsRemoved;
    }
}
