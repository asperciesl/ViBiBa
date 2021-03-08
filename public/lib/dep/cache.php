<?php

class cache
{

    /**
     * @var array Describes the available field types.
     */
    protected $cache;

    /**
     * @var string Name of the $_SESSION key to store the cache. Default NULL
     */
    protected $session_key;

    public function __construct($session_key = NULL, $init_timeout = NULL)
    {
        if (!empty($session_key)) {
            $this->session_key = $session_key;
            if(session_status() === PHP_SESSION_ACTIVE and !empty($init_timeout)){
                $this->init($_SESSION[$session_key] ?? array(), $init_timeout);
            }
        }
    }

    function __destruct()
    {
        if(session_status() === PHP_SESSION_ACTIVE and !empty($this->session_key)){
            $_SESSION[$this->session_key] = $this->cache;
            session_write_close();
        }
    }

    /**
     * Initialized the cache and respects the given timeout array to remove unwanted entries.
     * @param array $init
     * @param array $init_timeout
     */
    public function init($init, $init_timeout)
    {
        $this->cache = $init;
        foreach ($init_timeout as $name => $timeout) {
            if (!empty($this->cache[$name])) {
                if (
                    !empty($this->cache[$name]['settings']['dimensions'])
                    and $this->cache[$name]['settings']['dimensions'] == 2
                ) {
                    foreach ($this->cache[$name] as $key => $entry) {
                        if ($key != 'settings') {
                            if (empty($entry['last_update']) or ($entry['last_update'] + $timeout < time())) {
                                unset($this->cache[$name][$key]);
                                if (count($this->cache[$name]) <= 1) {
                                    unset($this->cache[$name]);
                                }
                            }
                        }
                    }
                } else {
                    if (empty($this->cache[$name]['last_update']) or ($this->cache[$name]['last_update'] + $timeout < time())) {
                        unset($this->cache[$name]);
                    }
                }
            }
        }
    }

    /**
     * Clears the specified cache. If set to "all" all cached information is cleared.
     * @param string $cache "all" or name of cache to clear
     */
    public function clear($cache = "all")
    {
        if ($cache == "all") {
            if (!empty($this->cache)) {
                $this->cache = array();
            }
        } else {
            if (!empty($this->cache[$cache])) {
                unset ($this->cache[$cache]);
            }
        }
    }

    /**
     * Inserts data into the cache
     * @param array|string|boolean|integer|float $data Data to store in said cache
     * @param string $name Name of cache
     * @param string $name_2 Optional: Name of second layer in multidimensional caches
     */
    public function insert($data, $name, $name_2 = NULL)
    {
        if (empty($name_2)) {
            $this->cache[$name]['data'] = $data;
            $this->cache[$name]['last_update'] = time();
            $this->cache[$name]['settings']['dimensions'] = 1;
        } else {
            $this->cache[$name][$name_2]['data'] = $data;
            $this->cache[$name][$name_2]['last_update'] = time();
            $this->cache[$name]['settings']['dimensions'] = 2;
        }
    }

    /**
     * Returns data stored in cache
     * @param string $name Name of cache; If empty the entire cache is returned
     * @param string $name_2 Optional: Name of second layer in multidimensional caches
     * @return mixed|null Data in said cache or entire cache data if no name is given
     */
    public function fetch($name = NULL, $name_2 = NULL)
    {
        if (empty($name)) {
            return $this->cache;
        }
        if (!empty($name_2)) {
            if (empty($this->cache[$name][$name_2])) {
                return null;
            } else {
                return $this->cache[$name][$name_2]['data'];
            }
        }
        if (empty($this->cache[$name])) {
            return null;
        } else {
            return $this->cache[$name]['data'];
        }
    }

}