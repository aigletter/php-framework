<?php


namespace Core\Components\Cache;


use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    //protected const FILE_NAME = 'data/cache/cache.json';

    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function get($key, $default = null)
    {
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/../' . $this->filename;
        $content = file_get_contents($filename);
        if ($content) {
            $data = json_decode($content, true);
        } else {
            $data = [];
        }
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }

    public function set($key, $value, $ttl = null)
    {
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/../' . $this->filename;
        $content = file_get_contents($filename);
        if ($content) {
            $data = json_decode($content, true);
        } else {
            $data = [];
        }

        $data[$key] = $value;

        file_put_contents($filename, json_encode($data));
    }

    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    public function clear()
    {
        // TODO: Implement clear() method.
    }

    public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    public function deleteMultiple($keys)
    {
        // TODO: Implement deleteMultiple() method.
    }

    public function has($key)
    {
        // TODO: Implement has() method.
    }
}