<?php
/**
 * Buggy plugin for Craft CMS 3.x
 *
 * A plugin that helps you learn how to use Xdebug via CraftQuest.
 *
 * @link      https://craftquest.io
 * @copyright Copyright (c) 2021 Ryan Irelan
 */

namespace craftquest\buggy\twigextensions;

use craftquest\buggy\Buggy;

use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Ryan Irelan
 * @package   Buggy
 * @since     1.0.0
 */
class BuggyTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Buggy';
    }

    /**
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('screen', [$this, 'screen']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('createBugs', [$this, 'createBugs']),
            new TwigFunction('swat', [$this, 'swatBugs']),
            new TwigFunction('spray', [$this, 'sprayBugs']),
        ];
    }

    /**
     * Our function called via Twig; it can do anything you want
     *
     * @param null $text
     *
     * @return string
     */
    public function createBugs($count=10): array
    {
        return;
    }

    public function swatBugs($bugs)
    {
        return;
    }

    public function sprayBugs($bugs)
    {
        return;
    }

    public function screen($bugs)
    {
        return;
    }
}
