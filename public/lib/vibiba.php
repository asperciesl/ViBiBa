<?php


class vibiba
{
    /**
     * @var array Stores the $_CONFIG Array from config.php
     */
    protected $config_internal;

    /**
     * @var string Stores the relative path to the plugin directory
     */
    protected $plugin_dir = __DIR__ . '/../plugins/';

    /**
     * @var mysqli Stores the PDO Mysql Handler
     */
    protected $mysql;

    /**
     * @var mysqli_wrapper Stores the MYSQLI_WRAPPER Class
     */
    protected $mysql_w;

    /**
     * @var user_management Stores the USER_MANAGEMENT Class
     */
    public $user;

    /**
     * @var cache Stores the CACHE Class
     */
    public $cache;

    /**
     * Stores timeout values for cached data as array [time in seconds]
     * @var int[]
     */
    protected $cache_timeout = array(
        'db_current' => 60, 'ou_current' => 60,
        'user_current' => 60, 'db_fetch' => 60, 'db_source_fetch_config' => 60,
        'db_fields_fetch' => 60, 'db_fields_fetch_display' => 60, 'db_source_upload' => 60, 'sample_search' => 120, 'basket_current' => 5); # Stores the time in seconds for which a specific cache is kept in storage.

    /**
     * @var table_parser Stores the PHP_ALERTS Class
     */
    public $table_parser;

    /**
     * @var alerts Stores the PHP_ALERTS Class
     */
    public $alerts;

    /**
     * @var string[][] Stores cached data as array
     */
    protected $field_settings = array(
        1 => array('name' => 'plain text', 'source' => 'varchar(765)', 'cache' => 'varchar(765)'),
        2 => array('name' => 'numerical', 'source' => 'int(50)', 'cache' => 'int(60)'), #field_options_1 = decimals
        3 => array('name' => 'date/time', 'source' => 'date', 'cache' => 'varchar(255)'),
        4 => array('name' => 'yes/no', 'source' => 'tinyint(1)', 'cache' => 'tinyint(1)'),
        5 => array('name' => 'dropdown', 'source' => 'int(10)', 'cache' => 'varchar(255)'), #field_options_1 = dimension_ids (separated); field_options_2 = dimensions_names (comma separated)
        6 => array('name' => 'ID - same sample identifier', 'source' => 'varchar(255)', 'cache' => 'varchar(255)'),
        7 => array('name' => 'ID - multi sample identifier', 'source' => 'varchar(255)', 'cache' => 'varchar(255)'),
        8 => array('name' => 'OU', 'source' => 'int(10)', 'cache' => 'varchar(255)'),
        9 => array('name' => 'numerical/multidimensional', 'source' => 'int(10)', 'cache' => 'varchar(255)'), #field_options_1 = dimensions (integer); field_options_2 = dimensions_names (comma separated)
    );

    /**
     * Used for easier and secure redirection through the app
     * @var string[]
     */
    protected $site_structure = array(
        'sample_overview' => 'app/sample/overview',
        'sample_download' => 'app/sample/download',
        'login' => 'app/login',
        'database_select' => 'app/databases',
        'sources_overview' => 'app/sources/overview',
        'index' => 'app/dashboard',
        'maintenance' => 'app/maintenance'
    );

    /**
     * Stores the current state of the app. eg. selected database
     * @var mixed
     */
    protected $current;

    /**
     * Stores the current state of the app. Data is not kept between site reloads.
     * @var mixed
     */
    protected $current_temporary;

    /**
     * Stores an array which is described in the language file.
     * @var array
     */
    protected $lang;

    /** Stores the thrown errors as an array. The error id is matched in the language data file eg. en.php
     * @var string[]
     */
    #public $error = array();

    /** Stores the thrown success messages.
     * @var string[]
     */
    #public $success = array();


    /**
     * samplebank constructor.
     * @param array $config Config values as shown in config.default.php
     * @param array $lang Language Array as shown in lang/en.php
     */
    function __construct($config, $lang)
    {
        $this->lang = $lang;
        if (empty($config['mysql']['host']) or empty($config['mysql']['user']) or empty($config['mysql']['db'])) {
            echo "Error: Incorrect Configuration";
            exit();
        }
        $this->mysql_w = new mysqli_wrapper($config['mysql']);
        $this->mysql = $this->mysql_w->mysql();

        $this->cache = new cache("SB_Cache", $this->cache_timeout);
        $this->alerts = new alerts();
        $this->user = new user_management($config['user_management'], $this->mysql, $this->cache, $this->alerts);
        $this->table_parser = new table_parser();

        # Stores the configuration values from config.php (or similar)
        $this->config_internal = $config;
        if (!empty($_SESSION['SB']['current'])) {
            $this->current = $_SESSION['SB']['current'];
        }
    }

    /**
     * Calls $this->>session_save() and displays some memory usage information
     */
    function __destruct()
    {
        $this->session_save();
        $this->user = NULL;
        $this->cache = NULL;
        #var_dump(memory_get_usage(), 'memory_get_usage()');
        #var_dump(memory_get_peak_usage(), 'memory_get_peak_usage()');
    }

    /**
     * Transfers the current $this->cache and $this->current into a SESSION for further usage
     */
    function session_save()
    {
        if (!empty($this->current)) {
            $_SESSION['SB']['current'] = $this->current;
        }
    }

    /**
     * @param string $field
     * @param string $parent
     * @param array $replace
     * @return array|mixed|string
     */
    function language_output($field = NULL, $parent = NULL, $replace = NULL)
    {
        if (empty($parent) and !empty($field)) {
            $return = $this->lang[$field];
        } elseif (!empty($parent) and !empty($field)) {
            $return = $this->lang[$parent][$field];
        } else {
            $return = $this->lang;
        }

        if (empty($replace) or !is_string($return)) {
            return $return;
        } else {
            $replace_masked = array();
            foreach ($replace as $key => $value) {
                $replace_masked["{" . $key . "}"] = $value;
            }
            return strtr($return, $replace_masked);
        }
    }

    /**
     * Returns the default language
     * @return string
     */
    function lang()
    {
        if (empty($this->current['lang']) or empty($this->config()['languages']['data'][$this->current['lang']])) {
            return $this->config()['languages']['default'];
        }
        return $this->current['lang'];
    }

    /**
     * Select the given language as the 'current'
     * @param integer $lang_id language ID
     * @return bool
     */
    function lang_select($lang_id)
    {
        if (empty($this->config()['languages']['data'][$lang_id])) {
            $this->alerts->add("error", '005');
            return false;
        }
        $this->current['lang'] = $lang_id;
        return true;
    }

    /**
     * Redirection via PHP Header and exit() of file
     * @param string $location Key from $this->site_structure
     */
    function redirect($location)
    {
        if (!empty($this->site_structure[$location])) {
            header('Location: ' . $this->config_internal['url'] . $this->site_structure[$location]);
            exit();
        }
    }

    /**
     * Returns the $_CONFIG Array stored in config.php (and $this->config_internal)
     * @return array
     */
    function config()
    {
        return $this->config_internal;
    }

    /**
     * Returns data from $this->current eg. currently selected database
     * @param string $field Name of requested field
     * @param bool $temporary True if $this->current_temporary should be used
     * @return bool|mixed Requested data or FALSE if non-existend
     */
    function current_fetch($field = NULL, $temporary = false)
    {
        if ($temporary) {
            if (empty($field)) {
                return $this->current_temporary;
            } elseif (!empty($this->current_temporary[$field])) {
                return $this->current_temporary[$field];
            } else {
                return false;
            }
        } else {
            if (empty($field)) {
                return $this->current;
            } elseif (!empty($this->current[$field])) {
                return $this->current[$field];
            } else {
                return false;
            }
        }
    }

    /**********************************
     ************ Database ************
     **********************************/

    /**
     * Creates a new Database
     * @param array $data Array containing information about the new database: "db_name_en", "db_name_..."
     * @return bool
     */
    function db_create($data)
    {
        if (empty($this->current['ou_id'])) {
            $this->alerts->add("error", '003');
            return false;
        }
        if (empty($data['db_name_' . $this->lang()])) {
            $this->alerts->add("error", "004");
            return false;
        }
        foreach ($this->config_internal['languages']['data'] as $language_key => $language_value) {
            $mysql_data['db_name_' . $language_key] = $data['db_name_' . $language_key];
        }
        $mysql_data['ou_id'] = $this->current['ou_id'];
        $db_id = $this->mysql_w->mysql_insert($mysql_data, 'db_config');
        $update = array('db_id' => $db_id, 'db_name_internal' => sprintf("%03d", $db_id));
        $this->mysql_w->mysql_update($update, 'main_db', array('db_id'));
        return true;
    }

