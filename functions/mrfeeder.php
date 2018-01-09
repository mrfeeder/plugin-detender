<?php

function register_posttypes_mrfeeder()
{
    $labels = array(
        'name'               => esc_html__('mrfeeder'),
        'singular_name'      => esc_html__('mrfeeder'),
        'add_new'            => esc_html__('Add New mrfeeder'),
        'add_new_item'       => esc_html__('Add New mrfeeder'),
        'edit_item'          => esc_html__('Edit mrfeeder'),
        'new_item'           => esc_html__('New mrfeeder'),
        'all_items'          => esc_html__('All mrfeeder'),
        'view_item'          => esc_html__('View mrfeeder'),
        'search_items'       => esc_html__('Search mrfeeder'),
        'not_found'          => esc_html__('Nothing found'),
        'not_found_in_trash' => esc_html__('Nothing found in Trash'),
        'parent_item_colon'  => '',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'can_export'         => true,
        'show_in_nav_menus'  => true,
        'query_var'          => true,
        'has_archive'        => true,
        'rewrite'            => array(
            'feeds'      => true,
            'slug'       => 'mrfeeder',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
        ),
    );

    /**
     * Create post type
     */
    register_post_type('mrfeeder', $args);

    $labels = array(
        'name'              => esc_html__('mrfeeders Categories'),
        'singular_name'     => esc_html__('mrfeeders Category'),
        'search_items'      => esc_html__('Search mrfeeders Categories'),
        'all_items'         => esc_html__('All mrfeeders Categories'),
        'parent_item'       => esc_html__('Parent mrfeeders Category'),
        'parent_item_colon' => esc_html__('Parent mrfeeders Category:'),
        'edit_item'         => esc_html__('Edit mrfeeders Category'),
        'update_item'       => esc_html__('Update mrfeeders Category'),
        'add_new_item'      => esc_html__('Add New mrfeeders Category'),
        'new_item_name'     => esc_html__('New mrfeeders Category Name'),
        'menu_name'         => esc_html__('mrfeeders Categories'),
    );

    /**
     * Create category
     */
    register_taxonomy('mrfeeders_category', array('mrfeeder'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_quick_edit'=> true,
    ));
}

register_posttypes_mrfeeder();
