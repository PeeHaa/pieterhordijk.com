<?php
/**
 * Collection of all open source projects
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

use Artax\Client as HttpClient,
    Artax\Response as HttpResponse,
    PieterHordijk\Security\Storage;

/**
 * Collection of all open source projects
 *
 * @category   PieterHordijk
 * @package    OpenSource
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Collection
{
    /**
     * @var \PDO The database connection
     */
    private $dbConnection;

    /**
     * @var \Artax\Client Instance of the http client
     */
    private $httpClient;

    /**
     * @var \PieterHordijk\OpenSource\ProjectFactory Project factory
     */
    private $projectFactory;

    /**
     * @var \PieterHordijk\Security\Storage The storage for the API key and secret
     */
    private $secureStorage;

    /**
     * @var array List of responses
     */
    private $responses = [];

    /**
     * Creates the instance
     *
     * @param \PDO $dbConnection                       The database connection
     * @param \Artax\Client                            Instance of the http client
     * @param \PieterHordijk\OpenSource\ProjectFactory Project factory
     * @param \PieterHordijk\Security\Storage          Storage for the API key and secret
     */
    public function __construct(
        \PDO $dbConnection,
        HttpClient $httpClient,
        ProjectFactory $projectFactory,
        Storage $secureStorage
    )
    {
        $this->dbConnection   = $dbConnection;
        $this->httpClient     = $httpClient;
        $this->projectFactory = $projectFactory;
        $this->secureStorage  = $secureStorage;
    }

    /**
     * Gets all open source projects
     *
     * @return array List of all open source projects
     */
    public function get()
    {
        $projects = $this->getFromLocal();

        $repos = [];
        foreach ($projects as $project) {
            $repos[$project['id']] = 'https://api.github.com/repos/' . $project['github'] . $this->getOauthInfo();
        }

        $this->getFromGitHub($repos);

        return $this->parse($projects);
    }

    /**
     * Gets a single open source project
     *
     * @param int $id The id of the project
     *
     * @return \PieterHordijk\OpenSource\Project The project
     */
    public function getById($id)
    {
        $query = 'SELECT id, name, description, github, image, content, status';
        $query.= ' FROM opensource';
        $query.= ' WHERE id = :id';

        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch();
        if (!$result) {
            return false;
        }

        $this->getFromGitHub([
            $result['id'] => 'https://api.github.com/repos/' . $result['github'] . $this->getOauthInfo(),
        ]);

        $parsedProjects = $this->parse([$result]);

        return reset($parsedProjects);
    }

    private function getOauthInfo()
    {
        return '?client_id=' . $this->secureStorage->get('id') . '&client_secret=' . $this->secureStorage->get('secret');
        //client_id=xxxxxxxxxxxxxx&client_secret=yyyyyyyyyyyyyyyyyyyyy
    }

    /**
     * Get all open source projects
     *
     * @return array All open source projects
     */
    private function getFromLocal()
    {
        $query = 'SELECT id, name, description, github, image, content, status';
        $query.= ' FROM opensource';
        $query.= ' ORDER BY id DESC';

        $stmt = $this->dbConnection->query($query);

        return $stmt->fetchAll();
    }

    /**
     * Gets the information from GitHub
     *
     * @param array $repos The list of repoisitories to get
     */
    private function getFromGitHub(array $repos)
    {
        $onResponse = function($requestKey, HttpResponse $response) {
            $this->responses[$requestKey] = json_decode($response->getBody(), true);
        };

        $onError = function($requestKey, Exception $error) {
            echo 'Error: (', $requestKey, ') ', get_class($error), "\n";
        };

        $this->httpClient->requestMulti($repos, $onResponse, $onError);
    }

    /**
     * Initializes and parses the projects
     *
     * @param array $projects The projects to parse
     *
     * @return array The parsed projects
     */
    private function parse(array $projects)
    {
        $parsedProjects = [];
        foreach ($projects as $project) {
            $parsedProjects[$project['id']] = $this->projectFactory->build($project, $this->responses[$project['id']]);
        }

        return $parsedProjects;
    }
}
