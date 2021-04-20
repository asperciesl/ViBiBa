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

    function plugin_run($db_id, $source_id, $args)
    {
        $data = array();
        $table_data = $this->mysql->real_escape_string($args['upload'][0]['destination']);
        $table_mapping = $this->mysql->real_escape_string($args['mapping_table']);
        $table_interface = $this->vibiba->mysql_table_name('source_interface', $db_id, $source_id);

        $query = $this->mysql->query("Select * from " . $table_data);
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            if (!is_numeric($row['SampleID'])) {
                continue;
            }
            $row['Studie'] = $this->adjust_trial_arm($row['Studie'], $row['SampleID']);
            #Detect5 uses a 6 number code while the rest uses 4 number codes
            if ($row['Studie'] == "DV") {
                $row['SampleID'] = $row['Studie'] . "_" . sprintf("%06d", $row['SampleID']);
            } else {
                $row['SampleID'] = $row['Studie'] . "_" . sprintf("%04d", $row['SampleID']);
            }

            $date_Datum = date_parse_from_format("d.m.Y", $row['Datum']);
            $row['Datum'] = $date_Datum['year'] . "-" . $date_Datum['month'] . "-" . $date_Datum['day'];
            $date_entnommen_am = date_parse_from_format("d.m.Y", $row['entnommen_am']);
            $row['Datum'] = $date_entnommen_am['year'] . "-" . $date_entnommen_am['month'] . "-" . $date_entnommen_am['day'];

            $row['ungef_Vol'] = str_replace(',', '.', $row['ungef_Vol']);
            preg_match_all('!\d+(?:\.\d+)?!', $row['ungef_Vol'], $matches);
            if (!empty(array_map('floatval', $matches[0])[0])) {
                $row['ungef_Vol'] = array_map('floatval', $matches[0])[0];
            } else {
                $row['ungef_Vol'] = NULL;
            }

            unset($date_Datum, $date_entnommen_am, $matches);
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
            if (!empty($row_mapped['kit_id']) and !empty($row_mapped['project_id'])) {
                $data_all[] = $row_mapped;
            } else {
                #Failed Row
            }
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