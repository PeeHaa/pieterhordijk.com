<?php
/**
 * Tutorial item
 *
 * PHP version 5.4
 *
 * @category   PieterHordijk
 * @package    Tutorial
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PieterHordijk\Tutorial;

/**
 * Tutorial item
 *
 * @category   PieterHordijk
 * @package    Tutorial
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Item
{
    /**
     * @var \PDO The database connection
     */
    private $dbConnection;

    /**
     * Creates the instance
     *
     * @param \PDO $dbConnection The database connection
     */
    public function __construct(\PDO $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * Gets the content of the tutorial by its slug
     *
     * @param string $slug The slug of the tutorial
     *
     * @return string The content of the tutorial
     */
    public function getBySlug($slug)
    {
        $stmt = $this->dbConnection->prepare('SELECT content FROM tutorials WHERE slug = :slug');
        $stmt->execute([
            'slug' => $slug
        ]);

        return $stmt->fetch(0)['content'];
    }
}
