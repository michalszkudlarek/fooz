<?php
acf_register_block_type( array(
    'name'            => 'Faq accordion',
    'title'           => __( 'Faq accordion', 'twentytwentyfive-child' ),
    'description'     => __( 'Block displaying accordion for FAQ questions', 'twentytwentyfive-child' ),
    'render_template' => 'template-parts/blocks/accordion.php',
    'category'        => 'fooz-blocks',
    'mode'            => 'edit',
    'icon'            => 'screenoptions',
    'keywords'        => array( 'header', 'text', 'accordion', 'question', 'answer', 'faq' ),
    'supports' => array( 'anchor' => true )
) );