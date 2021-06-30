<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy\models;

use craftquest\buggy\Buggy;

use Craft;
use craft\base\Model;

/**
 * Buggy Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var bool
     */
    public $automaticBugSpawning = true;

    // Public Methods
    // =========================================================================

    /**
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['automaticBugSpawning', 'boolean'],
        ];
    }
}
