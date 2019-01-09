<?php
    include( plugin_dir_path( __FILE__ ) . '/header-candidate--details.php');
    $image_icon_user = esc_url( plugins_url( '../../images/user-480.png', __FILE__ ) );
    if ( have_posts() ) : while ( have_posts() ) : the_post(); $postid = $post->ID;
    $postmeta = get_post_meta($postid);
    $sum = $count = 0;
    if (isset($postmeta['post_countsubmit'])) {
        $countsubmit = (int)$postmeta['post_countsubmit'][0];
    }else {
        $countsubmit = 0;
    }
    // handle save form of template
    if(isset($_POST['submitted'])) {
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
        } else {
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

        if(!isset($hasError)) {
            $countsubmit++;
            for ($i=0; $i < $countsubmit; $i++) {
                $post_typeInterview = 'post_typeInterview'.$i;
                $post_Duration = 'post_Duration'.$i;
                $post_interviewrs = 'post_interviewrs'.$i;
                $post_interviewDetails = 'post_interviewDetails'.$i;
                $post_InterviewDate = 'post_InterviewDate'.$i;
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
                if (!isset($postmeta[$post_interviewDetails])) {
                    add_post_meta($postid, $post_interviewDetails, $_POST['interviewDetails']);
                }
                update_post_meta($postid, 'post_countsubmit', $countsubmit);
            }
        }
    }
    // handle save form of template
