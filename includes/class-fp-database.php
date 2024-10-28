<?php

// Criação da tabela no banco de dados
class FP_Database {
    public static function create_favoritos_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'favoritos_posts';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) NOT NULL,
            post_id bigint(20) NOT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY user_post (user_id, post_id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
