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
use craftquest\buggy\services\BuggyService;
use craftquest\buggy\services\BugService;
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
use yii\base\BaseObject;
use yii\base\Event;

/**
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 *
 * @property  BuggyService $buggyService
 * @property  BugService $bugService
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
    public string $schemaVersion = '1.0.6';

    /**
     *
     * @var bool
     */
    public bool $hasCpSettings = true;

    /**
     *
     * @var bool
     */
    public bool $hasCpSection = false;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;
        $this->setComponents([
            'buggyService' => services\BuggyService::class,
            'bugService' => services\BugService::class,
        ]);

        if (Craft::$app->getRequest()->isCpRequest) {
            Event::on(
                View::class,
                View::EVENT_BEFORE_RENDER_TEMPLATE,
                function (TemplateEvent $event) {
                    $bugCount = 0;

                    if ($this->getSettings()->automaticBugSpawning) {
                        $bugCount = $this->_runTests();
                    } else {
                        $bugCount = $this->bugService->getBugsCount();
                    }

                    Craft::$app->getView()
                        ->registerAssetBundle(BuggyAsset::class);

                    Craft::$app->getView()
                        ->registerJs($this->_buildBugOutbreak($bugCount));
                }
            );
        }


        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $event->rules['siteActionTrigger1'] = 'buggy/default/create-swarm';
            }
        );

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('buggy', BuggyVariable::class);
            }
        );

        // Do something after we're installed
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function(PluginEvent $event) {
                if ($event->plugin === $this) {
                    // We were just installed
                }
            }
        );


        Craft::info(
            Craft::t(
                'buggy',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }


    // Protected Methods
    // =========================================================================

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel(): \craft\base\Model|Settings|null
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'buggy/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }


    private function _checkGetSwarm(): int
    {
        $getSwarm = Buggy::$plugin->buggyService->getSwarm(1);

        if (property_exists($getSwarm, 'modelClass')) {
            return 40;
        }

        return 0;
    }

    private function _checkGetSwarms(): int
    {
        if (!Buggy::$plugin->buggyService->getSwarms() > 0) {
            return 20;
        }
        return 0;
    }

    private function _checkRemainingBugCount(): int
    {
        if (Buggy::$plugin->buggyService->calculateSprayEffectiveness(-90, 1) < 0) {
            return 20;
        }
        return 0;
    }

    private function _buildBugOutbreak($bugCount): string
    {
        return "new BugController({'minBugs':${bugCount}, 'maxBugs':${bugCount}});";
    }

    private function _runTests(): int
    {
        // Run some tests to check for bugs
        $bugCount = 0;
        $bugCount += $this->_checkGetSwarm(); // 40
        $bugCount += $this->_checkGetSwarms(); // 20
        $bugCount += $this->_checkRemainingBugCount(); // 20

        return $bugCount;
    }


}
