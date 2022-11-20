<?php

namespace Sakura\API;

class Cache
{
    public static function update_database() {
        global $wpdb;
        $sakura_table_name = $wpdb->base_prefix . 'sakura';
        $img_domain = akina_option('cover_cdn') ? akina_option('cover_cdn') : get_template_directory();
        $manifest = file_get_contents($img_domain . "/manifest/manifest.json");
        if ($manifest) {
            $manifest = array(
                "mate_key" => "manifest_json",
                "mate_value" => $manifest
            );
            $time = array(
                "mate_key" => "json_time",
                "mate_value" => date("Y-m-d H:i:s", time())
            );

            $wpdb->query("DELETE FROM  $sakura_table_name WHERE `mate_key` ='manifest_json'");
            $wpdb->query("DELETE FROM  $sakura_table_name WHERE `mate_key` ='json_time'");
            $wpdb->insert($sakura_table_name, $manifest);
            $wpdb->insert($sakura_table_name, $time);
            $output = "manifest.json has been stored into database.";
        } else {
            $output = "manifest.json not found, please ensure your url ($img_domain) is corrent.";
        }
        return $output;
    }
}