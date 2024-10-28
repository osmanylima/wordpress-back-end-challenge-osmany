<?php

class FP_Shortcodes {
    public function __construct() {
        add_shortcode('favorito_button', array($this, 'favorito_button_shortcode'));
    }

    public function favorito_button_shortcode($atts) {
        $atts = shortcode_atts(
            array(
                'post_id' => get_the_ID(), // ID do post atual como padrão
            ),
            $atts,
            'favorito_button'
        );

        // HTML do botão com o ID do post
        return '<button class="favoritar-btn" data-post-id="' . esc_attr($atts['post_id']) . '"></button>';
    }
}

// Inicializa o Shortcode
new FP_Shortcodes();
