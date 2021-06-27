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
 * Buggy Swarm Model
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class SwarmModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $someAttribute = 'Some Default';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
//    public function rules()
//    {
//        return [
//            ['someAttribute', 'string'],
//            ['someAttribute', 'default', 'value' => 'Some Default'],
//        ];
//    }
}
