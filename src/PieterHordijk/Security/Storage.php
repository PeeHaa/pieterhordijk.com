<?php
/**
 * Container for storing sensitive data
 *
 * PHP version 5.4
 *
 * @category   PieterHordijk
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PieterHordijk\Security;

/**
 * Container for storing sensitive data
 *
 * @category   PieterHordijk
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Storage
{
    /**
     * @var array The stored data
     */
    private $data = [];

    /**
     * Stores an item
     *
     * @param string $key   The key under which to store the item
     * @param mixed  $value The value to store
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Gets an item
     *
     * @param string $key The key of which to get the value
     *
     * @return mixed The value
     */
    public function get($key)
    {
        return $this->data[$key];
    }
}
