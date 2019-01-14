<?php
    if (get_field('email',$postid) && get_field('candidate_name',$postid) && get_field('applied_position',$postid)) {

        $to = the_field('email',$postid);
        $subject = 'Interview Invitation - '.the_field('candidate_name',$postid);
        $body = '
                    Dear '.the_field("candidate_name",$postid).'
                    ,</br>On behalf of TwentyCI ASIA, I would like to invite you for the Interview as set schedule:</br>
                    Time: '. $_POST['InterviewDate'] .'</br>
                    Position:'. the_field("applied_position",$postid) .'</br>
                    Interviewers: '. $_POST['interviewrs'] .'</br>
                    Location: 6th floor, No.7 Tran Phu Str, Ba Dinh Dist, Hanoi. </br>
                    Please kindly arrange your time and confirm your attendance by replying this email. </br>
                    Note:</br>
                        * Be ready at least 10 minutes earlier
                        * Contact point for any change: ' . wp_get_current_user()->data->user_email . ' -
                        ' . wp_get_current_user()->data->display_name . ' -
                        '. the_author_meta('description', wp_get_current_user()->data->ID) .'
                ';
        $headers[] = 'From: TwentyCI <hr@twentyci.asia>';
        $headers[] = 'Cc: <'.$_POST['interviewrs'].'>';
        wp_mail( $to, $subject, $body, $headers );
    }else { echo "not have email?"; }
?>