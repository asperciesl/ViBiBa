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

        $date_parsed = date_parse_from_format("d.m.Y", $x);
        if ($this->validateDate($date_parsed['year'] . "-" . $date_parsed['month'] . "-" . $date_parsed['day'], 'Y-m-d') != false and $date_parsed['year'] > 1900) {
            $x = $date_parsed['year'] . "-" . $date_parsed['month'] . "-" . $date_parsed['day'];
        } else {
            $date_parsed = date_parse_from_format("Y-m-d H:i:s", $x);
            if ($this->validateDate($date_parsed['year'] . "-" . $date_parsed['month'] . "-" . $date_parsed['day'], 'Y-m-d') != false and $date_parsed['year'] > 1900) {
                $x = $date_parsed['year'] . "-" . $date_parsed['month'] . "-" . $date_parsed['day'];
            } else {
                $x = NULL;
            }
        }
        return $x;
    }

    function adjust_trial_arm($kit_id_raw, $kit_id_parsed)
    {
        if (strpos($kit_id_raw, "DS") !== false) {
            return "DS";
        } elseif (strpos($kit_id_raw, "DIII") !== false) {
            if (intval($kit_id_parsed) < 5000) {
                return "DS";
            }
            return "DIII";
        } elseif (strpos($kit_id_raw, "DIVb") !== false) {
            return "DIVb";
        } elseif (strpos($kit_id_raw, "DIV") !== false) {
            return "DIV";
        } elseif (strpos($kit_id_raw, "DV") !== false) {
            return "DV";
        }
        return NULL;
    }

    function plugin_run($db_id, $source_id, $args)
    {
        $data = array();
        $table_overview = $this->mysql->real_escape_string($args['upload'][0]['destination']);
        $table_molecular = $this->mysql->real_escape_string($args['upload'][1]['destination']);
        $table_mapping = $this->mysql->real_escape_string($args['mapping_table']);
        $query = "Select * from " . $table_overview;
        $query = $this->mysql->query($query);
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            if (is_numeric($row['kit_id'])) {
                continue;
            }
            if (!is_numeric($row['pat_id'])) {
                if (!is_numeric(explode('/', $row['pat_id'])[1])) {
                    continue;
                }
                $row['pat_id'] = explode('/', $row['pat_id'])[1];
            }
            $kit = array();
            #Separates kit ID from string
            preg_match('/\d+/', $row['kit_id'], $kit);
            if (empty($kit[0])) {
                continue;
            }
            $row['kit_id_real'] = $kit[0];
            $row['project'] = $this->adjust_trial_arm($row['kit_id'], $row['kit_id_real']);
            if (empty($row['project'])) {
                continue;
            }
            $row['kit_id_real'] = $row['project'] . '_' . $row['kit_id_real'];
            $row['date_cellsearch'] = $this->parse_date_safely($row['date_cellsearch']);
            $row['DEPArray_Pick_Date'] = $this->parse_date_safely($row['DEPArray_Pick_Date']);

            $data[$row['lab_id']] = $row;

        }
        #Adds up the GII Scores that are listed as one cell per row
        $query = "Select * from " . $table_molecular;
        $query = $this->mysql->query($query);
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            if (!empty($data[$row['lab_id']])) {
                #Checks if tumor cell (TZ)
                if (empty($row['gii'])) {
                    $row['gii'] = 0;
                }
                $key = NULL;
                if (strpos($row['cell_id'], "TZ") !== false) {
                    $key = "gii_wga_1_" . $row['gii'];
                } #Checks if leukocyte (NZ)
                elseif (strpos($row['cell_id'], "NZ") !== false) {
                    $key = "gii_wga_leucocytes_" . $row['gii'];
                }
                if (!empty($key)) {
                    if (empty($data[$row['lab_id']][$key])) {
                        $data[$row['lab_id']][$key] = 1;
                    } else {
                        $data[$row['lab_id']][$key]++;
                    }
                }
            }
        }
        $query = "SELECT * FROM `" . $table_mapping . "` where internal_field_mysql is not null";
        $query = $this->mysql->query($query);
        $mapping = array();
        $mapping_inv = array();
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $mapping[$row['external_field_mysql']] = $row;
            $mapping_inv[$row['internal_field_mysql']] = $row;
        }

        foreach ($data as $row) {
            foreach ($mapping as $key => $value) {
                $row_mapped[$value['internal_field_mysql']] = $row[$value['external_field_mysql']] ?? null;
            }
            #Always assigns ou_id = 2 (table lacks that information but all samples are from this specific ou)
            $row_mapped['ou_id'] = 2;
            if (!empty($row_mapped['kit_id']) and !empty($row_mapped['project_id'])) {
                $data_all[] = $row_mapped;
            } else {
                #Row Failed
            }
        }
        if (empty($data_all)) {
            return false;
        }
        $query = 'TRUNCATE `' . $this->vibiba->mysql_table_name('source_interface', $db_id, $source_id) . '`';
        $this->mysql->query($query);
        if ($this->mysql_w->mysql_insert($data_all, $this->vibiba->mysql_table_name('source_interface', $db_id, $source_id), 'multiple')) {
            $query = 'Update ' . $this->vibiba->mysql_table_name('source_config', $db_id) . ' set source_last_run = now() where source_id = ' . $source_id;
            $this->mysql->query($query);
            return true;
        } else {
            return false;
        }
    }
}