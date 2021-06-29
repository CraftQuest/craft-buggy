<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy;

use craftquest\buggy\assetbundles\buggy\BuggyAsset;
use craftquest\buggy\services\BuggyService as BuggyServiceService;
use craftquest\buggy\variables\BuggyVariable;
use craftquest\buggy\twigextensions\BuggyTwigExtension;
use craftquest\buggy\models\Settings;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterUrlRulesEvent;
use craft\events\TemplateEvent;
use craft\web\View;
use yii\base\Event;

/**
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 *
 * @property  BuggyServiceService $buggyService
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class Buggy extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     *
     * @var Buggy
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.1';

    /**
     *
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     *
     * @var bool
     */
    public $hasCpSection = false;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

//        Craft::$app->view->registerTwigExtension(new BuggyTwigExtension());

        if(Craft::$app->getRequest()->isCpRequest)
        {
            Event::on(
                View::class,
                View::EVENT_BEFORE_RENDER_TEMPLATE,
                function (TemplateEvent $event) {

                    // Get view
                    Craft::$app->getView()->registerAssetBundle(BuggyAsset::class);
                }
            );
        }


        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['siteActionTrigger1'] = 'buggy/default/create-swarm';
            }
        );

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('buggy', BuggyVariable::class);
            }
        );

        // Do something after we're installed
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // We were just installed
                }
            }
        );

/**
 * Logging in Craft involves using one of the following methods:
 *
 * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
 * Craft::info(): record a message that conveys some useful information.
 * Craft::warning(): record a warning message that indicates something unexpected has happened.
 * Craft::error(): record a fatal error that should be investigated as soon as possible.
 */
        Craft::info(
            Craft::t(
                'buggy',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
