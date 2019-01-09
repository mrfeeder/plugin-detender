<?php

    add_filter( 'post_updated_messages', 'codex_candidate_updated_messages' );
    function codex_candidate_updated_messages( $messages ) {
        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );

        $messages['candidate'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'Candidate updated.', 'candidate' ),
            2  => __( 'Custom field updated.', 'candidate' ),
            3  => __( 'Candidate deleted.', 'candidate' ),
            4  => __( 'Candidate updated.', 'candidate' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Candidate restored to revision from %s', 'candidate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Candidate Published.', 'candidate' ),
            7  => __( 'Candidate Saved.', 'candidate' ),
            8  => __( 'Candidate Submitted.', 'candidate' ),
            9  => sprintf(
                __( 'Candidate scheduled for: <strong>%1$s</strong>.', 'candidate' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'candidate' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Candidate draft updated.', 'candidate' )
        );

        if ( $post_type_object->publicly_queryable && 'candidate' === $post_type ) {
            $permalink = get_permalink( $post->ID );

            $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View Candidate', 'candidate' ) );
            $messages[ $post_type ][1] .= $view_link;
            $messages[ $post_type ][6] .= $view_link;
            $messages[ $post_type ][9] .= $view_link;

            $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
            $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview Candidate', 'candidate' ) );
            $messages[ $post_type ][8]  .= $preview_link;
            $messages[ $post_type ][10] .= $preview_link;
        }

        return $messages;
    }
    function candidate_post_updated_messages_filter( $bulk_messages, $bulk_counts ) {

        $bulk_messages['candidate'] = array(
            'locked'    => _n( '%s Candidate not updated, somebody is editing it.', '%s candidates not updated, somebody is editing them.', $bulk_counts['locked'] ),
            'deleted'   => _n( '%s Candidate permanently deleted.', '%s candidates permanently deleted.', $bulk_counts['deleted'] ),
            'trashed'   => _n( '%s Candidate moved to the Trash.', '%s candidates moved to the Trash.', $bulk_counts['trashed'] ),
            'untrashed' => _n( '%s Candidate restored from the Trash.', '%s candidates restored from the Trash.', $bulk_counts['untrashed'] ),
        );

        return $bulk_messages;

    }

    add_filter( 'bulk_post_updated_messages', 'candidate_post_updated_messages_filter', 10, 2 );
?>