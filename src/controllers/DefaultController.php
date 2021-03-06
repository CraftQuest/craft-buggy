<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy\controllers;

use craftquest\buggy\Buggy;

use Craft;
use craft\web\Controller;
use craftquest\buggy\helpers\StatusHelper;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected array|int|bool $allowAnonymous = ['create-swarm', 'spray-swarm'];

    // Public Methods
    // =========================================================================

    /**
     *
     * @return mixed
     */
    public function actionCreateSwarm(): void
    {
        (new StatusHelper)->getService()->createSwarm();
    }

    /**
     *
     * @return void
     */
    public function actionSpraySwarm(): void
    {
        $swarmId = Craft::$app->getRequest()->getParam('id');
        (new StatusHelper)->getService()->spray($swarmId);
    }
}
