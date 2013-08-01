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
     * Gets the id of the project
     *
     * @return int The id of the project
     */
    public function getId()
    {
        return $this->localData['id'];
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
     * Gets the slug of the project
     *
     * @return string The slug of the project
     */
    public function getSlug()
    {
        return $this->slugify($this->getName());
    }

    /**
     * Slugifies the name of the project
     *
     * @param string $name The name of the project
     *
     * @return string The slugified name of the project
     */
    private function slugify($name)
    {
        $name = preg_replace('~[^\\pL\d]+~u', '-', $name);
        $name = trim($name, '-');
        $name = iconv('utf-8', 'us-ascii//TRANSLIT', $name);
        $name = strtolower($name);
        $name = preg_replace('~[^-\w]+~', '', $name);

        if (empty($name)) {
            return 'n-a';
        }

        return $name;
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
     * Gets the content of the project
     *
     * @return string The content of the project
     */
    public function getContent()
    {
        return $this->localData['content'];
    }

    /**
     * Gets the GitHub slug
     *
     * @return string The GitHub slug
     */
    public function getGitHubSlug()
    {
        return $this->localData['github'];
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
