<?php
    // add code below to wp-config root
    // define( 'SMTP_HOST', 'smtp.sendgrid.net' );  // A2 Hosting server name. For example, "a2ss10.a2hosting.com"
    // define( 'SMTP_AUTH', true );
    // define( 'SMTP_PORT', '465' );
    // define( 'SMTP_SECURE', 'ssl' );
    // define( 'SMTP_USERNAME', 'hojcham3' );  // Username for SMTP authentication
    // define( 'SMTP_PASSWORD', 'vjsaoy3up3' );          // Password for SMTP authentication
    // define( 'SMTP_FROM',     'hr@twentyci.asia' );  // SMTP From address
    // define( 'SMTP_FROMNAME', 'Hr Twentyci' );         // SMTP From name

    if (isset($_POST['listposts']) && $_POST['listposts'] != 'itempty') {
        $testlistargs = array( 'post_type' => 'task' ); $listposts = get_posts($testlistargs);
        foreach ($listposts as $listpost) {
            if ($listpost->post_title == $_POST['listposts'] ) {
                $linkpost = $listpost->guid;
            }
        }
        $to = get_field('email',$postid);
        $subject = 'Interview Invitation - '.get_field('candidate_name',$postid);
        $body = '
                    Dear '.get_field("candidate_name",$postid).'
                    This is link of your Test: '. $linkpost .'
                ';
        $headers[] = 'From: TwentyCI <hr@twentyci.asia>';
        $headers[] = 'Cc: <'.$_POST['interviewrs'].'>';
        $headers[] = 'Cc: <'.$_POST['interviewrs'].'>';
        wp_mail( $to, $subject, $body, $headers );
    } else {
        if (get_field('email',$postid) && get_field('candidate_name',$postid) && get_field('applied_position',$postid)) {
            $to = get_field('email',$postid);
            $subject = 'Interview Invitation - '.get_field('candidate_name',$postid);
            $body = '
                        Dear '.get_field("candidate_name",$postid).'
                        ,On behalf of TwentyCI ASIA, I would like to invite you for the Interview as set schedule:
                        Time: '. $_POST['InterviewDate'] .'
                        Position:'. get_field("applied_position",$postid) .'
                        Interviewers: '. $_POST['interviewrs'] .'
                        Location: 6th floor, No.7 Tran Phu Str, Ba Dinh Dist, Hanoi.
                        Please kindly arrange your time and confirm your attendance by replying this email.
                        Note:
                            * Be ready at least 10 minutes earlier
                            * Contact point for any change: ' . wp_get_current_user()->data->user_email . ' -
                            ' . wp_get_current_user()->data->display_name . ' - '. the_author_meta('description', wp_get_current_user()->data->ID) .'
                    ';
            $headers[] = 'From: TwentyCI <hr@twentyci.asia>';
            $headers[] = 'Cc: <'.$_POST['interviewrs'].'>';
            $headers[] = 'Cc: <'.$_POST['interviewrs'].'>';
            wp_mail( $to, $subject, $body, $headers );
        }else { echo "not have email?"; }
    }
?>