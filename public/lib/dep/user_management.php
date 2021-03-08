<?php

class user_management
{
    /**
     * Stores the current state
     * @var  array
     */
    protected $current;
    /**
     * @var cache
     */
    protected $cache;
    /**
     * Stores the basic configuration
     * ['tables']['user']
     * ['tables']['ou']
     * @var array
     */
    protected $config;
    /**
     * @var mysqli
     */
    protected $mysql;
    /**
     * @var alerts
     */
    protected $alert;

    public function __construct($config, $mysql, $cache = NULL, $alert = NULL)
    {
        $this->mysql = $mysql;
        foreach ($config['tables'] as $key => $value) {
            $config['tables'][$key] = $this->mysql->real_escape_string($value);
        }

        foreach ($config['user']['fields'] as $key => $value) {
            if (empty($value['auth'])) {
                $config['user']['fields'][$key]['auth'] = false;
            }
            if (empty($value['required'])) {
                $config['user']['fields'][$key]['required'] = false;
            }
        }
        $this->config = $config;
        if (!empty($cache)) {
            $this->cache = $cache;
            if (!empty($this->cache->fetch("user_management", "current"))) {
                $this->current = $this->cache->fetch("user_management", "current");
            }
        }
        if(!empty($alert)){
            $this->alert = $alert;
        }
    }

    public function __destruct()
    {
        if (!empty($this->cache) and !empty($this->current)) {
            $this->cache->insert($this->current, "user_management", "current");
        }
    }



    /****************************
     ************ User ************
     ****************************/

    /**
     * ['firstname']
     * ['lastname']
     * ['alias']
     * ['sex']
     * ['password']
     * ['mail']
     * @param $data_input
     * @return boolean
     */
    function user_create($data_input)
    {
        $auth = array();
        foreach ($this->config['user']['fields'] as $field) {
            if ($field['required'] and empty($data_input[$field['name']])) {
                return false;
            }
            if ($field['auth']) {
                $auth[] = "`" . $this->mysql->real_escape_string($field['name']) . "` = '" . $this->mysql->real_escape_string($data_input[$field['name']]) . "'";
            }
            if(!empty($data_input[$field['name']])){
                $data[$field['name']] = $data_input[$field['name']];
            }
        }

        $where = implode(" or ", $auth);
        $query = "Select * from `" . $this->config['tables']['user'] . "` where $where";
        $query = $this->mysql->query($query);
        if ($query->num_rows > 0) {
            return false;
        }

        $data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);

        $keys = "`" . implode("`, `", array_keys($data)) . "`";
        $values = "'" . implode("', '", $data) . "'";

