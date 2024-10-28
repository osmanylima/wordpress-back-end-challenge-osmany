<?php

class FP_Rest_API {
    public function __construct() {
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function register_routes() {
        register_rest_route('favoritos/v1', '/(?P<post_id>\d+)', array(
            'methods' => 'POST',
            'callback' => array($this, 'favoritar_post'),
            'permission_callback' => function () {
                return is_user_logged_in();
            }
        ));

        register_rest_route('favoritos/v1', '/(?P<post_id>\d+)', array(
            'methods' => 'DELETE',
            'callback' => array($this, 'desfavoritar_post'),
            'permission_callback' => function () {
                return is_user_logged_in();
            }
        ));
    }

    public function favoritar_post($data) {
        global $wpdb;
        $user_id = get_current_user_id();
        $post_id = $data['post_id'];
        $table_name = $wpdb->prefix . 'favoritos_posts';

        $wpdb->replace($table_name, array('user_id' => $user_id, 'post_id' => $post_id));
        return new WP_REST_Response('Post favoritado', 200);
    }

    public function desfavoritar_post($data) {
        global $wpdb;
        $user_id = get_current_user_id();
        $post_id = $data['post_id'];
        $table_name = $wpdb->prefix . 'favoritos_posts';

        $wpdb->delete($table_name, array('user_id' => $user_id, 'post_id' => $post_id));
        return new WP_REST_Response('Post desfavoritado', 200);
    }
}

// Inicializa a API REST
new FP_Rest_API();
