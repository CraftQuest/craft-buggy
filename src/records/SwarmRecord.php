<?php

namespace craftquest\buggy\records;

use Craft;
use craft\db\ActiveRecord;
use craftquest\buggy\Buggy;

/**
 * SubscriptionDiscountsRecord Record
 * @property int $id
 * @property datetime $dateCreated
 * @property datetime $dateUpdated
 * @property char $uid
 * @property swarmCount @swarmCount
 * @property status @status
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */

class SwarmRecord extends ActiveRecord
{
    // Public Static Methods
    // =========================================================================

    /**
     *
     * @return string the table name
     */
    public static function tableName()
    {
        return '{{%buggy_swarms}}';
    }
}
}