    /**
     * Creates missing tables for a database
     * @param integer $db_id ID of the database
     * @param null|string|integer $source_id "cache", "samples" or Source_ID
     * @return bool
     */
    function db_build($db_id, $source_id = "cache")
    {
        if (empty($db_id)) {
            $this->alerts->add("error", "403");
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", "401");
            return false;
        }
        $dbn = $db['db_name_internal'];

        if (!empty($source_id)) {
            if ($source_id == 'samples') {
                $table = "db_" . $dbn . "_samples";
            } elseif ($source_id == 'cache') {
                $table = "db_" . $dbn . "_cache";
            } else {
                $source = $this->db_source_fetch_config($db_id)['id'][$source_id];
                if ($source == false) {
                    $this->alerts->add("error", "405");
                    return false;
                }
                $scn = $source['source_name_internal'];
                $table = "db_" . $dbn . "_source_" . $scn . "_interface";
            }
        } else {
            return false;
        }
        $query = "Drop TABLE if exists `$table` ";
        $this->mysql->query($query);
        $query = "CREATE TABLE `$table` (
`sample_id` int(20) NOT NULL
";
        foreach ($this->db_fields_fetch_core($db_id)['flat_ordered'] as $field) {
            if ($field['field_type'] == 9) {
                if ($source_id == 'cache' or $source_id == 'samples') {
                    $query .= ", `" . $field['field_name_internal'] . "` " . $this->field_settings[$field['field_type']]['cache'] . " NULL DEFAULT NULL";
                }
                for ($x = 1; $x <= $field['field_option_1']; $x++) {
                    $query .= ", `" . $field['field_name_internal'] . "_" . $x . "` " . $this->field_settings[$field['field_type']]['source'] . " NULL DEFAULT NULL";
                }
            } else {
                if ($source_id == 'cache') {
                    $query .= ", `" . $field['field_name_internal'] . "` " . $this->field_settings[$field['field_type']]['cache'] . " NULL DEFAULT NULL";
                } else {
                    $query .= ", `" . $field['field_name_internal'] . "` " . $this->field_settings[$field['field_type']]['source'] . " NULL DEFAULT NULL";
                }
            }
        }
        $query .= "
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        if (!$this->mysql->query($query)) {
            $this->alerts->add("error", "202/1");
            return false;
        }

        $query = "ALTER TABLE `$table`
ADD PRIMARY KEY (`sample_id`),
ADD KEY `ou_id` (`ou_id`);";
        if (!$this->mysql->query($query)) {
            $this->alerts->add("error", "202/2");
            return false;
        }

        $query = "ALTER TABLE `$table`
MODIFY `sample_id` int(20) NOT NULL AUTO_INCREMENT;";
        if (!$this->mysql->query($query)) {
            $this->alerts->add("error", "202/3");
            return false;
        }

        if (!empty($source_id)) {
            $query = "ALTER TABLE `$table`
ADD CONSTRAINT `" . $table . "_ou_id` FOREIGN KEY (`ou_id`) REFERENCES `main_ou` (`ou_id`);";
            if (!$this->mysql->query($query)) {
                $this->alerts->add("error", "202/4");
                return false;
            }
        }

        if ($source_id != 'cache' and $source_id != 'samples' and !empty($scn)) {

            /* Create source_fields table */
            $table = "db_" . $dbn . "_source_" . $scn . "_fields";
            $table_main_fields = "db_" . $dbn . "_fields";

            $query = "DESCRIBE `$table`";
            if ($this->mysql->query($query)) {
                return true;
            }

            $query = "CREATE TABLE `$table` (
`field_id` int(20) NOT NULL,
`source_field_enabled` tinyint(1) NOT NULL DEFAULT '0',
`source_field_position` int(10) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            if (!$this->mysql->query($query)) {
                $this->alerts->add("error", '202/5');
                return false;
            }

            $query = "ALTER TABLE `$table`
ADD PRIMARY KEY (`field_id`),
ADD UNIQUE(`source_field_position`);";
            if (!$this->mysql->query($query)) {
                $this->alerts->add("error", '202/6');
                return false;
            }

            $query = "ALTER TABLE `$table`
ADD CONSTRAINT `" . $table . "_field_id` FOREIGN KEY (`field_id`) REFERENCES `" . $table_main_fields . "` (`field_id`);";
            if (!$this->mysql->query($query)) {
                $this->alerts->add("error", '202/7');
                return false;
            }
            $data = array();
            foreach ($this->db_fields_fetch_core($db_id)['flat'] as $field) {
                $data[] = array('field_id' => $field['field_id']);
            }
            $this->mysql_w->mysql_insert($data, $table, 'multiple');
        }

        return true;
    }

    /**
     * Returns information about the currently selected database or false if none is selected
     * @return bool|array False if none is selected; Otherwise array with data
     */
    function db_current()
    {
        if (empty($this->current['db_id'])) {
#$this->alerts->add("error", '403');
            return false;
        }
        if (empty($this->cache->fetch("db_current"))) {
            $db_fetch = $this->db_fetch($this->current['db_id']);
            if ($db_fetch === false) {
                $this->alerts->add("error", '401');
                return false;
            }
            $this->cache->insert($db_fetch, "db_current");

        }
        return $this->cache->fetch("db_current");
    }

    /**
     * Wrapper for db_fetch_core
     * @param integer|null $db_id DB ID or NULL if information about all DBs should be returned
     * @return array|bool Data or false if DB could not be found
     */
    function db_fetch($db_id = NULL)
    {
        $return = $this->db_fetch_core(NULL, $this->user->user_current()['ou_id']);
        if ($return == false) {
            return false;
        }
        if (!empty($db_id)) {
            return $return[$db_id];
        } else {
            return $return;
        }
    }

