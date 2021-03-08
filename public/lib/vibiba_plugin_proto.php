<?php


class vibiba_plugin_proto
{

    /**
     * @var vibiba stores the main ViBiBa Class Handler
     */
    protected $vibiba;

    /**
     * @var mysqli Stores the PDO Mysql Handler
     */
    protected $mysql;

    /**
     * @var mysqli_wrapper Stores the Mysql Wrapper class
     */
    protected $mysql_w;


    /**
     * vibiba_plugin constructor.
     * @param vibiba $vibiba ViBiBa Class Handler
     */
    function __construct($vibiba)
    {
        $this->vibiba = $vibiba;
        $this->mysql = $vibiba->mysql();
        $this->mysql_w = $vibiba->mysql_w();
    }

    /**
     * Prototype Function, to be replaced in the child class
     * @param int $db_id database id
     * @param int $source_id source id
     * @param array $args args
     * @return bool
     */
    function plugin_run($db_id, $source_id, $args){
        return false;
    }
}