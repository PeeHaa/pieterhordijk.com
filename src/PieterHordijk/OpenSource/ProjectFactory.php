<?php
/**
 * Open source project factory
 *
 * PHP version 5.4
 *
 * @category   PieterHordijk
 * @package    OpenSource
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PieterHordijk\OpenSource;

/**
 * Open source project factory
 *
 * @category   PieterHordijk
 * @package    OpenSource
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class ProjectFactory
{
    /**
     * Builds an open source project
     *
     * @param array $localData  The local data of the project
     * @param array $githubData The github data of the project
     *
     * @return \PieterHordijk\OpenSource\Project The open source project
     */
    public function build(array $localData, array $githubData)
    {
        return new Project($localData, $githubData);
    }
}
