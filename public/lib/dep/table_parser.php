<?php


class table_parser
{
    /**
     * Stores the SimpleXLSX Handler; see https://github.com/shuchkin/simplexlsx
     * @var SimpleXLSX the handler to the SIMPLEXLXS Extension
     */
    protected $xlsx_parser;

    /**
     * Initiazes SimpleXLSX; see https://github.com/shuchkin/simplexlsx
     * @return SimpleXLSX
     */
    function xlsx_parser()
    {
        if (empty($this->xlsx_parser)) {
            $this->xlsx_parser = new SimpleXLSX();
        }
        return $this->xlsx_parser;
    }

    /**
     * Parses xlsx file and returns array
     * https://github.com/shuchkin/simplexlsx
     * @param mixed $data_raw Input file stream of the xlsx file
     * @param array $options Array with option flags; "skip_lines" => skip the first n lines, "static_data" => prepends the given array
     * @return array Entry for each sheet with subsequent array containing "data", "header", and "table"
     */
    function xlsx_to_array($data_raw, $options = array())
    {
        if (!empty($options['static_data'])) {
            $static_data = $options['static_data'];
        } else {
            $static_data = array();
        }

        if (!empty($options['skip_lines']) and $options['skip_lines'] > 0 and is_numeric($options['skip_lines'])) {
            $skip_n = $options['skip_lines'];
        } else {
            $skip_n = 0;
        }

        $xlsx = $this->xlsx_parser()->parseData($data_raw);
        $return = array();
        #$return['sheets'] = $xlsx->sheetNames();
        foreach ($xlsx->sheetNames() as $sheet_id => $sheet_name) {
            $header_values = $rows = array();
            foreach ($xlsx->rows($sheet_id) as $k => $r) {
                if ($k < $skip_n) {
                    continue;
                }
                if ($k === (0 + $skip_n)) {
                    $header_values = $r;
                    continue;
                }
                $rows[] = array_merge($static_data, array_combine($header_values, $r));
            }
            $return[$sheet_id]['data'] = $rows;
            $return[$sheet_id]['header'] = $header_values;
            $return[$sheet_id]['table'] = $sheet_name;
        }
        return $return;
    }

    /**
     * Parses csv file and returns array
     * @param string $data_raw raw file content
     * @param array $options option flags; "delimiter", "enclosure", "escape", "static_data"
     * @return array
     */
    function csv_to_array($data_raw, $options = array())
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

        $lines = explode("\n", $data_raw);

        if (!empty($options['skip_lines']) and $options['skip_lines'] > 0 and is_numeric($options['skip_lines'])) {
            for ($n = 0; $n < $options['skip_lines']; $n++) {
                array_shift($lines);
            }
        }

        $head = str_getcsv(array_shift($lines), $delimiter, $enclosure, $escape);
        $return = array();
        foreach ($lines as $line) {
            $row = array_pad(str_getcsv($line, $delimiter, $enclosure, $escape), count($head), '');
            $return[] = array_merge($static_data, array_combine($head, $row));
        }
        return array('data' => $return, 'header' => $head);
    }
}