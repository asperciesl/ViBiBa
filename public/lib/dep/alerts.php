<?php


class alerts
{
    /**
     * @var array
     */
    protected $alerts;

    /**
     * @param $type string
     * @param $data mixed
     */
    function add($type, $data){
        $this->alerts[$type][] = $data;
    }

    /**
     * @param $type
     * @return array
     */
    function fetch($type){
        if(!empty($this->alerts[$type])){
            return $this->alerts[$type];
        }
        return array();
    }
}