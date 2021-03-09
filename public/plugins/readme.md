# ViBiBa Plugin
To create a ViBiBa plugin simply create a new subfolder in /public/plugins/ with two files: 'plugin_config.json' and 'plugin.php'.
For more information please take a look at the demos.
## Example: plugin_config.json
````
{
  "name": "Plugin Name",
  "description": "Plugin Description",
  "upload": [
    {
      "name": "Name of Table 1",
      "name_internal": "Name of the Excel Worksheet",
      "description": "Description of the Excel Worksheet",
      "destination": "MySQL table for uploaded content e.g. z_plugin_d1_data",
      "fields": [
        "Array",
        "of",
        "possible",
        "field",
        "names",
      ]
    }
  ],
  "mapping_table" : "MySQL table containing field mapping e.g. z_plugin_d1_mapping",
  "disable_upload" : false
}
````

## Example: plugin.php

``````
class vibiba_plugin extends vibiba_plugin_proto
{
    function plugin_run($db_id, $source_id, $args)
    {
        $table_0 = $this->mysql->real_escape_string($args['upload'][0]['destination']);
        $table_1 = $this->mysql->real_escape_string($args['upload'][1]['destination']);
        $table_mapping = $this->mysql->real_escape_string($args['mapping_table']);
        $table_interface = $this->vibiba->mysql_table_name('source_interface', $db_id, $source_id);
        
        ... Do Something ...
        ... Insert Data into $table_interface ...
        return true;
    }
}
``````