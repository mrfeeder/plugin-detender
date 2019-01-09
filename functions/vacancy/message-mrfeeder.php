<?php

    add_filter( 'post_updated_messages', 'codex_vacancy_updated_messages' );
    function codex_vacancy_updated_messages( $messages ) {
        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );

        $messages['vacancy'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'vacancy updated.', 'vacancy' ),
            2  => __( 'Custom field updated.', 'vacancy' ),
            3  => __( 'Custom field deleted.', 'vacancy' ),
            4  => __( 'vacancy updated.', 'vacancy' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'vacancy restored to revision from %s', 'vacancy' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'vacancy published.', 'vacancy' ),
            7  => __( 'vacancy saved.', 'vacancy' ),
            8  => __( 'vacancy submitted.', 'vacancy' ),
            9  => sprintf(
                __( 'vacancy scheduled for: <strong>%1$s</strong>.', 'vacancy' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'vacancy' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'vacancy draft updated.', 'vacancy' )
        );

        if ( $post_type_object->publicly_queryable && 'vacancy' === $post_type ) {
            $permalink = get_permalink( $post->ID );

            $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View vacancy', 'vacancy' ) );
            $messages[ $post_type ][1] .= $view_link;
            $messages[ $post_type ][6] .= $view_link;
            $messages[ $post_type ][9] .= $view_link;

            $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
            $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview vacancy', 'vacancy' ) );
            $messages[ $post_type ][8]  .= $preview_link;
            $messages[ $post_type ][10] .= $preview_link;
        }

        return $messages;
    }
    function my_bulk_post_updated_messages_filter( $bulk_messages, $bulk_counts ) {

        $bulk_messages['vacancy'] = array(
            'locked'    => _n( '%s vacancy not updated, somebody is editing it.', '%s vacancys not updated, somebody is editing them.', $bulk_counts['locked'] ),
            'deleted'   => _n( '%s vacancy permanently deleted.', '%s vacancys permanently deleted.', $bulk_counts['deleted'] ),
            'trashed'   => _n( '%s vacancy moved to the Trash.', '%s vacancys moved to the Trash.', $bulk_counts['trashed'] ),
            'untrashed' => _n( '%s vacancy restored from the Trash.', '%s vacancys restored from the Trash.', $bulk_counts['untrashed'] ),
        );

        return $bulk_messages;

    }

    add_filter( 'bulk_post_updated_messages', 'my_bulk_post_updated_messages_filter', 10, 2 );
?>