?>
    <div class="candidates candidate-details">
        <h1>
            Candidate Profile
        </h1>
        <header class="row flex-row">
            <div class="col-sm-1">
                <img src="<?php echo (get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : $image_icon_user; ?>" alt="user-icon" class="w-100">
            </div>
            <div class="col-sm-4 row">
                <div class="col-sm-6">
                    <h2 class="candidate-name"> (
                        <?php
                            if (get_field('candidate_name',$postid)) {
                                the_field('candidate_name',$postid);
                            }else {
                                echo "Dont have Name?";
                            }
                        ?>
                    ) </h2>
                    <p>
                        Applied position:
                        <span>
                            <?php
                                if (get_field('applied_position',$postid)) {
                                    the_field('applied_position',$postid);
                                }else {
                                    echo "not Applied position";
                                }
                            ?>
                        </span>
                    </p>
                    <p>
                        Desired salary:
                        <span>
                            <?php
                                if (get_field('desired_salary',$postid)) {
                                    the_field('desired_salary',$postid);
                                }else {
                                    echo "Desired salary";
                                }
                            ?>
                        </span>
                    </p>
                    <p>
                        Experience (years):
                        <span>
                            <?php
                                if (get_field('experience',$postid)) {
                                    the_field('experience',$postid);
                                }else {
                                    echo "not Experience";
                                }
                            ?>
                        </span>

                    </p>
                    <p>
                        Stage:
                        <span>
                            <?php
                                if (get_field('stage',$postid)) {
                                    the_field('stage',$postid);
                                }else {
                                    echo "not have Stage";
                                }
                            ?>
                        </span>
                    </p>
                </div>
                <div class="col-sm-6">
                    <p>Location :
                        <span>
                            <?php
                                if (get_field('location',$postid)) {
                                    the_field('location',$postid);
                                }else {
                                    echo "not have Location";
                                }
                            ?>
                        </span>
                    </p>
                    <p>Tel:
                        <span>
                            <?php
                                if (get_field('tel',$postid)) {
                                    the_field('tel',$postid);
                                }else {
                                    echo "not have phone number";
                                }
                            ?>
                        </span>
                    </p>
                    <p>Email address:
                        <span>
                            <?php
                                if (get_field('email',$postid)) {
                                    the_field('email',$postid);
                                }else {
                                    echo "not have email?";
                                }
                            ?>
                        </span>
                    </p>
                </div>
            </div>
            <div class="col-sm-7 flex-column">
                <p>labels</p>
                <div class="flex-row row">
                    <div class="col socials align-self-start d-inline-flex">
                        <a href="<?php if(get_field('social_link',$postid)){the_field('social_link',$postid);} ?>">aaa</a>
                        <div class="rating">
                            <p>Rating:
                            <span>
                                <?php
                                    if (get_field('rating',$postid)) {
                                        the_field('rating',$postid);
                                        echo "/10";
                                    }elseif(isset($average)) {
                                        echo $average;
                                        echo "/10";
                                    }else{
                                        echo "Not have rating";
                                    }
                                ?>
                            </span></p>
                        </div>
                    </div>
                    <div class="col set-new align-self-end">
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Set new interview</a>
                        <a href="mailto: <?php echo get_field('email',$postid) ?: get_field('email',$postid) ?>">Hire </a>
                    </div>
                </div>
            </div>
        </header>
        <body>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="w-100"><a href="#resume" data-toggle="tab">Resume</a></li>
                        <li class="w-100"><a href="#testdetails" data-toggle="tab">Test Details</a></li>
                        <li class="w-100"><a href="#rating-comments" data-toggle="tab">Rating & Comments</a></li>
                        <li class="w-100"><a href="#interview" data-toggle="tab">Interview</a></li>
                        <li class="w-100"><a href="#todo" data-toggle="tab">To Do</a></li>
                    </ul>
                </div>
                <div class="col-sm-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="resume"><iframe src="<?php echo (get_field('cv',$postid)["url"]) ?: get_field('cv',$postid)["url"] ?>" width="100%" style="height:100%"></iframe></div>
                        <div class="tab-pane" id="testdetails">waiting</div>
                        <div class="tab-pane" id="rating-comments">
                            <?php if (have_comments()) : ?>
                                <h2>
                                    Rating & Comments
                                </h2>
                                <div class="content-rating-comments">
                                    <h3 class="col-xs-5th-5">
                                        Stages
                                    </h3>

                                    <?php $comments = get_comments();

                                        foreach ($comments as $comment) :
                                        $comment_ID     = $comment->comment_ID;
                                        $commentmeta    = get_comment_meta($comment_ID);
                                        if ($commentmeta && $commentmeta["stage"][0] != NULL) :
                                        if (isset($commentmeta["stage"])){$commentmetastage                        = implode($commentmeta["stage"]);}
                                        if (isset($commentmeta["rating"])){$commentmetarating                      = implode($commentmeta["rating"]);}
                                        if (isset($commentmeta["assigned"])){$commentmetasigned                    = implode($commentmeta["assigned"]);}
                                        if (isset($commentmeta["approvedselects"])){$commentmetapprovedselects     = implode($commentmeta["approvedselects"]);}
                                        ?>
                                            <div class="<?php if($commentmetastage){echo $commentmetastage;} ?> col-lg-5th-1">
                                                <h4 class="title-<?php if($commentmetastage){echo $commentmetastage;} ?>">
                                                    <?php if($commentmetastage){echo $commentmetastage;} ?>
                                                </h4>
                                                <div class="conten-<?php if($commentmetastage){echo $commentmetastage;} ?> content_rating_comment flex-column">
                                                    <?php if ($commentmetasigned): ?>
                                                        <p>
                                                            Assigned to: <?= $commentmetasigned; ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if ($commentmetapprovedselects) : ?>
                                                        <p>
                                                            <?= $commentmetapprovedselects; ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if ($commentmetarating) : $sum+=$commentmetarating; ?>
                                                        <p>
                                                            Rate: <?= $commentmetarating; ?>/10
                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if (isset($comment->comment_content)): ?>
                                                        <p class="comment-content">
                                                            Comment: <?= $comment->comment_content; ?>
                                                        </p>
                                                    <?php endif ?>
                                                    <?php if (isset($comment->comment_date)): ?>
                                                        <p class="comment-date">
                                                            Date: <?= $comment->comment_date; ?>
                                                        </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        <?php $count++; endif; endforeach;
                                    ?>
                                    <div class="overallrating col-xs-5th-5">
                                        <h3>
                                            Overall Rating: <?php $average = $sum/$count; echo $average;  ?>/ 10
                                        </h3>
                                    </div>
                                    <div class="Comments col-xs-5th-5">
                                        <?php
                                            if (get_field('commentbyauthor',$postid)) {
                                                echo '<h3>Comments</h3>';
                                                the_field('commentbyauthor',$postid);
                                            }else {
                                                echo "not have commentbyauthor?";
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                In there no have any comments.
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="interview">
                            <div class="row">
                                <?php if (isset($postmeta)) {
                                    for ($k=0; $k < $countsubmit; $k++) {
                                        $post_typeInterview = 'post_typeInterview'.$k;
                                        $post_Duration = 'post_Duration'.$k;
                                        $post_interviewrs = 'post_interviewrs'.$k;
                                        $post_interviewDetails = 'post_interviewDetails'.$k;
                                        $post_InterviewDate = 'post_InterviewDate'.$k;
                                        ?>
                                        <div class="list-interviews col-sm-4">
                                            <?php if (isset($postmeta[$post_typeInterview][0])) : ?>
                                                <p>type of interview <span>
                                                <?= $postmeta[$post_typeInterview][0]; ?>
                                                </span></p>
                                            <?php endif; ?>
                                            <?php if (isset($postmeta[$post_interviewDetails][0])) : ?>
                                                <p>Interview Details: <span>
                                                <?= $postmeta[$post_interviewDetails][0]; ?>
                                                </span></p>
                                            <?php endif; ?>
                                            <?php if (isset($postmeta[$post_interviewrs][0])) : ?>
                                                <p>Interviewer: <span>
                                                <?= $postmeta[$post_interviewrs][0]; ?>
                                                </span></p>
                                            <?php endif; ?>
                                            <?php if (isset($postmeta[$post_Duration][0])) : ?>
                                                <p>Duration: <span>
                                                <?= $postmeta[$post_Duration][0]; ?>
                                                </span></p>
                                            <?php endif; ?>
                                            <?php if (isset($postmeta[$post_InterviewDate][0])) : ?>
                                                <p>Interview Time: <span>
                                                <?= $postmeta[$post_InterviewDate][0]; ?>
                                                </span></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    }
                                }
                                if (!isset($postmeta['post_countsubmit']) || $postmeta['post_countsubmit'] == 0 ) : ?>
                                    There no have any Interview set
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="todo">Settings Tab.</div>
                    </div>
                </div>
            </div>
        </body>
    </div>

    <div class="collapse" id="collapseExample">
        <div class="close">X</div>
        <div class="card card-body">
            <h3>Creat a new interview</h3>
            <form action="<?php the_permalink(); ?>" id="interviewForm" name="interviewForm" method="post">
                <div>
                    <label for="typeInterview">Select type of interview</label>
                    <select name="typeInterview" id="typeInterview">
                        <option value="screening">Screening</option>
                        <option value="phoneinterview">Phone Interview</option>
                        <option value="officeinterview">In-Office Interview</option>
                        <option value="test">Test</option>
                        <option value="makeoffer">Make An Offer</option>
                    </select>
                </div>
                <div>
                    <label for="interviewDetails">Interview Details (e.g vanue, phone etc)</label>
                    <input type="text" name="interviewDetails" />
                </div>
                <div>
                    <label for="interviewrs">Interviewers:</label>
                    <input type="text" name="interviewrs" />
                </div>
                <div>
                    <label for="Duration">Duration:</label>
                    <select name="Duration" id="duration">
                        <option value="30m">30 minutes</option>
                        <option value="1hour">1 hour</option>
                        <option value="2hours">2 hours</option>
                        <option value="3hours">3 hours</option>
                        <option value="4hours">4 hours</option>
                    </select>
                </div>
                <div>
                    <label for="InterviewDate">Interview Date :</label>
                    <input type="text" id="datepicker" name="InterviewDate">
                </div>
                <button type="submit">Save</button>
                <input type="hidden" name="submitted" id="submitted" value="true" />
            </form>
        </div>
    </div>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
<?php endwhile; endif; wp_reset_postdata();  get_footer();?>