        $query = "Insert into `" . $this->config['tables']['user'] . "` ($keys) VALUES ($values)";
        if ($this->mysql->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns true if currently logged in
     * @return bool
     */
    public function logged_in()
    {
        if (empty($this->current['user_id'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *Logs a user out
     */
    public function logout()
    {
        unset($this->current);
        if (!empty($this->cache)) {
            $this->cache->clear("all");
        }
    }

    /**
     * Returns information about the user or false if not logged in
     * @return bool|array
     */
    public function user_current()
    {
        if (empty($this->current['user_id'])) {
            return false;
        }
        #Check if Cache Fallback is required
        if (!empty($this->cache)) {
            if (empty($this->cache->fetch("user_management", "user_current"))) {
                $user_fetch = $this->user_fetch($this->current['user_id']);
                if ($user_fetch === false) {
                    return false;
                }
                $this->cache->insert($user_fetch, "user_management", "user_current");
            }
            return $this->cache->fetch("user_management","user_current");
        } else {
            $user_fetch = $this->user_fetch($this->current['user_id']);
            if ($user_fetch === false) {
                return false;
            }
            return $user_fetch;
        }
    }

    /**
     * Returns information about the user or if no user_id is given information about all users
     * @param integer|null $user_id
     * @return bool|array
     */
    function user_fetch($user_id = NULL)
    {
        if (empty($user_id)) {
            $query = 'Select * from `' . $this->config['tables']['user'] . '`';
        } else {
            $query = 'Select * from `' . $this->config['tables']['user'] . '` where `user_id` = ' . $this->mysql->real_escape_string($user_id);
        }
        $query = $this->mysql->query($query);
        if ($query->num_rows > 0) {
            return $query->fetch_array(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    /**
     * Logs a user in
     * @param string $user_alias User Alias
     * @param string $password Unhashed password submitted by the user
     * @param string $method "password", "token", "force"
     * @return bool
     */
    public function user_login($user_alias, $password, $method = 'password')
    {
        if (!empty($this->current['user_id'])) {
            $this->logout();
        }
        if (empty($method)) {
            return false;
        }
        if (($method == 'password' or $method == 'token') and (empty($user_alias) or empty($password))) {
            $this->alert->add('error', 502);
            return false;
        } elseif ($method == 'force' and empty($user_alias)) {
            return false;
        }

        $user_alias = $this->mysql->real_escape_string($user_alias);
        $query = "Select * from `" . $this->config['tables']['user'] . "` where user_alias = '" . $user_alias . "' or user_mail = '" . $user_alias . "'";
        $query = $this->mysql->query($query);
        if ($query->num_rows != 1) {
            $this->alert->add('error', 502);
            return false;
        }
        $data = $query->fetch_array(MYSQLI_ASSOC);
        if ($method == 'token' and $data['user_token'] != $password) {
            $this->alert->add('error', 502);
            return false;
        } elseif ($method == 'password' and !password_verify($password, $data['user_password'])) {
            $this->alert->add('error', 502);
            return false;
        }
        $this->current['user_id'] = $data['user_id'];
        $this->current['ou_id'] = $data['ou_id'];
        if (!empty($this->cache)) {
            $this->cache->insert($data, "user_management", "user_current");
        }
        return true;
    }

    /****************************
     ************ OU ************
     ****************************/

    /**
     * @param $data_input
     */
    function ou_create($data_input)
    {
        $auth = array();
        foreach ($this->config['ou']['fields'] as $field) {
            if ($field['required'] and empty($data_input[$field['name']])) {
                return false;
            }
            if ($field['auth']) {
                $auth[] = "`" . $this->mysql->real_escape_string($field['name']) . "` = '" . $this->mysql->real_escape_string($data_input[$field['name']]) . "'";
            }
            if(!empty($data_input[$field['name']])){
                $data[$field['name']] = $data_input[$field['name']];
            }
        }

        $where = implode(" or ", $auth);
        $query = "Select * from `" . $this->config['tables']['ou'] . "` where $where";
        $query = $this->mysql->query($query);
        if ($query->num_rows > 0) {
            return false;
        }

        $keys = "`" . implode("`, `", array_keys($data)) . "`";
        $values = "'" . implode("', '", $data) . "'";

        $query = "Insert into `" . $this->config['tables']['ou'] . "` ($keys) VALUES ($values)";
        if ($this->mysql->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns data of the currently logged in ou or false if not logged in
     * @return bool|array
     */
    public function ou_current()
    {
        if (empty($this->current['ou_id'])) {
            return false;
        }
        if (empty($this->cache) or empty($this->cache->fetch("user_management", "ou_current"))) {
            $ou_fetch = $this->ou_fetch($this->current['ou_id']);
            if ($ou_fetch === false) {
                return false;
            }
            if (!empty($this->cache)) {
                $this->cache->insert($ou_fetch, "user_management", "ou_current");
            }
            return $ou_fetch;
        }
        return $this->cache->fetch("user_management", "ou_current");
    }

    /**
     * Returns all available OUs or information about the selected OU
     * @param null|integer $ou_id (optional) OU ID
     * @return array|bool
     */
    public function ou_fetch($ou_id = NULL)
    {
        if (empty($ou_id)) {
            $query = 'Select * from `' . $this->config['tables']['ou'] . '`';
        } else {
            $query = 'Select * from `' . $this->config['tables']['ou'] . '` where `ou_id` = ' . $this->mysql->real_escape_string($ou_id);
        }
        $query = $this->mysql->query($query);
        $return = array();
        if($query ==false){
            return false;
        }
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $return[$row['ou_id']] = $row;
            }
        }
        if (empty($return)) {
            return false;
        } else {
            if (empty($ou_id)) {
                return $return;
            } else {
                if (empty($return[$ou_id])) {
                    return false;
                } else {
                    return $return[$ou_id];
                }
            }
        }
    }
}