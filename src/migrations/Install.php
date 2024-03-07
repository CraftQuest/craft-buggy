<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * Make and remove bugs and learn Xdebug along the way!
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy\migrations;

use Craft;

use craft\db\Migration;
use craftquest\buggy\Buggy;
use craftquest\buggy\records\SwarmRecord;

/**
 * Buggy Install Migration
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class Install extends Migration
{
    // Public Properties
    // =========================================================================

    /**
     * @var string The database driver to use
     */
    public string $driver;

    // Public Methods
    // =========================================================================

    /**
     * This method contains the logic to be executed when applying this migration.
     * This method differs from [[up()]] in that the DB logic implemented here will
     * be enclosed within a DB transaction.
     * Child classes may implement this method instead of [[up()]] if the DB logic
     * needs to be within a transaction.
     *
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function safeUp()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        if ($this->createTables()) {
//            $this->createIndexes();
            $this->addForeignKeys();
            $this->insertDefaultData();
            // Refresh the db schema caches
            Craft::$app->db->schema->refresh();
        }

        return true;
    }

    /**
     * This method contains the logic to be executed when removing this migration.
     * This method differs from [[down()]] in that the DB logic implemented here will
     * be enclosed within a DB transaction.
     * Child classes may implement this method instead of [[down()]] if the DB logic
     * needs to be within a transaction.
     *
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function safeDown()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        $this->removeTables();

        return true;
    }

    // Protected Methods
    // =========================================================================

    /**
     * Creates the tables needed for the Records used by the plugin
     *
     * @return bool
     */
    protected function createTables(): bool
    {
        $tablesCreated = false;

        $tableSchema = Craft::$app->db->schema->getTableSchema('{{%buggy_swarms}}');
        if ($tableSchema === null) {
            $tablesCreated = true;
            $this->createTable(
                '{{%buggy_swarms}}',
                [
                    'id' => $this->primaryKey(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid' => $this->uid(),
                    'count' => $this->integer(),
                    'strength' => $this->integer(),
                    'seeded' => $this->boolean(),
                    'siteId' => $this->integer()->null(),
                ]
            );
        }

        return $tablesCreated;
    }

    /**
     * Creates the indexes needed for the Records used by the plugin
     *
     * @return void
     */
    protected function createIndexes(): void
    {
    }

    /**
     * Creates the foreign keys needed for the Records used by the plugin
     *
     * @return void
     */
    protected function addForeignKeys(): void
    {
        $this->addForeignKey(
            $this->db->getForeignKeyName('{{%buggy_swarms}}', 'siteId'),
            '{{%buggy_swarms}}',
            'siteId',
            '{{%sites}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * Populates the DB with the default data.
     *
     * @return void
     */
    protected function insertDefaultData(): void
    {
        $starterSwarm = [
            'count' => 100,
            'strength' => 25,
            'seeded' => true,
        ];

        $this->insert(SwarmRecord::tableName(), $starterSwarm);
    }

    /**
     * Removes the tables needed for the Records used by the plugin
     *
     * @return void
     */
    protected function removeTables(): void
    {
        $this->dropTableIfExists('{{%buggy_swarms}}');
    }
}