    /**
     * Fetches information about a db and its access rights. If no DB ID is given all databases are returned
     * @param integer|null $db_id DB ID if none given all databases are returned
     * @param integer|null $ou_id OU ID to filter for databases that are accessible with given OU
     * @return array|bool|mixed
     */
    function db_fetch_core($db_id = NULL, $ou_id = NULL)
    {
        if (empty($this->cache->fetch('db_fetch'))) {
            $query = 'Select * from db_config';
            $query = $this->mysql->query($query);
            if ($query->num_rows == 0) {
                return false;
            }
            $return = array();
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $return[$row['db_id']] = $row;
            }
            if (empty($db_id)) {
                $query = 'Select * from db_rights';
            } else {
                $query = 'Select * from db_rights where `db_id` = ' . $this->mysql->real_escape_string($db_id);
            }
            $query = $this->mysql->query($query);
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                    $return[$row['db_id']]['rights'][$row['ou_id']] = $row;
                }
            }
            $this->cache->insert($return, 'db_fetch');
        }
        if (empty($this->cache->fetch("db_fetch"))) {
            return false;
        }

        if (!empty($db_id)) {
            return $this->cache->fetch("db_fetch")[$db_id];
        }

        if (!empty($ou_id)) {
            $return = array();
            foreach ($this->cache->fetch('db_fetch') as $db_id => $db_data) {
                if (!empty($db_data['rights'][$ou_id])) {
                    $return[$db_id] = $db_data;
                }
            }
            if (empty($return)) {
                return false;
            }
            return $return;
        } else {
            return $this->cache->fetch('db_fetch');
        }
    }

    /**
     * Select the given DB as the 'current'
     * @param integer $db_id Database ID
     * @return bool
     */
    function db_select($db_id)
    {
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", '401');
            return false;
        }
        if (empty($db['rights'][$this->user->user_current()['ou_id']]) or $db['rights'][$this->user->user_current()['ou_id']]['db_access_right'] < 1) {
            $this->alerts->add("error", '402');
            return false;
        }
        $this->current['db_id'] = $db_id;
        $this->db_fields_display_set_default();
        return true;
    }

    /**********************************
     ***** Database/Fields ************
     **********************************/

    /**
     * Wrapper for db_fields_fetch_core
     * @param bool $consider_display If true only categories selected by the user will be considered
     * @param bool $output_display
     * @return bool|mixed
     */
    function db_fields_fetch($consider_display = false, $output_display = false)
    {
        if (empty($this->current['db_id'])) {
            $this->alerts->add("error", 403);
            return false;
        }
        return $this->db_fields_fetch_core($this->db_current()['db_id'], $consider_display, $output_display);
    }

    /**
     * Returnes information about the available fields and its parents
     * @param integer $db_id Database ID
     * @param bool $consider_display If true only categories selected by the user will be considered
     * @param bool $output_display
     * @return bool|mixed
     */
    function db_fields_fetch_core($db_id, $consider_display = false, $output_display = false)
    {
        if (empty($db_id)) {
            $this->alerts->add("error", 403);
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", 401);
            return false;
        }
        if ($consider_display) {
            if (empty($this->db_fields_parents_display_fetch())) {
                $consider_display = false;
            }
        }

        if (
            (!$consider_display and empty($this->cache->fetch("db_fields_fetch")[$db_id]))
            or
            ($consider_display and empty($this->cache->fetch("db_fields_fetch")[$db_id]))
        ) {
            $return = array();
            if ($consider_display) {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_fields_parents` where field_parent_id in (' . implode(',', $this->db_fields_parents_display_fetch()) . ') order by field_parent_order';
            } else {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_fields_parents` order by field_parent_order';
            }
            $query = $this->mysql->query($query);
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                    $row['field_parent_name'] = $row['field_parent_name_' . $this->lang()];
                    $return['parents'][$row['field_parent_id']] = $row;
                    $return['parents_ordered'][] = $row;
                }
            }
            if ($consider_display) {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_fields` where field_id in (' . implode(',', $this->db_fields_display_fetch()) . ')  order by field_order';
            } else {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_fields` order by field_order';
            }
            $query = $this->mysql->query($query);
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
#9: numerical/multidimensional
                    if ($row['field_type'] == 9) {
                        $row['field_dimensions'] = explode(',', $row['field_option_2']);
                    }
                    $row['field_name'] = $row['field_name_' . $this->lang()];

                    $return['hierarchy'][$row['field_parent_id']][$row['field_id']] = $row;
                    $return['hierarchy_ordered'][$return['parents'][$row['field_parent_id']]['field_parent_order']][$row['field_order']] = $row;
                    $return['flat'][$row['field_id']] = $row;
                    $return['flat_ordered'][sprintf("%03d", $return['parents'][$row['field_parent_id']]['field_parent_order']) . '_' . sprintf("%03d", $row['field_order'])] = $row;
                    $return['flat_by_name'][$row['field_name_internal']] = $row;
                    $return['field_type'][$row['field_type']][] = $row;
                }
            }
            ksort($return['flat_ordered']);
            ksort($return['parents_ordered']);
            ksort($return['hierarchy_ordered']);
            foreach ($return['hierarchy_ordered'] as $key => $value) {
                ksort($return['hierarchy_ordered'][$key]);
            }
            $fields_identifier = array_merge($return['field_type'][6], $return['field_type'][7]);
            $fields_identifier_single = $return['field_type'][6];
            $return['keys'] = $this->pluck($fields_identifier, 'field_name_internal');
            $return['keys_single'] = $this->pluck($fields_identifier_single, 'field_name_internal');
            if ($consider_display) {
                $this->cache->insert($return, "db_fields_fetch_display", $db_id);
            } else {
                $this->cache->insert($return, "db_fields_fetch", $db_id);
            }
        }
        if ($consider_display and !empty($this->db_fields_parents_display_fetch())) {
            return $this->cache->fetch('db_fields_fetch_display', $db_id);
        } else {
            return $this->cache->fetch('db_fields_fetch', $db_id);
        }

    }

    /**
     * Returns a list of parent fields that should be displayed according to the settings of the user
     * @return array
     */
    function db_fields_parents_display_fetch()
    {
        if (!empty($this->current_temporary['fields_parents_display'])) {
            return $this->current_temporary['fields_parents_display'];
        } elseif (!empty($this->current_temporary['fields_display'])) {
            $all_fields = $this->db_fields_fetch(false, false)['flat'];
            $return = array();
            foreach ($this->current_temporary['fields_display'] as $field) {
                if (!empty($all_fields[$field])) {
                    $return[$all_fields[$field]['field_parent_id']] = $all_fields[$field]['field_parent_id'];
                }
            }
            return $return;
        } else {
            return $this->current['fields_parents_display'];
        }
    }

    /**
     * Returns a list of fields that should be displayed according to the settings of the user
     * @return array
     */
    function db_fields_display_fetch()
    {
        if (!empty($this->current_temporary['fields_display'])) {
            return $this->current_temporary['fields_display'];
        } elseif (!empty($this->current_temporary['fields_parents_display'])) {
            $all_fields = $this->db_fields_fetch(false, false)['hierarchy'];
            $return = array();
            foreach ($this->current_temporary['fields_parents_display'] as $field) {
                if (!empty($all_fields[$field['id']])) {
                    foreach ($all_fields[$field['id']] as $child_field) {
                        $return[$child_field[$field['id']]] = $child_field[$field['id']];
                    }
                }
            }
            return $return;
        } elseif (!empty($this->current['fields_display'])) {
            return $this->current['fields_display'];
        } elseif (!empty($this->current['fields_parents_display'])) {
            $all_fields = $this->db_fields_fetch(false, false)['hierarchy'];
            $return = array();
            foreach ($this->current['fields_parents_display'] as $field) {
                if (!empty($all_fields[$field])) {
                    foreach ($all_fields[$field] as $child_field) {
                        $return[$child_field['field_id']] = $child_field['field_id'];
                    }
                }
            }
            return $return;
        } else {
            return array();
        }
    }

    /*
    * $fields = array(
    * field_id => display,
    * field_id => display
    * 0: disabled
    * 1: enabled (display)
    * */

    /**
     * Sets the display settings of the field parents of the user
     * @param array $fields array(field_id => display, field_id2 => display ...) where display is boolean
     * @param bool $temporary If true settings will not be saved in the SESSION
     */
    function db_fields_parents_display_set($fields, $temporary = false)
    {
        if ($temporary) {
            $return = $this->current_temporary['fields_parents_display'];
        } else {
            $return = $this->current['fields_parents_display'];
        }
        foreach ($fields as $field_id => $display) {
            if ($display == 1) {
                $return[$field_id] = $field_id;
            } else {
                if (isset($return[$field_id])) {
                    unset($return[$field_id]);
                }
            }
        }
        if ($temporary) {
            $this->current_temporary['fields_parents_display'] = $return;
        } else {
            $this->current['fields_parents_display'] = $return;
        }
        $this->cache->clear('db_fields_fetch_display');
    }

    /**
     * Sets the display settings of the field of the user
     * @param array $fields array(field_id => display, field_id2 => display ...) where display is boolean
     * @param bool $temporary If true settings will not be saved in the SESSION
     */
    function db_fields_display_set($fields, $temporary = false)
    {
#d($fields, "input fields_display_set");
        if ($temporary) {
            $return = $this->current_temporary['fields_display'];
        } else {
            $return = $this->current['fields_display'];
        }
        foreach ($fields as $field_id => $display) {
            if ($display == 1) {
                $return[$field_id] = $field_id;
            } else {
                if (isset($return[$field_id])) {
                    unset($return[$field_id]);
                }
            }
        }
        if ($temporary) {
            $this->current_temporary['fields_display'] = $return;
        } else {
            $this->current['fields_display'] = $return;
        }
        $this->cache->clear('db_fields_fetch_display');
    }

    /**
     * Resets the display settings back to the default
     * @param bool $temporary If true settings will not be saved in the SESSION
     */
    function db_fields_display_set_default($temporary = false)
    {
        if ($temporary) {
            $this->current_temporary['fields_display'] = array();
            $this->cache->clear('db_fields_fetch_display');
        } else {
            $this->current['fields_display'] = array();
            $fields_display = array();
            foreach ($this->db_fields_fetch()['parents'] as $field) {
                if ($field['field_parent_display_default'] == 1) {
                    $fields_display[$field['field_parent_id']] = 1;
                }
            }
            if (!empty($fields_display)) {
                $this->db_fields_parents_display_set($fields_display);
            }
        }
    }

    /*
    * 1: Text
    * 2: Numerical (Option 1: decimals)
    * 3: Date/Time
    * 4: yes/no
    * 5:
    * 6: sample identifier
    * 7: multisample identifier
    * 8: OU
    * 9: numerical/multidimensional (Option 1: dimensions; Option 2: name of dimensions, separated by comma)
    * */
    /**
     * Combines Data from different OUs into a single entry for display purposes
     * @param integer $db_id Database ID
     * @param array $data array (ou_id => data, ou_id => data ...)
     * @return array
     */
    function db_fields_sum($db_id, $data)
    {
        $ous = $this->user->ou_fetch();
        $return = array();
        foreach ($this->db_fields_fetch_core($db_id)['flat'] as $field) {
#1: Textfield; 3:Date/time
            if ($field['field_type'] == 1 or $field['field_type'] == 3) {
                foreach ($data as $ou_id => $value) {
                    if (empty($return[$field['field_name_internal']])) {
                        $return[$field['field_name_internal']] = $value[$field['field_name_internal']];
                    } elseif (!empty($value[$field['field_name_internal']])) {
                        $return[$field['field_name_internal']] .= ' | ' . $value[$field['field_name_internal']];
                    }
                }
            } #2:Numerical
            elseif ($field['field_type'] == 2) {
                foreach ($data as $ou_id => $value) {
                    if (empty($return[$field['field_name_internal']])) {
                        $return[$field['field_name_internal']] = $value[$field['field_name_internal']];
                    } else {
                        $return[$field['field_name_internal']] += $value[$field['field_name_internal']];
                    }
                }
            }#4:yes/no
            elseif ($field['field_type'] == 4) {
                foreach ($data as $ou_id => $value) {
                    if ($value[$field['field_name_internal']] == true or $value[$field['field_name_internal']] == 1) {
                        $return[$field['field_name_internal']] = true;
                    }
                }
                if (empty($return[$field['field_name_internal']])) {
                    $return[$field['field_name_internal']] = false;
                }
            }#6: sample identifier; 7: multisample identifier
            elseif ($field['field_type'] == 6 or $field['field_type'] == 7) {
                foreach ($data as $ou_id => $value) {
                    if (!empty($value[$field['field_name_internal']])) {
                        $return[$field['field_name_internal']] = $value[$field['field_name_internal']];
                    }
                    if (empty($return[$field['field_name_internal']])) {
                        $return[$field['field_name_internal']] = NULL;
                    }
                }
            }#8: OU
            elseif ($field['field_type'] == 8) {
                $ou_list = array();
                foreach ($data as $ou_id => $value) {
                    $ou_list[$value['ou_id']] = $ous[$value['ou_id']]['ou_name'];
                }
#$return['ou_id'] = implode(', ', array_keys($ou_list));
                $return['ou_id'] = implode(', ', $ou_list);
            }#9: numerical/multidimensional
            elseif ($field['field_type'] == 9) {
                $return[$field['field_name_internal']] = $this->db_field_format_multidim($field, $data);
            }
        }
        return $return;
    }

    function db_field_format_multidim($field, $data)
    {
        foreach ($data as $ou_id => $value) {
            for ($x = 1; $x <= $field['field_option_1']; $x++) {
                if (empty($return[$field['field_name_internal'] . '_' . $x])) {
                    $return[$field['field_name_internal'] . '_' . $x] = $value[$field['field_name_internal'] . '_' . $x];
                } else {
                    $return[$field['field_name_internal'] . '_' . $x] += $value[$field['field_name_internal'] . '_' . $x];
                }
            }
        }
#$some_value is used to check if all fields are empty so we can set a NULL value
        $some_value = false;
        for ($x = 1; $x <= $field['field_option_1']; $x++) {
            if (empty($return[$field['field_name_internal'] . '_' . $x])) {
                $return[$field['field_name_internal'] . '_' . $x] = 0;
            } else {
                $some_value = true;
            }

            if (!isset($return[$field['field_name_internal']])) {
                $return[$field['field_name_internal']] = $return[$field['field_name_internal'] . '_' . $x];
            } else {
                $return[$field['field_name_internal']] .= '/' . $return[$field['field_name_internal'] . '_' . $x];
            }
        }
        if (!$some_value) {
            $return[$field['field_name_internal']] = 'NULL';
        }
        return $return[$field['field_name_internal']];
    }

    /**********************************
     ***** Database/Source ************
     **********************************/

    /**
     * @param $db_id
     * @return bool
     */
    function db_source_cache($db_id)
    {
        if (empty($db_id)) {
            $this->alerts->add('error', '403');
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add('error', '401');
            return false;
        }
        $data = $this->db_source_merge($db_id);
        if ($data == false) {
            return false;
        }

        $data_uncompressed = array();
        $fields = $this->db_fields_fetch_core($db_id)['flat'];
        foreach ($data as $value) {
            foreach ($value as $value_2) {
                unset($value_2['sample_id']);
                foreach ($fields as $field) {
                    if ($field['field_type'] == 9) {
                        $value_2[$field['field_name_internal']] = $this->db_field_format_multidim($field, array(0 => $value_2));
                    }
                }
                $data_uncompressed[] = $value_2;
            }
        }

        foreach ($data as $key => $value) {
            $data[$key] = $this->db_fields_sum($db_id, $value);
        }

#d($data_uncompressed, "data passed to mysql_func");
        $table = $this->mysql_table_name('samples');
        $query = "TRUNCATE `$table`";
        $this->mysql->query($query);
        $this->mysql_w->mysql_insert($data_uncompressed, $table, 'multiple');

#d($data, "data passed to mysql_func");
        $table = $this->mysql_table_name('cache');
        $query = "TRUNCATE `$table`";
        $this->mysql->query($query);
        if ($this->mysql_w->mysql_insert($data, $table, 'multiple') !== false) {
            return true;
        } else {
            $this->alerts->add('error', '100');
            return false;
        }
    }

    /**
     * Merges all sources, reduces data to one entry per sample per OU; Respects source priority
     * @param integer $db_id Database ID
     * @return array|mixed
     */
    function db_source_merge($db_id)
    {
        $sources = $this->db_source_fetch_config($db_id);
        $fields = $this->db_fields_fetch_core($db_id);
        $key = $fields['field_type'][6][0]['field_name_internal'];
        $data = array();
        foreach ($sources['priority'] as $priority => $source) {
            $data = $this->db_source_fetch_interface($db_id, $source['source_id'], $key, 'ou_id', $data);
        }
        foreach ($data as $main_key => $per_main_key) {
            foreach ($per_main_key as $ou_id => $per_ou_id) {
                foreach ($this->db_fields_fetch_core($db_id)['flat'] as $field) {
                    if ($field['field_type'] == 9) {
#$some_value is used to check if all fields are empty so we can set a NULL value
                        $some_value = false;
                        for ($x = 1; $x <= $field['field_option_1']; $x++) {
                            if (empty($return[$field['field_name_internal'] . '_' . $x])) {
                                $per_ou_id[$field['field_name_internal'] . '_' . $x] = 0;
                            } else {
                                $some_value = true;
                            }

                            if (!isset($per_ou_id[$field['field_name_internal']])) {
                                $per_ou_id[$field['field_name_internal']] = $per_ou_id[$field['field_name_internal'] . '_' . $x];
                            } else {
                                $per_ou_id[$field['field_name_internal']] .= '/' . $per_ou_id[$field['field_name_internal'] . '_' . $x];
                            }
                        }
                        if (!$some_value) {
                            $per_ou_id[$field['field_name_internal']] = 'NULL';
                        }
                        $data[$main_key][$ou_id][$field['field_name_internal']] = $per_ou_id[$field['field_name_internal']];
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Returns all availible sources (for this OU); If no database was selected previously returns FALSE
     * @return bool|array
     */
    function db_source_fetch_available()
    {
        if (empty($this->current['db_id'])) {
            $this->alerts->add("error", 403);
            return false;
        }
        return $this->db_source_fetch_config($this->current['db_id'], $this->user->ou_current()['ou_id']);
    }

    /**
     * Returns all sources (regardless of writing permissions for current OU); If no database was selected previously returns FALSE
     * @return bool|array
     */
    function db_source_fetch_all($db_id = NULL)
    {
        if (empty($this->current['db_id']) and empty($db_id)) {
            $this->alerts->add("error", 403);
            return false;
        }
        if (!empty($db_id)) {
            return $this->db_source_fetch_config($db_id);
        }
        return $this->db_source_fetch_config($this->current['db_id']);
    }

    /**
     * Returns information about the sources
     * @param integer $db_id Database ID
     * @param null|integer $ou_id OU ID (Optional)
     * @return bool|mixed
     */
    function db_source_fetch_config($db_id, $ou_id = NULL)
    {
        if (empty($db_id)) {
            $this->alerts->add("error", 403);
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", 401);
            return false;
        }
        if (
            (empty($ou_id) and
                empty($this->cache->fetch('db_source_fetch_config', $db_id)))
            or
            (!empty($ou_id) and
                empty($this->cache->fetch('db_source_fetch_config_ou', $db_id)))
        ) {
            if (empty($ou_id)) {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_config` order by source_priority ASC';
            } else {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_rights`
left join `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_config`
on `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_config`.source_id =  `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_rights` .source_id
where ou_id = ' . $this->mysql->real_escape_string($ou_id) . '
order by source_priority ASC';
            }

            $query = $this->mysql->query($query);
            if ($query->num_rows == 0) {
                return false;
            }

            $return = array();
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $return['id'][$row['source_id']] = $row;
                $return['priority'][$row['source_priority']] = $row;
            }
            if (empty($ou_id)) {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_rights`';
            } else {
                $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_rights`
left join `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_config`
on `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_config`.source_id =  `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_rights` .source_id
where ou_id = ' . $this->mysql->real_escape_string($ou_id) . '
order by source_priority ASC';
            }

            $query = $this->mysql->query($query);
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                    $return['id'][$row['source_id']]['rights'][$row['ou_id']] = $row;
                    $return['priority'][$return['id'][$row['source_id']]['source_priority']]['rights'][$row['ou_id']] = $row;
                }
            }
            ksort($return['id']);
            krsort($return['priority']);

            if (empty($ou_id)) {
                $this->cache->insert($return, 'db_source_fetch_config', $db_id);
            } else {
                $this->cache->insert($return, 'db_source_fetch_config_ou', $db_id);
            }
        }
        if (empty($ou_id)) {
            return $this->cache->fetch('db_source_fetch_config', $db_id);
        } else {
            return $this->cache->fetch('db_source_fetch_config_ou', $db_id);
        }
    }

    /**
     * Returns all fields that are enabled in the selected source
     * @param integer $db_id Database ID
     * @param integer $source_id Source ID
     * @return array|bool
     */
    function db_source_fetch_fields($db_id, $source_id)
    {
        if (empty($db_id)) {
            if ($this->db_current() == false) {
                $this->alerts->add("error", 403);
                return false;
            }
            $db_id = $this->db_current()['db_id'];
        }
        if (empty($source_id)) {
            $this->alerts->add("error", 404);
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", 401);
            return false;
        }
        $source = $this->db_source_fetch_config($db_id)['id'][$source_id];
        $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_' . $this->mysql->real_escape_string($source['source_name_internal']) . '_fields` where source_field_enabled = 1';
        $query = $this->mysql->query($query);
        if ($query->num_rows == 0) {
            return false;
        }
        $return = array();
        $fields = $this->db_fields_fetch()['flat'];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $field = $fields[$row['field_id']];
            if ($field['field_type'] == 9) {
                for ($x = 1; $x <= $field['field_option_1']; $x++) {
                    $return[] = $field['field_name_internal'] . "_" . $x;
                }
            } else {
                $return[] = $field['field_name_internal'];
            }

        }
        return $return;
    }

    /**
     * Fetches data from the selected source; Optionally orders it in a multidimensional array; Optionally accepts preexisting data which will be overwritten on collision
     * @param integer $db_id Database ID
     * @param integer $source_id Source ID
     * @param null|string $key_1 (optional) column name for the first level of a multidimensional array
     * @param null|string $key_2 (optional) column name for the second level of a multidimensional array
     * @param null|array $data Preexisting data, conflicting data will be overwritten by selected source
     * @return array|mixed
     */
    function db_source_fetch_interface($db_id, $source_id, $key_1 = NULL, $key_2 = NULL, $data = NULL)
    {
        if (empty($db_id)) {
            if ($this->db_current() == false) {
                $this->alerts->add("error", 403);
                return false;
            }
            $db_id = $this->db_current()['db_id'];
        }
        if (empty($source_id)) {
            $this->alerts->add("error", 404);
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", 401);
            return false;
        }
        $source = $this->db_source_fetch_config($db_id)['id'][$source_id];
        $query = 'Select * from `db_' . $this->mysql->real_escape_string($db['db_name_internal']) . '_source_' . $this->mysql->real_escape_string($source['source_name_internal']) . '_interface`';
        $query = $this->mysql->query($query);
        if ($query->num_rows == 0) {
            return $data;
        }
        if (empty($data)) {
            $return = array();
        } else {
            $return = $data;
        }
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            if (!empty($key_1)) {
                if (!empty($key_2)) {
                    $return[$row[$key_1]][$row[$key_2]] = $row;
                } else {
                    $return[$row[$key_1]] = $row;
                }
            } else {
                $return[$row['sample_id']] = $row;
            }

        }
        return $return;
    }

    /*****************************************
     ***** Database/Source/Upload ************
     *****************************************/

    /**
     * Import helper for CSV
     * @param string $data Raw String from file
     * @param integer $db_id Database ID
     * @param array $options array ("delimiter", "enclosure", "escape", "static_data"); static_data will be prepended
     * @param null|array $allowed_fields optional: limit allowed fields; other columns will be dismissed
     * @return array|bool
     */
    function db_source_upload_csv($data, $db_id, $options, $allowed_fields = NULL)
    {
        if (!empty($options['delimiter'])) {
            $delimiter = $options['delimiter'];
        } else {
            $delimiter = NULL;
        }
        if (!empty($options['enclosure'])) {
            $enclosure = $options['enclosure'];
        } else {
            $enclosure = NULL;
        }
        if (!empty($options['escape'])) {
            $escape = $options['escape'];
        } else {
            $escape = NULL;
        }
        if (!empty($options['static_data'])) {
            $static_data = $options['static_data'];
        } else {
            $static_data = array();
        }
        if ($options['delimiter'] == 'tab') {
            $delimiter = "\t";
        }

        $lines = explode("\n", $data);
        $head = str_getcsv(array_shift($lines), $delimiter, $enclosure, $escape);
        if (!empty($allowed_fields)) {
            $check_fields = $this->db_source_upload_check_fields($db_id, $head, $allowed_fields);
        } else {
            $check_fields = $this->db_source_upload_check_fields($db_id, $head);
        }

        if (!empty($check_fields['failed'])) {
            $this->alerts->add("error", 407);
            $this->alerts->add('error', 'Invalid Fields: ' . implode(' ', $check_fields));
            return false;
        }
        $array = array();
        foreach ($lines as $line) {
            $row = array_pad(str_getcsv($line, $delimiter, $enclosure, $escape), count($head), '');
            $array[] = array_merge($static_data, array_combine($head, $row));
        }
        return array('data' => $array, 'fields' => $check_fields['passed']);

#$this->cache_insert('db_source_upload', $return);
#$return;
    }

    /**
     * Wrapper for the Source File Upload; Processed result will be stored in cache
     * @param integer $source_id
     * @param string|mixed $data_raw raw file content
     * @param string $type "xlsx" or "csv"
     * @param array $options array ("delimiter", "enclosure", "escape", "static_data"); static_data will be prepended
     * @return array|bool
     */
    function db_source_upload_init($source_id, $data_raw, $type, $options)
    {
        if (empty($source_id)) {
            $this->alerts->add("error", 404);
            return false;
        }
        $db = $this->db_current();
        if ($db === false) {
            $this->alerts->add("error", 401);
            return false;
        }
        $sources = $this->db_source_fetch_available();
        if (empty($sources['id'][$source_id])) {
            $this->alerts->add("error", 405);
            return false;
        }
        $source = $sources['id'][$source_id];
        $dbn = $db['db_name_internal'];
        $scn = $source['source_name_internal'];
        $source_default_name = 'source_' . $source['source_name_internal'];
        $source_default_table = "db_" . $dbn . "_source_" . $scn . "_interface";
#$ou_id = $this->user->user_current()['ou_id'];
        $plugin = array();
        if (!empty($source['plugin_name']) and $this->db_source_plugin_config($source['plugin_name']) !== false) {
            $plugin = $this->db_source_plugin_config($source['plugin_name']);
        }

        $upload = array();

        if ($type == "csv") {
            $csv = $this->table_parser->csv_to_array($data_raw, $options);
            $upload[0] = array(
                'data' => $csv['data'],
                'header' => $csv['header'],
                'table_id' => $options["table_id"],
                'table' => $plugin['upload'][$options["table_id"]]['destination'],
                'table_name' => $plugin['upload'][$options["table_id"]]['name']
            );
            if (empty($plugin)) {
                $upload[0] = array(
                    'data' => $csv['data'],
                    'header' => $csv['header'],
                    'table_id' => 0,
                    'table' => $source_default_table,
                    'table_name' => $source_default_table
                );
            }
            unset($csv);
        } elseif ($type == "xlsx") {
            $xlsx = $this->table_parser->xlsx_to_array($data_raw, $options);

            if (empty($plugin)) {
                if (count($xlsx) > 1) {
                    foreach ($xlsx['sheets'] as $sheet_id => $sheet) {
                        if ($sheet['table'] == $source_default_name) {
                            $sheet['table'] = $source_default_table;
                            $upload[0] = $sheet;
                        }
                    }
                } elseif (count($xlsx) == 1) {
                    $xlsx[0]['table'] = $source_default_table;
                    $upload[0] = $xlsx[0];
                }
            } else {
                if (!empty($options['continuous_read']) and $options['continuous_read'] == true) {
                    $xlsx_merge = array();
                    foreach ($xlsx as $sheet_id => $sheet) {
                        if (empty($xlsx_merge)) {
                            $xlsx_merge = $sheet['data'];
                        } else {
                            $xlsx_merge = array_merge($xlsx_merge, $sheet['data']);
                        }
                    }

                    foreach ($xlsx[0]['header'] as $key => $value) {
                        if (!in_array($value, $plugin['upload'][0]['fields'])) {
                            unset($xlsx[0]['header'][$key]);
                        }
                    }
                    foreach ($xlsx_merge as $key => $value) {
                        foreach ($value as $child_key => $value_key) {
                            if (!in_array($child_key, $plugin['upload'][0]['fields'])) {
                                unset($xlsx_merge[$key][$child_key]);
                            }
                        }
                    }
                    $upload = array(
                        0 =>
                            array(
                                'data' => $xlsx_merge,
                                'header' => $xlsx[0]['header'],
                                'table_id' => 0,
                                'table' => $plugin['upload'][0]['destination'],
                                'table_name' => $plugin['upload'][0]['name']
                            )
                    );
                    unset($xlsx_merge);
                } else {
                    if (count($xlsx) == 1 and count($plugin['upload']) == 1) {
                        $xlsx[0]['table'] = $plugin['upload'][0]['name_internal'];
                    }
                    foreach ($xlsx as $sheet_id => $sheet) {
                        if (!isset($plugin['table_name2id'][$sheet['table']])) {
                            $this->alerts->add("error", 408);
                            unset($xlsx[$sheet_id]);
                        } else {
                            foreach ($sheet['header'] as $key => $value) {
                                $sheet_id_real = $plugin['table_name2id'][$sheet['table']];
                                if (!in_array($value, $plugin['upload'][$sheet_id_real]['fields'])) {
                                    unset($xlsx[$sheet_id]['header'][$key]);
                                }
                            }
                            foreach ($sheet['data'] as $key => $value) {
                                $sheet_id_real = $plugin['table_name2id'][$sheet['table']];
                                foreach ($value as $child_key => $child_value) {
                                    if (!in_array($child_key, $plugin['upload'][$sheet_id_real]['fields'])) {
                                        unset($xlsx[$sheet_id]['data'][$key][$child_key]);
                                    }
                                }
                            }
                            $xlsx[$sheet_id]['table_id'] = $plugin['table_name2id'][$sheet['table']];
                            $xlsx[$sheet_id]['table'] = $plugin['upload'][$xlsx[$sheet_id]['table_id']]['destination'];
                            $xlsx[$sheet_id]['table_name'] = $plugin['upload'][$xlsx[$sheet_id]['table_id']]['name'];
                        }
                    }
                    $upload = $xlsx;
                }
            }
            unset($xlsx);
            if (empty($upload)) {
                $this->alerts->add("error", 409);
                return false;
            }
        }
        $return = array('data' => $upload, 'source_id' => $source_id);
        $this->cache->insert($return, 'db_source_upload');
        return $return;
    }

    /**
     * Wrapper for db_source_upload_finish_core; Requires previously stored data in cache via db_source_upload_init
     * @return bool|mixed
     */
    function db_source_upload_finish()
    {
        if (empty($this->cache->fetch('db_source_upload'))) {
            return false;
        }
        $return = $this->db_source_upload_finish_core($this->db_current()['db_id'], $this->cache->fetch('db_source_upload')['source_id'], $this->cache->fetch('db_source_upload')['data']);
        $this->cache->clear("db_source_upload");
        return $return;
    }

    /**
     * Checks if fields supplied to the upload form are actually valid
     * @param integer $db_id Database ID
     * @param array|mixed $fields_input list of field names to check
     * @param null|array $fields_db (optional) if supplied this array will be used instead of the field list from the database
     * @return array
     */
    function db_source_upload_check_fields($db_id, $fields_input, $fields_db = NULL)
    {
        if (empty($fields_db)) {
            $fields_db = $this->db_fields_fetch_core($db_id)['flat_by_name'];
        }
        $return = array();
        foreach ($fields_input as $field_input) {
            if (empty($fields_db[$field_input])) {
                $return['failed'][] = $field_input;
            } else {
                $return['passed'][$fields_db[$field_input]['field_id']] = $fields_db[$field_input];
            }
        }
        return $return;
    }

    /**
     * Inserts given data into source table; previous data will be truncated
     * @param integer $db_id Database ID
     * @param integer $source_id Source ID
     * @param array $data Data to store
     * @return bool
     */
    function db_source_upload_finish_core($db_id, $source_id, $data)
    {
        if (empty($db_id)) {
            $this->alerts->add("error", 403);
            return false;
        }
        if (empty($source_id)) {
            $this->alerts->add("error", 404);
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", 401);
            return false;
        }

        $source = $this->db_source_fetch_config($db_id)['id'][$source_id];
        if ($source == false) {
            $this->alerts->add('error', 405);
            return false;
        }
        $dbn = $db['db_name_internal'];
#$scn = $source['source_name_internal'];
#$table = "db_" . $dbn . "_source_" . $scn . "_interface";
        $return = true;
        foreach ($data as $table) {
            $query = "TRUNCATE `" . $table['table'] . "`";
            $this->mysql->query($query);
            if ($this->mysql_w->mysql_insert($table['data'], $table['table'], "multiple") === false) {
                return false;
            }
        }
        if ($return) {
            $query = 'Update db_' . $dbn . '_source_config set source_last_upload = now() where source_id = ' . $this->mysql->real_escape_string($source_id);
            $this->mysql->query($query);
        }
        return $return;

    }


    /**
     * Retrieves the plugin configuration from the json file
     * @param string $plugin_name Plugin Name
     * @return bool|mixed False if not found
     */
    function db_source_plugin_config($plugin_name)
    {
        if (!file_exists($this->plugin_dir . $plugin_name . '/plugin_config.json')) {
            return false;
        }
        $contents = file_get_contents($this->plugin_dir . $plugin_name . '/plugin_config.json');
        $contents = utf8_encode($contents);
        $contents = json_decode($contents, true);
        $contents['table_name2id'] = array_flip(array_column($contents['upload'], 'name_internal'));
        return $contents;
    }


    /**********************************
     ***** Database/Samples ***********
     **********************************/

    function db_samples_fetch()
    {

    }

    /**
     * Perform the SQL queries needed for an server-side processing requested,
     * utilising the helper functions of this class, limit(), order() and
     * filter() among others. The returned array is ready to be encoded as JSON
     * in response to an SSP request, or can be modified if needed before
     * sending back to the client.
     *Taken and modified from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * @param array $request Data sent to server by DataTables
     * @param bool $display_basket if true only samples in the current basket (of the OU) will be shown
     * @param null|integer $order_id if given only samples from given order will be shown
     * @return array          Server-side processing response array
     */
    function db_samples_fetch_simple($request, $display_basket = false, $order_id = null)
    {
        $table = $this->mysql_table_name("cache");
        $table_basket = $this->mysql_table_name("orders_basket");
        $primaryKey = $this->db_fields_fetch()['keys_single'][0];
        $columns = array();
        $counter = 0;
        $offset = 0;
        if (!empty($request['special_basket_checkbox'])) {
            unset($request['columns'][$counter]);
#unset($request['order'][0]);
            $counter++;
            $offset = 1;
        }
        if (empty($request['data_plain'])) {
            $fields = $this->db_fields_fetch(true)['flat_ordered'];
            foreach ($fields as $field) {
                $columns[$counter] = array("db" => $field['field_name_internal'], "dt" => $counter);
                $counter++;
            }

// Build the SQL query string from the request
            $limit = $this->mysql_limit($request, $columns);
            $order = $this->mysql_order($request, $columns, $table, $offset);
            $where = $this->mysql_filter($request, $columns);
        } else {
            $fields = $this->db_fields_fetch(false)['flat_ordered'];
            foreach ($fields as $field) {
                $columns[$counter] = array("db" => $field['field_name_internal'], "dt" => $counter);
                $counter++;
            }

// Build the SQL query string from the request
            $limit = "";
            $order = "";
            $where = "";
        }


        if (!$display_basket) {
            $query = "SELECT `" . implode("`, `", $this->pluck($columns, 'db')) . "`
FROM `$table`
$where
$order
$limit";
        } else {
            $on_data = array();
            foreach ($this->db_fields_fetch()['keys_single'] as $on_key) {
                $on_data[] = array('key_1' => $on_key, 'key_2' => $on_key);
            }
            $on = $this->mysql_on($on_data, $table, $table_basket);
            $appended_keys = $this->pluck($columns, 'db');
            foreach ($appended_keys as $key => $value) {
                if ($value == $this->db_fields_fetch()['keys_single'][0]) {
                    $appended_keys[$key] = '`' . $table_basket . '`.`' . $value . '`';
                } else {
                    $appended_keys[$key] = '`' . $table . '`.`' . $value . '`';
                }

            }
            if (empty($order_id)) {
                $query = "SELECT " . implode(", ", $appended_keys) . "
FROM `$table_basket` left join `$table` on $on
where `$table_basket`.`ou_id` = '" . $this->user->user_current()['ou_id'] . "' and order_id is null
$order
$limit";
            } else {
                $query = "SELECT " . implode(", ", $appended_keys) . "
FROM `$table_basket` left join `$table` on $on
where order_id = '" . $this->mysql->real_escape_string($order_id) . "'
$order
$limit";
            }
        }

        $query = $this->mysql->query($query);
        $data = $query->fetch_all(MYSQLI_ASSOC);
        if (!empty($request['data_plain'])) {
            return $data;
        }
#d($data, "data");

// Data set length after filtering
        if (empty($on) or !$display_basket) {
            $query = "SELECT COUNT(`{$primaryKey}`)FROM   `$table` $where";
        } else {
            $primaryKey = "$table_basket`.`$primaryKey";
            if (empty($order_id)) {
                $query = "SELECT COUNT(`{$primaryKey}`)
FROM `$table_basket` left join `$table` on $on
where `$table`.`ou_id` = '" . $this->user->user_current()['ou_id'] . "' and order_id is null";
            } else {
                $query = "SELECT COUNT(`{$primaryKey}`)
FROM `$table_basket` left join `$table` on $on
where order_id = '" . $this->mysql->real_escape_string($order_id) . "'";
            }
        }
        $query = $this->mysql->query($query);
        $resFilterLength = $query->fetch_all();
        $recordsFiltered = $resFilterLength[0][0];

// Total data set length
        if (empty($on) or !$display_basket) {
            $query = "SELECT COUNT(`{$primaryKey}`)
FROM   `$table`";
        } else {
            if (empty($order_id)) {
                $query = "SELECT COUNT(`{$primaryKey}`)
FROM `$table_basket` left join `$table` on $on
where `$table`.`ou_id` = '" . $this->user->user_current()['ou_id'] . "' and order_id is null
$order
$limit";
            } else {
                $query = "SELECT COUNT(`{$primaryKey}`)
FROM `$table_basket` left join `$table` on $on
where order_id = '" . $this->mysql->real_escape_string($order_id) . "'
$order
$limit";
            }
        }
        $query = $this->mysql->query($query);
        $resTotalLength = $query->fetch_all();
        $recordsTotal = $resTotalLength[0][0];

        /*
        * Output
        */
        return array(
            "draw" => isset ($request['draw']) ?
                intval($request['draw']) :
                0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->datatables_data_output($columns, $data, $request)
        );
    }


    /**
     * The difference between this method and the `simple` one, is that you can
     * apply additional `where` conditions to the SQL queries. These can be in
     * one of two forms:
     *
     * * 'Result condition' - This is applied to the result set, but not the
     *   overall paging information query - i.e. it will not effect the number
     *   of records that a user sees they can have access to. This should be
     *   used when you want apply a filtering condition that the user has sent.
     * * 'All condition' - This is applied to all queries that are made and
     *   reduces the number of records that the user can access. This should be
     *   used in conditions where you don't want the user to ever have access to
     *   particular records (for example, restricting by a login id).
     *Taken and modified from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * @param array $request Data sent to server by DataTables
     * @param string $whereResult WHERE condition to apply to the result set
     * @param string $whereAll WHERE condition to apply to all queries
     * @param null $mode NULL, "detail"
     * @return array          Server-side processing response array
     */
    function db_samples_fetch_complex($request, $whereResult = null, $whereAll = null, $mode = null)
    {
        if (!empty($mode) and $mode == 'detail') {
            $table = $this->mysql_table_name("samples");
        } else {
            $table = $this->mysql_table_name("cache");
        }

        $primaryKey = 'sample_id';
        $columns = array();
        $counter = 0;
        $offset = 0;

        if (!empty($request['special_basket_checkbox'])) {
            unset($request['columns'][$counter]);
            $counter++;
            $offset = 1;
        }
        if (empty($request['data_plain'])) {
            foreach ($this->db_fields_fetch(true)['flat_ordered'] as $field) {
                $columns[$counter] = array("db" => $field['field_name_internal'], "dt" => $counter);
                $counter++;
            }
            $localWhereResult = array();
            $localWhereAll = array();
            $whereAllSql = '';

// Build the SQL query string from the request
            $limit = $this->mysql_limit($request, $columns);
            $order = $this->mysql_order($request, $columns, null, $offset);
            $where = $this->mysql_filter($request, $columns);
        } else {
            foreach ($this->db_fields_fetch(false)['flat_ordered'] as $field) {
                $columns[$counter] = array("db" => $field['field_name_internal'], "dt" => $counter);
                $counter++;
            }
            $localWhereResult = array();
            $localWhereAll = array();
            $whereAllSql = '';

// Build the SQL query string from the request
            $limit = "";
            $order = "";
            $where = "";
        }

        $whereResult = $this->datatables_flatten($whereResult);
        $whereAll = $this->datatables_flatten($whereAll);

        if ($whereResult) {
            $where = $where ?
                $where . ' AND ' . $whereResult :
                'WHERE ' . $whereResult;
        }

        if ($whereAll) {
            $where = $where ?
                $where . ' AND ' . $whereAll :
                'WHERE ' . $whereAll;

            $whereAllSql = 'WHERE ' . $whereAll;
        }

// Main query to actually get the data
        $query = "SELECT `" . implode("`, `", $this->pluck($columns, 'db')) . "`
FROM `$table`
$where
$order
$limit";
        $query = $this->mysql->query($query);
        $data = $query->fetch_all(MYSQLI_ASSOC);
        if (!empty($request['data_plain'])) {
            return $data;
        }
// Data set length after filtering
        $query = "SELECT COUNT(`{$primaryKey}`)
FROM   `$table`
$where";
        $query = $this->mysql->query($query);
        $resFilterLength = $query->fetch_all();
        $recordsFiltered = $resFilterLength[0][0];

// Total data set length
        $query = "SELECT COUNT(`{$primaryKey}`)
FROM   `$table` " .
            $whereAllSql;
        $query = $this->mysql->query($query);
        $resTotalLength = $query->fetch_all();
        $recordsTotal = $resTotalLength[0][0];

        /*
        * Output
        */
        return array(
            "draw" => isset ($request['draw']) ?
                intval($request['draw']) :
                0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->datatables_data_output($columns, $data, $request)
        );
    }

    /**
     * Prepares where clause for search in mysql database according to the users search input; respects logical operators
     * @param array $input array(field_name_interal_operator => ">", field_name_internal => "xxx")
     * @param bool $temporary
     * @return array
     */
    function db_samples_search_prepare($input, $temporary = false)
    {
        $return = array();
        foreach ($this->db_fields_fetch()['flat'] as $field) {
            if (!empty($input[$field['field_name_internal']])) {
#2:Numerical; 9: numerical/multidimensional
                $operator = '=';
                if ($field['field_type'] == 2 or $field['field_type'] == 9) {
                    if (!empty($input[$field['field_name_internal'] . '_operator'])) {
                        if ($input[$field['field_name_internal'] . '_operator'] == '>') {
                            $operator = '>';
                        } elseif ($input[$field['field_name_internal'] . '_operator'] == '<') {
                            $operator = '<';
                        }
                    }
                }
                $search_term = $this->mysql->real_escape_string($input[$field['field_name_internal']]);
                $return[] = '`' . $field['field_name_internal'] . '` ' . $operator . " '" . $search_term . "'";
            }
        }
        if ($temporary) {
            $this->current_temporary['sample_search'] = $return;
        } else {
            $this->cache->insert($return, 'sample_search');
        }
        return $return;
    }

    /**
     * Fetches all samples from the cache table
     * @param integer $db_id Database ID
     * @return bool|mixed
     */
    function db_samples_fetch_core($db_id)
    {
        if (empty($db_id)) {
            $this->alerts->add("error", 403);
            return false;
        }
        $db = $this->db_fetch($db_id);
        if ($db === false) {
            $this->alerts->add("error", 401);
            return false;
        }
        $query = "Select * from `db_" . $db['db_name_internal'] . "_cache`";
        $query = $this->mysql->query($query);
        if ($query->num_rows > 0) {
            $return = $query->fetch_all(MYSQLI_ASSOC);
        }
        return $return;
    }

    /*****************************************
     ***** Database/Samples/Basket ***********
     *****************************************/

    /**
     * Wrapper for db_samples_basket_fetch_core; Returns all samples currently in the basket of the OU (of the logged in user)
     * @return array|bool
     */
    function db_samples_basket_fetch_current()
    {
        if (empty($this->current['db_id'])) {
            $this->alerts->add("error", 403);
            return false;
        }
        if (empty($this->cache->fetch('basket_current'))) {
            $this->cache->insert($this->db_samples_basket_fetch_core($this->current['db_id'], $this->user->user_current()['ou_id']), 'basket_current');
        }
        return $this->cache->fetch('basket_current');
    }

    /**
     * Returns all samples currently in the basket of the OU
     * @param integer $db_id Database ID
     * @param integer $ou_id OU ID
     * @return array
     */
    function db_samples_basket_fetch_core($db_id, $ou_id)
    {
        $return = array();
        $table = $this->mysql_table_name("orders_basket", $db_id);
        $query = "Select * from $table where ou_id = " . $this->mysql->real_escape_string($ou_id) . ' and order_id is null';
        $query = $this->mysql->query($query);

        $fields = $this->db_fields_fetch();
        $fields_identifier = $fields['keys_single'];

        if ($query->num_rows > 0) {
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $return[$row[$fields_identifier[0]]] = $row;
            }
        }
        return $return;
    }

    /**
     * Adds Sample to the basket of the OU (of the currently logged in user)
     * @param array $input Array with the fields necessary to identify the sample
     * @return bool|mixed
     */
    function db_samples_basket_add($input)
    {
        if (empty($this->current['db_id'])) {
            $this->alerts->add("error", 403);
            return false;
        }
        $data = array();
        $data['ou_id'] = $this->user->user_current()['ou_id'];
        $fields = $this->db_fields_fetch();
        $fields_identifier = $fields['keys_single'];
        foreach ($fields_identifier as $field) {
            if (empty($input[$field])) {
                return false;
            }
            $data[$field] = $input[$field];
        }
        $table = $this->mysql_table_name("orders_basket");
        $return = $this->mysql_w->mysql_insert($data, $table);
        $this->cache->clear("basket_current");
        return $return;
    }

    /**
     * Removes Sample to the basket of the OU (of the currently logged in user)
     * @param array $input Array with the fields necessary to identify the sample
     * @return bool
     */
    function db_samples_basket_remove($input)
    {
        if (empty($this->current['db_id'])) {
            $this->alerts->add("error", 403);
            return false;
        }
        $data = array();
        $data['ou_id'] = $this->user->user_current()['ou_id'];
        $fields = $this->db_fields_fetch();
        $fields_identifier = $fields['keys_single'];
        foreach ($fields_identifier as $field) {
            if (empty($input[$field])) {
                return false;
            }
            $data[$field] = $input[$field];
        }
        $table = $this->mysql_table_name("orders_basket");
        $query = "Delete from $table where " . $this->mysql_w->mysql_generate_where($data);
        $this->mysql->query($query);
        $this->cache->clear("basket_current");
        return true;
    }

    /*****************************************
     ***** Database/Samples/Basket ***********
     *****************************************/

    /**
     * Creates order for the OU (of the currently logged in user)
     * @param string $order_description Text describing the order and the required materials
     * @param integer $order_priority Priority of the order
     */
    function db_samples_order_add($order_description, $order_priority)
    {
        $table_basket = $this->mysql_table_name("orders_basket");
        $table_orders = $this->mysql_table_name("orders");
        $data['order_description'] = $order_description;
        $data['order_priority'] = $order_priority;
        $data['user_id'] = $this->user->user_current()['user_id'];
        $data['ou_id'] = $this->user->user_current()['ou_id'];
        $id = $this->mysql_w->mysql_insert($data, $table_orders);
        $query = "Update `$table_basket` set order_id = $id where order_id is null and ou_id = " . $this->user->user_current()['ou_id'];
        $this->mysql->query($query);
    }

    /**
     * Displays all orders for the current database of the user
     * @return array
     */
    function db_samples_order_fetch()
    {
        $table = $this->mysql_table_name("orders");
        $query = "Select * from `$table`";
        $query = $this->mysql->query($query);
        $return = array();
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $return[$row['order_id']] = $row;
            }
        }
        return $return;
    }


    /*******************************
     ************ Datatables ************
     *******************************/


    /**
     * Pull a particular property from each assoc. array in a numeric array,
     * returning and array of the property values from each item.
     *Taken from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * @param array $a Array to get data from
     * @param string $prop Property to read
     * @return array        Array of property values
     */
    function pluck($a, $prop)
    {
        $out = array();

        /*for ($i = min(array_keys($a)), $len = count($a); $i <= $len; $i++) {
        $out[] = $a[$i][$prop];
        }*/

        foreach ($a as $entry) {
            $out[] = $entry[$prop];
        }

        return $out;
    }


    /**
     * Create the data output array for the DataTables rows
     * Taken from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * @param array $columns Column information array
     * @param array $data Data from the SQL get
     * @param array $request Request data from the user
     * @return array Formatted data in a row based format
     */
    function datatables_data_output($columns, $data, $request)
    {
        $out = array();

        $offset = 0;
        if (!empty($request['special_basket_checkbox'])) {
            $offset++;
        }
        $fields = $this->db_fields_fetch();
        $fields_identifier = $fields['keys'];
        $keys_search = $this->pluck($fields['field_type'][7], 'field_name_internal');
        $keys_detail = $this->pluck($fields['field_type'][6], 'field_name_internal');

        for ($i = 0, $ien = count($data); $i < $ien; $i++) {
            $row = array();
            if (!empty($request['special_basket_checkbox'])) {
                $row[0] = "<div class='basket_button_wrapper' id='basket_button_wrapper_" . $i . "'";
                $row[0] .= " data-button_id = '" . $i . "'";
                foreach ($fields_identifier as $field) {
                    $row[0] .= " data-" . $field . " = " . json_encode($data[$i][$field]);
                }
                $row[0] .= ' ><button class="btn btn-primary">[?]</div > ';
            }
            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $k = $j + $offset;
                $column = $columns[$k];
                if (in_array($column['db'], $keys_search)) {
                    $row[$column['dt']] = '<a href="/app/sample/search/' . $column['db'] . '/' . urlencode($data[$i][$column['db']]) . '">' . $data[$i][$column['db']] . '</a>';
                } elseif (in_array($column['db'], $keys_detail)) {
                    $row[$column['dt']] = '<a href="/app/sample/detail/' . $column['db'] . '/' . urlencode($data[$i][$column['db']]) . '">' . $data[$i][$column['db']] . '</a>';
                } else {
                    // Is there a formatter?
                    if (isset($column['formatter'])) {
                        $row[$column['dt']] = $column['formatter']($data[$i][$column['db']], $data[$i]);
                    } else {
                        $row[$column['dt']] = $data[$i][$column['db']];
                    }
                }
            }

            $out[] = $row;
        }

        return $out;
    }


    /**
     * Return a string from an array or a string
     *Taken from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * @param array|string $a Array to join
     * @param string $join Glue for the concatenation
     * @return string Joined string
     */
    function datatables_flatten($a, $join = ' AND ')
    {
        if (!$a) {
            return '';
        } else if ($a && is_array($a)) {
            return implode($join, $a);
        }
        return $a;
    }

    /*******************************
     ************ MySQL ************
     *******************************/

    function mysql()
    {
        return $this->mysql;
    }

    function mysql_w()
    {
        return $this->mysql_w;
    }

    /**
     * Resolves a mysql table name
     * @param string $name shorthand name of the table eg. "cache", "orders_basket", "orders", "samples"
     * @param null|integer $db_id Database ID
     * @return bool|string
     */
    function mysql_table_name($name, $db_id = NULL, $source_id = NULL)
    {

        if (empty($db_id)) {
            $db = $this->db_current();
        } else {
            $db = $this->db_fetch($db_id);
        }
        if (!empty($source_id)) {
            $source = $this->db_source_fetch_all($db_id)['id'][$source_id];
            if ($source == false) {
                return false;
            }
        } else {
            $source = false;
        }
        if ($name == 'cache' and $db !== false) {
            return 'db_' . $db['db_name_internal'] . '_cache';
        } elseif ($name == 'orders_basket' and $db !== false) {
            return 'db_' . $db['db_name_internal'] . '_orders_basket';
        } elseif ($name == 'orders' and $db !== false) {
            return 'db_' . $db['db_name_internal'] . '_orders';
        } elseif ($name == 'samples' and $db !== false) {
            return 'db_' . $db['db_name_internal'] . '_samples';
        } elseif ($name == 'source_config' and $db !== false) {
            return 'db_' . $db['db_name_internal'] . '_source_config';
        } elseif ($name == 'source_interface' and $db !== false and $source !== false) {
            return 'db_' . $db['db_name_internal'] . '_source_' . $source['source_name_internal'] . '_interface';
        }
        return false;
    }

    /**
     * Paging
     *
     * Construct the LIMIT clause for server-side processing SQL query
     *Taken from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * @param array $request Data sent to server by DataTables
     * @param array $columns Column information array
     * @return string SQL limit clause
     */
    function mysql_limit($request, $columns)
    {
        $limit = '';
        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }
        return $limit;
    }

    /**
     * Ordering
     *
     * Construct the ORDER BY clause for server-side processing SQL query
     *Taken from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * @param array $request Data sent to server by DataTables
     * @param array $columns Column information array
     * @param null|string $table table name
     * @param int $offset offset if array does not start at 0 (eg. because of checkboxes in front)
     * @return string SQL order by clause
     */
    function mysql_order($request, $columns, $table = null, $offset = 0)
    {
        $order = '';

        if (isset($request['order']) && count($request['order'])) {
            $orderBy = array();
            $dtColumns = $this->pluck($columns, 'dt');

            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];

                $columnIdx = array_search($requestColumn['data'], $dtColumns) + $offset;
                $column = $columns[$columnIdx];

                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                        'ASC' :
                        'DESC';
                    if (!empty($table)) {
                        $orderBy[] = '`' . $table . '`.`' . $column['db'] . '` ' . $dir;
                    } else {
                        $orderBy[] = '`' . $column['db'] . '` ' . $dir;
                    }
                }
            }

            if (count($orderBy)) {
                $order = 'ORDER BY ' . implode(', ', $orderBy);
            }
        }

        return $order;
    }

    /**
     * Generates 'on' clause for a mysql query
     * @param array $data Multidimensional Array ("key_1", "key_2") of keys which should be used and linked via "and" gate
     * @param string $table_1 name of the first table (associated with "key_1")
     * @param string $table_2 name of the second table (associated with "key_2")
     * @return string generated 'on' clause
     */
    function mysql_on($data, $table_1, $table_2)
    {
        $return = '';
        foreach ($data as $key_pair) {
            if (!empty($return)) {
                $return .= ' and';
            }
            $return .= ' `' . $this->mysql->real_escape_string($table_1) . '`.`' . $this->mysql->real_escape_string($key_pair['key_1']) . '`';
            $return .= ' = `' . $this->mysql->real_escape_string($table_2) . '`.`' . $this->mysql->real_escape_string($key_pair['key_2']) . '`';
        }
        return $return;
    }


    /**
     * Searching / Filtering
     *Taken from ssp.php from DATATABLES. MIT License see: https://datatables.net/license/mit
     * Construct the WHERE clause for server-side processing SQL query.
     *
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here performance on large
     * databases would be very poor
     *
     * @param array $request Data sent to server by DataTables
     * @param array $columns Column information array
     * sql_exec() function
     * @return string SQL where clause
     */
    function mysql_filter($request, $columns)
    {
        $globalSearch = array();
        $columnSearch = array();
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['search']) && $request['search']['value'] != '') {
            $str = $request['search']['value'];
            #for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
            foreach ($request['columns'] as $value) {
                $requestColumn = $value;
                $columnIdx = $requestColumn['data'];
                $column = $columns[$columnIdx];

                if ($requestColumn['searchable'] == 'true') {
                    $escaped = "'%" . $this->mysql->real_escape_string($str) . "%'";
                    $globalSearch[] = "`" . $column['db'] . "` LIKE " . $escaped;
                }
            }
        }

        // Individual column filtering
        if (isset($request['columns'])) {
            #for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
            foreach ($request['columns'] as $value) {
                $requestColumn = $value;
                $columnIdx = $requestColumn['data'];
                $column = $columns[$columnIdx];

                $str = $requestColumn['search']['value'];

                if ($requestColumn['searchable'] == 'true' &&
                    $str != '') {
                    $escaped = "'%" . $this->mysql->real_escape_string($str) . "%'";
                    $columnSearch[] = "`" . $column['db'] . "` LIKE " . $escaped;
                }
            }
        }

        // Combine the filters into a single string
        $where = '';

        if (count($globalSearch)) {
            $where = '(' . implode(' OR ', $globalSearch) . ')';
        }

        if (count($columnSearch)) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where . ' AND ' . implode(' AND ', $columnSearch);
        }

        if ($where !== '') {
            $where = 'WHERE ' . $where;
        }
        return $where;
    }
}
