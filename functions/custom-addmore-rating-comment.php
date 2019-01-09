<?php
// Add custom meta (ratings) fields to the default comment form
// Default comment form includes name, email address and website URL
// Default comment form elements are hidden when user is logged in



// holding this functions not working
function feeder_custom_fields($fields) {
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );

        $fields[ 'author' ] = '<p class="comment-form-author">'.
        '<label for="author">' . __( 'Name' ) . '</label>'.
        ( $req ? '<span class="required">*</span>' : ’ ).
        '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .
        '" size="30" tabindex="1"' . $aria_req . ' /></p>';

        $fields[ 'email' ] = '<p class="comment-form-email">'.
        '<label for="email">' . __( 'Email' ) . '</label>'.
        ( $req ? '<span class="required">*</span>' : ’ ).
        '<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .
        '" size="30"  tabindex="2"' . $aria_req . ' /></p>';

        $fields[ 'url' ] = '<p class="comment-form-url">'.
        '<label for="url">' . __( 'Website' ) . '</label>'.
        '<input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .
        '" size="30"  tabindex="3" /></p>';

        $fields[ 'assigned' ] = '<p class="comment-form-assigned">'.
        '<label for="assigned">' . __( 'Assigned' ) . '</label>'.
        '<input id="assigned" name="assigned" type="text" size="30"  tabindex="4" /></p>';
    return $fields;
}
add_filter('comment_form_fields', 'feeder_custom_fields');

// Add fields after default fields above the comment box, always visible
function feeder_additional_fields () {
    echo '<p class="comment-form-approved">'.
    '<label for="approvedselects">' . __( 'Approved/Unapproved' ) . '</label>'.
    '<select name="approvedselects" id="approvedselects">
        <option value="approved">Approved</option>
        <option value="unapproved">Unapproved</option>
    </select>';

    echo '<p class="comment-form-stage">'.
    '<label for="stage">' . __( 'Stage' ) . '</label>'.
    '<select name="stage" id="stage">
        <option value="screening">Screening</option>
        <option value="phoneinterview">Phone Interview</option>
        <option value="officeinterview">In-Office Interview</option>
        <option value="test">Test</option>
        <option value="makeoffer">Make An Offer</option>
    </select>';

    echo '<p class="comment-form-rating">'.
    '<label for="rating">'. __('Rating') . '<span class="required">*</span></label>
    <span class="commentratingbox">';
        for( $i=1; $i <= 10; $i++ )
        echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"/>'. $i .'</span>';
    echo'</span></p>';
}
add_action( 'comment_form_logged_in_after', 'feeder_additional_fields', 10, 2  );
add_action( 'comment_form_after_fields', 'feeder_additional_fields', 10, 2  );
// end holding this functions not working





// Save the comment meta data along with comment
function feeder_save_comment_meta_data( $comment_id ) {
    if ( ( isset( $_POST['approvedselects'] ) ) && ( $_POST['approvedselects'] != ’) )
    $approvedselects = wp_filter_nohtml_kses($_POST['approvedselects']);
    add_comment_meta( $comment_id, 'approvedselects', $approvedselects );

    if ( ( isset( $_POST['assigned'] ) ) && ( $_POST['assigned'] != ’) )
    $assigned = wp_filter_nohtml_kses($_POST['assigned']);
    add_comment_meta( $comment_id, 'assigned', $assigned );

    if ( ( isset( $_POST['stage'] ) ) && ( $_POST['stage'] != ’) )
    $stage = wp_filter_nohtml_kses($_POST['stage']);
    add_comment_meta( $comment_id, 'stage', $stage );

    if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != ’) )
    $rating = wp_filter_nohtml_kses($_POST['rating']);
    add_comment_meta( $comment_id, 'rating', $rating );
}
add_action( 'comment_post', 'feeder_save_comment_meta_data' );



// Add the filter to check whether the comment meta data has been filled
// function feeder_verify_comment_meta_data( $commentdata ) {
//     if ( ! isset( $_POST['rating'] ) )
//     wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
//     return $commentdata;
// }
// add_filter( 'preprocess_comment', 'feeder_verify_comment_meta_data' );





// Add the comment meta (saved earlier) to the comment text
// You can also output the comment meta values directly to the comments template

