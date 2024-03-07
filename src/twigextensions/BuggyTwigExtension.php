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


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

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
    public function getName(): string
    {
        return 'Buggy';
    }

    /**
     *
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('screen', [$this, 'screen']),
        ];
    }
    /**
     *
     * @param null $text
     *
     * @return string
     */

    public function screen($swarm): string
    {
        return;
    }
}
