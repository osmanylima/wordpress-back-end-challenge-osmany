<?php
/**
 * Plugin Name: Favoritos Posts
 * Description: Permite que usuários logados favoritem e desfavoritem posts.
 * Version: 1.0
 * Author: Osmany Lima
 * @author   Osmany Lima <osmanylima14@gmail.com>
 */

// Evita o acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

// Define o caminho do plugin
define('FP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Inclui os arquivos necessários
require_once FP_PLUGIN_DIR . 'includes/class-fp-database.php';
require_once FP_PLUGIN_DIR . 'includes/class-fp-rest-api.php';
require_once FP_PLUGIN_DIR . 'includes/class-fp-shortcodes.php';

// Registra a tabela no banco de dados na ativação do plugin
register_activation_hook(__FILE__, array('FP_Database', 'create_favoritos_table'));

// Enfileira os scripts
function fp_enqueue_scripts() {
    if (is_single()) {
        wp_enqueue_script('favoritos-js', FP_PLUGIN_URL . 'assets/js/favorites.js', array('jquery'), '1.0', true);
        wp_localize_script('favoritos-js', 'favoritos_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}
add_action('wp_enqueue_scripts', 'fp_enqueue_scripts');
