<?php

class mysqli_wrapper
{
    /**
     * @var mysqli Stores the PDO MySQL Handler
     */
    protected $mysql;

    function __construct($config)
    {
        $this->mysql = new mysqli($config['host'], $config['user'], $config['password'], $config['db']);
        $this->mysql->query("SET NAMES 'utf8'");
    }


    /** Expososes the PDO MySQL Handler to the public
     * @return mysqli
     */
    public function mysql()
    {
        return $this->mysql;
    }

    /**
     * Returns the lowest numeric id in a mysql table
     * @param string $table Name of the Mysql Table
     * @param string $key Column to search in
     * @param null|string $where_key
     * @param null|string $where_value
     * @return int
     */
    public function mysql_lowest_id($table, $key, $where_key = NULL, $where_value = NULL)
    {
        if (empty($where_key) or empty($where_value)) {
            $query = $this->mysql->query("Select `$key` from $table");
        } else {
            $query = $this->mysql->query("Select `$key` from $table where `" . $this->mysql->real_escape_string($where_key) . "` = '" . $this->mysql->real_escape_string($where_value) . "'");
        }
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                $keys[] = $row[$key];
            }
            if (empty($keys)) {
                return 1;
            } else {
                $min = min($keys);
                $max = max($keys);
                $missing = array_diff(range($min, $max), $keys);
                if ($min > 1) {
                    return 1;
                } else if (empty($missing)) {
                    return $max + 1;
                } else {
                    return min($missing);
                }
            }
        } else {
            return 1;
        }
    }

    /**
     * Wrapper for mysql_insert_statement_multiple. If more than 10 datasets are passed, the dataset is split up in pairs of 10
     * @param array $data Data to insert
     * @param string $table Name of the mysql table
     * @param string $mode "single" or "multiple"; default "single"
     * @return bool|mixed
     */
    public function mysql_insert($data, $table, $mode = 'single')
    {
        if ($mode != "single") {
            if (count($data) > 10) {
                $chunks = array_chunk($data, 10, true);
                foreach ($chunks as $chunk) {
                    $this->mysql_insert($chunk, $table, $mode);
                }
                return true;
            }
        }
        $query = $this->mysql_insert_statement_multiple($data, $table, $mode);
        if ($this->mysql->query($query)) {
            if ($this->mysql->insert_id != false) {
                return $this->mysql->insert_id;
            } else {
                return true;
            }
        } else {
            trigger_error($this->mysql->error, E_USER_WARNING);
            return false;
        }
    }

    /**
     * Helper to insert single or multiple datasets into a mysql table
     * @param array $data Dataset to insert
     * @param string $table Name of the mysql table
     * @param string $mode "single" or "multiple"; default "single"
     * @return string
     */
    function mysql_insert_statement_multiple($data, $table, $mode = 'single')
    {
        $keys = "";
        $values = array();
        if ($mode == 'single') {
            $temp = $data;
            unset($data);
            $data[0] = $temp;
        }
        $cols = array();
        foreach ($data as $row) {
            $cols = array_unique(array_merge($cols, array_keys($row)));
        }
        foreach ($cols as $value) {
            if (!empty($keys)) {
                $keys .= ', ';
            }
            $keys .= "`" . $this->mysql->real_escape_string($value) . "`";
        }
        foreach ($data as $row_id => $row_value) {
            $values[$row_id] = "";
            foreach ($cols as $col) {
                if (!empty($values[$row_id])) {
                    $values[$row_id] .= ", ";
                }
                if (!isset($row_value[$col]) or $row_value[$col] === 'NULL' or $row_value[$col] === '' or trim($row_value[$col]) ==='') {
                    $values[$row_id] .= "NULL";
                } else {
                    if (is_bool($row_value[$col])) {
                        if ($row_value[$col] == true) {
                            $row_value[$col] = 1;
                        } else {
                            $row_value[$col] = 0;
                        }
                    }
                    $values[$row_id] .= "'" . $this->mysql->real_escape_string($row_value[$col]) . "'";
                }

            }
            $values[$row_id] = '(' . $values[$row_id] . ')';
        }
        $query = "Insert into `" . $this->mysql->real_escape_string($table) . "` ($keys) VALUES " . implode(',', $values);
        return $query;
    }

    /**
     * Wrapper for mysql_update_statement
     * @param array $data
     * @param string $table
     * @param array $where_keys
     * @return bool
     */
    public function mysql_update($data, $table, $where_keys)
    {
        $query = $this->mysql_update_statement($data, $table, $where_keys);
        if ($this->mysql->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Generates a mysql query to update a table
     * @param array $data Key => Value pairs of data to set the entries to.
     * @param string $table Name of the mysql table
     * @param array $where_keys List of keys for the where clause, will be linked with "AND" gate; data has to be provided in $data
     * @return string
     */
    function mysql_update_statement($data, $table, $where_keys)
    {
        $set = "";
        $where = "";
        $first = true;
        $first_where = true;
        foreach ($data as $key => $value) {
            if ($key == in_array($key, $where_keys)) {
                if (!$first_where) {
                    $where .= " and ";
                } else {
                    $first_where = false;
                }
                $where .= "`" . $this->mysql->real_escape_string($key) . "` = '" . $this->mysql->real_escape_string($value) . "'";

            } else {
                if (!$first) {
                    $set .= ", ";
                } else {
                    $first = false;
                }
                $set .= "`" . $this->mysql->real_escape_string($key) . "` = '" . $this->mysql->real_escape_string($value) . "'";
            }
        }
        $query = "Update `" . $this->mysql->real_escape_string($table) . "` set $set where $where";
        return $query;
    }

    /**
     * Generates where clause for a mysql query
     * @param array $data Key => Value pairs for the "where" expression; will be linked with "AND" gate
     * @return string where clause for a mysql query
     */
    function mysql_generate_where($data)
    {
        $where = '';
        $first_where = true;
        foreach ($data as $key => $value) {
            if (!$first_where) {
                $where .= " and ";
            } else {
                $first_where = false;
            }
            $where .= "`" . $this->mysql->real_escape_string($key) . "` = '" . $this->mysql->real_escape_string($value) . "'";
        }
        return $where;
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
}