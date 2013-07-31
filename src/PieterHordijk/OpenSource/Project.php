<?php
/**
 * Open source project container
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
 * Open source project container
 *
 * @category   PieterHordijk
 * @package    OpenSource
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Project
{
    /**
     * @var array The local data of the project
     */
    private $localData;

    /**
     * @var array The github data of the project
     */
    private $githubData;

    /**
     * Creates instance of the project
     *
     * @param array $localData  The local data of the project
     * @param array $githubData The github data of the project
     */
    public function __construct(array $localData, array $githubData)
    {
        $this->localData  = $localData;
        $this->githubData = $githubData;
    }

    /**
     * Gets the name of the project
     *
     * @return string The name of the project
     */
    public function getName()
    {
        return $this->localData['name'];
    }

    /**
     * Gets the short description of the project
     *
     * @return string The short description of the project
     */
    public function getShortDescription()
    {
        return $this->localData['description'];
    }

    /**
     * Gets the languages of the project
     *
     * @return string The languages of the project
     */
    public function getLanguage()
    {
        return $this->githubData['language'];
    }

    /**
     * Gets the number of watchers of the project
     *
     * @return int The number of watchers of the project
     */
    public function getWatchers()
    {
        return $this->githubData['watchers'];
    }

    /**
     * Gets the number of forks of the project
     *
     * @return int The number of forks of the project
     */
    public function getForks()
    {
        return $this->githubData['forks'];
    }

    /**
     * Gets the build status of the project
     *
     * @return string The build status of the project
     */
    public function getStatus()
    {
        return $this->localData['status'];
    }
}
