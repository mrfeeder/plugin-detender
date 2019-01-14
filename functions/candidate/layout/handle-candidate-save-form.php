<?php
    if(isset($_POST['submittedtodo'])) {
        if(trim($_POST['todoTextarea']) === '') {
            $todoTextareaError = 'Please submit your note';
            $hasError = true;
        } else {
            $todoTextarea = trim($_POST['todoTextarea']);
        }


        if(!isset($hasError)) {
            $counttodosubmit++;
            for ($i=0; $i < $counttodosubmit; $i++) {
                $post_todoTextarea = 'post_todoTextarea'.$i;
                if (!isset($postmeta[$post_todoTextarea])) {
                    add_post_meta($postid, $post_todoTextarea, $_POST['todoTextarea']);
                }
                update_post_meta($postid, 'post_counttodosubmit', $counttodosubmit);
            }
        }
    }
    if(isset($_POST['submitted'])) {
        $valid = PHPMailer::validateAddress($_POST['interviewrs']);
        if(trim($_POST['typeInterview']) === '') {
            $nameError = 'Please select type of Interview';
            $hasError = true;
        } else {
            $name = trim($_POST['typeInterview']);
        }

        if(trim($_POST['Duration']) === '') {
            $nameError = 'Please select Duration';
            $hasError = true;
        } else {
            $name = trim($_POST['Duration']);
        }

        if(trim($_POST['interviewrs']) === '') {
            $commentError = 'Please enter a Interviewrs.';
            $hasError = true;
        } elseif (!$valid) {
            $hasError = true;
        }else {
            if(function_exists('stripslashes')) {
                $interviewrs = stripslashes(trim($_POST['interviewrs']));
            } else {
                $interviewrs = trim($_POST['interviewrs']);
            }
        }

        if(trim($_POST['interviewDetails']) === '') {
            $commentError = 'Please enter a Interview Details.';
            $hasError = true;
        } else {
            if(function_exists('stripslashes')) {
                $interviewDetails = stripslashes(trim($_POST['interviewDetails']));
            } else {
                $interviewDetails = trim($_POST['interviewDetails']);
            }
        }

        if(trim($_POST['InterviewDate']) === '') {
            $commentError = 'Please enter a Interview Date.';
            $hasError = true;
        } else {
            if(function_exists('stripslashes')) {
                $InterviewDate = stripslashes(trim($_POST['InterviewDate']));
            } else {
                $InterviewDate = trim($_POST['InterviewDate']);
            }
        }

        if(trim($_POST['Interviewtime']) === '') {
            $commentError = 'Please enter a Interview time.';
            $hasError = true;
        } else {
            if(function_exists('stripslashes')) {
                $Interviewtime = stripslashes(trim($_POST['Interviewtime']));
            } else {
                $Interviewtime = trim($_POST['Interviewtime']);
            }
        }

        if(!isset($hasError)) {
            $countsubmit++;
            for ($i=0; $i < $countsubmit; $i++) {
                $post_typeInterview = 'post_typeInterview'.$i;
                $post_Duration = 'post_Duration'.$i;
                $post_interviewrs = 'post_interviewrs'.$i;
                $post_interviewDetails = 'post_interviewDetails'.$i;
                $post_InterviewDate = 'post_InterviewDate'.$i;
                $post_Interviewtime = 'post_Interviewtime'.$i;
                if (!isset($postmeta[$post_typeInterview])) {
                    add_post_meta($postid, $post_typeInterview, $_POST['typeInterview']);
                }
                if (!isset($postmeta[$post_Duration])) {
                    add_post_meta($postid, $post_Duration, $_POST['Duration']);
                }
                if (!isset($postmeta[$post_interviewrs])) {
                    add_post_meta($postid, $post_interviewrs, $_POST['interviewrs']);
                }
                if (!isset($postmeta[$post_InterviewDate])) {
                    add_post_meta($postid, $post_InterviewDate, $_POST['InterviewDate']);
                }
                if (!isset($postmeta[$post_Interviewtime])) {
                    add_post_meta($postid, $post_Interviewtime, $_POST['Interviewtime']);
                }
                if (!isset($postmeta[$post_interviewDetails])) {
                    add_post_meta($postid, $post_interviewDetails, $_POST['interviewDetails']);
                }
                update_post_meta($postid, 'post_countsubmit', $countsubmit);

                // handle send mail of template
                include( plugin_dir_path( __FILE__ ) . '../handle-send-mail-form.php');
                // handle send mail of template
            }
        }
    }
?>