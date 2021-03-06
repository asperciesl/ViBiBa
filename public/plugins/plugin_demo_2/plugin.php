<?php

class vibiba_plugin extends vibiba_plugin_proto
{

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function parse_date_safely($x)
    {
        if (empty($x)) {
            return NULL;
        }

        $date = date_parse_from_format("Y-n-d H:i:s", $x);
        if (
            ($this->validateDate($date['year'] . "-" . $date['month'] . "-" . $date['day'], 'Y-m-d') != false
                or
                $this->validateDate($date['year'] . "-" . $date['month'] . "-" . $date['day'], 'Y-n-j') != false)
            and $date['year'] > 1900
        ) {
            return $date['year'] . "-" . $date['month'] . "-" . $date['day'];
        } else {
            $date = date_parse_from_format("d.m.Y", $x);
            if (
                ($this->validateDate($date['year'] . "-" . $date['month'] . "-" . $date['day'], 'Y-m-d') != false
                    or
                    $this->validateDate($date['year'] . "-" . $date['month'] . "-" . $date['day'], 'Y-n-j') != false)
                and $date['year'] > 1900) {
                return $date['year'] . "-" . $date['month'] . "-" . $date['day'];
            }
        }

        return null;
    }

    function search_integer($x)
    {
        if (empty($x)) {
            return null;
        }
        preg_match('/\d+/', $x . " 0", $matches);
        if (!empty($matches) and $matches[0] != 0) {
            return $matches[0];
        }
        return null;
    }

    function adjust_trial_arm($kit_id_raw, $kit_id_parsed)
    {
        if (strpos($kit_id_raw, "DS") !== false or strpos($kit_id_raw, "DetectS") !== false) {
            return "DS";
        } elseif (strpos($kit_id_raw, "DIII") !== false or strpos($kit_id_raw, "Detect3") !== false) {
            if (intval($kit_id_parsed) < 5000) {
                return "DS";
            }
            return "DIII";
        } elseif (strpos($kit_id_raw, "DIVb") !== false or strpos($kit_id_raw, "Detect4b") !== false) {
            return "DIVb";
        } elseif (strpos($kit_id_raw, "DIV") !== false or strpos($kit_id_raw, "Detect4") !== false or strpos($kit_id_raw, "Detect4a") !== false) {
            return "DIV";
        } elseif (strpos($kit_id_raw, "DV") !== false or strpos($kit_id_raw, "Detect5") !== false) {
            return "DV";
        }
        return NULL;
    }

    function extract_kit_id($str, $tags){
        foreach($tags as $needle => $tag){
            $matches = array();
            preg_match('/'.$needle.'/i', $str, $matches);
            if(!empty($matches)){
                $str = preg_replace('/'.$needle.'/i', '', $str);
                preg_match('/[0-9]+/i', $str, $matches);
                return array($matches[0], $tag);
            }
        }
        return NULL;
    }

    function plugin_run($db_id, $source_id, $args)
    {
        $data = array();
        $table_data = $this->mysql->real_escape_string($args['upload'][0]['destination']);
        $table_mapping = $this->mysql->real_escape_string($args['mapping_table']);
        $table_interface = $this->vibiba->mysql_table_name('source_interface', $db_id, $source_id);
        $project_tags['DIII'] = 'DIII';
        $project_tags['DIVa'] = 'DIV';
        $project_tags['DIVb'] = 'DIVb';
        $project_tags['DIV'] = 'DIV';
        $project_tags['DV'] = 'DV';
        $project_tags['DS'] = 'DS';
        $project_tags['3D'] = 'DIII';
        $project_tags['4Da'] = 'DIV';
        $project_tags['4Db'] = 'DIVb';
        $project_tags['4D'] = 'DIV';
        $project_tags['5D'] = 'DV';
        $query = $this->mysql->query("Select * from " . $table_data);
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            #$row['kit_id'] = preg_split("/(,?\s+)|((?<=[a-z])(?=\d))|((?<=\d)(?=[a-z]))/i", $row['Pat-ID']);
            $kit_id = $this->extract_kit_id($row['Pat-ID'], $project_tags);

            if(empty($kit_id)){
                continue;
            }
            $row['kit_id'] = $kit_id[0];

            $row['Project'] = $this->adjust_trial_arm($row['Project'], $row['kit_id']);
            if (empty($row['Project'])) {
                $row['Project'] = $this->adjust_trial_arm($kit_id[1], $row['kit_id']);
                continue;
            }
            if ($row['Project'] == "DV") {
                $row['kit_id'] = $row['Project'] . "_" . sprintf("%06d", $row['kit_id']);
            } else {
                $row['kit_id'] = $row['Project'] . "_" . sprintf("%04d", $row['kit_id']);
            }
            $row['Isolated_Cell_Count'] = $this->search_integer($row['Isolated_Cell_Count']);
            $row['Pat-ID'] = Null;
            $row['how_many_time'] = $this->search_integer($row['how_many_time']);
            $row['Cluster'] = $this->search_integer($row['Cluster']);
            $row['WBC'] = $this->search_integer($row['WBC']);

            $row['Date_of_Isolation'] = explode(';', $row['Date_of_Isolation'])[0];
            $row['Date_of_Isolation'] = $this->parse_date_safely($row['Date_of_Isolation']);
            $row['single_cells_isolated_cellcelector'] = 1;
            $data[] = $row;
        }

        $query = $this->mysql->query("SELECT * FROM `" . $table_mapping . "` where internal_field_mysql is not null");
        $mapping = array();
        $mapping_inv = array();
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $mapping[$row['external_field_mysql']] = $row;
            $mapping_inv[$row['internal_field_mysql']] = $row;
        }

        foreach ($data as $row) {
            foreach ($mapping as $key => $value) {
                $row_mapped[$value['internal_field_mysql']] = $row[$value['external_field_mysql']];
            }
            $row_mapped['ou_id'] = 1;
            $data_all[] = $row_mapped;
        }
        $query = 'TRUNCATE `' . $table_interface . '`';

        $this->mysql->query($query);
        if ($this->mysql_w->mysql_insert($data_all, $table_interface, 'multiple')) {
            $query = 'Update ' . $this->vibiba->mysql_table_name('source_config', $db_id) . ' set source_last_run = now() where source_id = ' . $source_id;
            $this->mysql->query($query);
            return true;
        } else {
            return false;
        }
    }
}