<?php

function mrfeeders_categories()
{
    $terms = get_terms(array(
        'taxonomy'    => 'mrfeeders_category',
        'hide_empty'  => false,
        'number'      => 3,
        'order'       => 'DESC',
        'post_status' => 'publish',
    ));

    return $terms;
}

function mrfeeders_category_image($term)
{
    $term_image = get_term_meta($term->term_id, 'ncp_category_image', true) ?: '';
    return wp_get_attachment_url($term_image);
}

function mrfeeders_page()
{
    return get_page_by_path('mrfeeder');
}

function mrfeeders($term)
{
    $args = array(
        'post_type'      => array('mrfeeder'),
        'paged'          => '1',
        'posts_per_page' => '5',
        'post_status'    => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy'         => 'mrfeeders_category',
                'field'            => 'term_id',
                'terms'            => array($term->term_id),
                'include_children' => false,
            ),
        ),
    );
    return new WP_Query($args);
}

function article_mrfeeders()
{
    $args = array(
        'post_type'   => array('mrfeeder'),
        'post_status' => 'publish',
        'orderby'     => 'rand',
        'post_status' => 'publish',
    );
    return new WP_Query($args);
}
