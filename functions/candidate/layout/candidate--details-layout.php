<?php
    include( plugin_dir_path( __FILE__ ) . '/header-candidate--details.php');
    $image_icon_user = esc_url( plugins_url( '../../../images/user-480.png', __FILE__ ) );
    if ( have_posts() ) : while ( have_posts() ) : the_post(); $postid = $post->ID;
    $postmeta = get_post_meta($postid);
    $sum = $count = 0;
    if (isset($postmeta['post_countsubmit'])) {
        $countsubmit = (int)$postmeta['post_countsubmit'][0];
    }else {
        $countsubmit = 0;
    }

    if (isset($postmeta['post_counttodosubmit'])) {
        $counttodosubmit = (int)$postmeta['post_counttodosubmit'][0];
    }else {
        $counttodosubmit = 0;
    }

    // handle save form of template
    include( plugin_dir_path( __FILE__ ) . '/handle-candidate-save-form.php');
    // handle save form of template

?>
    <div class="candidates candidate-details">
        <h1>
            Candidate Profile
        </h1>
        <?php include( plugin_dir_path( __FILE__ ) . '/candidate-profile-header-top-layout.php'); ?>
        <body>
            <div class="row candidate-contents">
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
                        <div class="tab-pane" id="testdetails">
                            <?php include( plugin_dir_path( __FILE__ ) . '/test-details-layout.php'); ?>
                        </div>
                        <div class="tab-pane" id="rating-comments">
                            <?php include( plugin_dir_path( __FILE__ ) . '/candidate-rating-comment-tab.php'); ?>
                        </div>
                        <div class="tab-pane" id="interview">
                            <?php include( plugin_dir_path( __FILE__ ) . '/candidate-interview-tab.php'); ?>
                        </div>
                        <div class="tab-pane" id="todo">
                            <?php include( plugin_dir_path( __FILE__ ) . '/candidate-todo-tab.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </div>
    <div class="collapse" id="collapseExample">
        <?php include( plugin_dir_path( __FILE__ ) . '/candidate-interview-form.php'); ?>
    </div>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
<?php endwhile; endif; wp_reset_postdata();  get_footer();?>