function feeder_modify_comment( $text ){
    $plugin_url_path = WP_PLUGIN_URL;
    if( $commentrating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
        $commentrating = '<p class="comment-rating">Rating: <strong>'. $commentrating .' / 10</strong></p>';
        $text = $text . $commentrating;
        return $text;
    } else {
        return $text;
    }

    if( $commentassigned = get_comment_meta( get_comment_ID(), 'assigned', true ) ) {
        $commentassigned = '<strong>' . esc_attr( $commentassigned ) . '</strong><br/>';
        $text = $commentassigned . $text;
    }

    if( $commentassigned = get_comment_meta( get_comment_ID(), 'stage', true ) ) {
        $commentassigned = '<strong>' . esc_attr( $commentassigned ) . '</strong><br/>';
        $text = $commentassigned . $text;
    }

    if( $commentapprovedselects = get_comment_meta( get_comment_ID(), 'approvedselects', true ) ) {
        $commentapprovedselects = '<strong>' . esc_attr( $commentapprovedselects ) . '</strong><br/>';
        $text = $commentapprovedselects . $text;
    }
}
add_filter( 'comment_text', 'feeder_modify_comment');

// Add an edit option to comment editing screen
function extend_comment_add_meta_box() {
    add_meta_box( 'rating', __( 'Comment Metadata - Extend Comment Rating' ), 'feeder_extend_comment_meta_box', 'comment', 'normal', 'high' );
}
add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );

function feeder_extend_comment_meta_box ( $comment ) {
    $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    $assigned = get_comment_meta( $comment->comment_ID, 'assigned', true );
    $approvedselects = get_comment_meta( $comment->comment_ID, 'approvedselects', true );
    $stage = get_comment_meta( $comment->comment_ID, 'stage', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?> <p>
        <label for="rating"><?php _e( 'Rating: ' ); ?></label>
        <span class="commentratingbox">
            <?php for( $i=1; $i <= 10; $i++ ) {
                echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"';
                if ( $rating == $i ) echo ' checked="checked"';
                echo ' />'. $i .' </span>';
            } ?>
        </span></p><p>
        <span class="assigned">
            <label for="assigned"><?php _e( 'Assigned to:' ); ?></label>
            <input id="assigned" name="assigned" type="text" size="30"  tabindex="4" value="<?= $assigned; ?>"/>
        </span></p><p>
        <span class="approvedselects">
            <label for="approvedselects"><?php _e( 'Approved/Unapproved' ); ?></label>
            <select name="approvedselects" id="approvedselects">
                <option value="approved" <?php if ($approvedselects == "approved"){echo "selected";} ?>>Approved</option>
                <option value="unapproved" <?php if ($approvedselects == "unapproved"){echo "selected";} ?>>Unapproved</option>
            </select>
        </span></p><p>
        <span class="stage">
            <label for="stage"><?php _e( 'Stage' ); ?></label>
            <select name="stage" id="stage">
                <option value="screening" <?php if ($stage == "screening"){echo "selected";} ?>>Screening</option>
                <option value="phoneinterview" <?php if ($stage == "phoneinterview"){echo "selected";} ?>>Phone Interview</option>
                <option value="officeinterview" <?php if ($stage == "officeinterview"){echo "selected";} ?>>In-Office Interview</option>
                <option value="test" <?php if ($stage == "test"){echo "selected";} ?>>Test</option>
                <option value="makeoffer" <?php if ($stage == "makeoffer"){echo "selected";} ?>>Make An Offer</option>
            </select>
        </span>
    </p> <?php
}
// Update comment meta data from comment editing screen

function feeder_extend_comment_edit_metafields( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;
    if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != ’) ):
        $rating = wp_filter_nohtml_kses($_POST['rating']);
        update_comment_meta( $comment_id, 'rating', $rating );
    else :
        delete_comment_meta( $comment_id, 'rating');
    endif;

    if ( ( isset( $_POST['assigned'] ) ) && ( $_POST['assigned'] != ’) ):
    $assigned = wp_filter_nohtml_kses($_POST['assigned']);
    update_comment_meta( $comment_id, 'assigned', $assigned );
    else :
    delete_comment_meta( $comment_id, 'assigned');
    endif;

    if ( ( isset( $_POST['approvedselects'] ) ) && ( $_POST['approvedselects'] != ’) ):
    $approvedselects = wp_filter_nohtml_kses($_POST['approvedselects']);
    update_comment_meta( $comment_id, 'approvedselects', $approvedselects );
    else :
    delete_comment_meta( $comment_id, 'approvedselects');
    endif;

    if ( ( isset( $_POST['stage'] ) ) && ( $_POST['stage'] != ’) ):
    $stage = wp_filter_nohtml_kses($_POST['stage']);
    update_comment_meta( $comment_id, 'stage', $stage );
    else :
    delete_comment_meta( $comment_id, 'stage');
    endif;

}
add_action( 'edit_comment', 'feeder_extend_comment_edit_metafields' );

?>