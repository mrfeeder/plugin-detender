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
                    }else { echo "Dont have Name?"; }
                ?>
            ) </h2>
            <p>
                Applied position:
                <span>
                    <?php
                        if (get_field('applied_position',$postid)) {
                            the_field('applied_position',$postid);
                        }else { echo "not Applied position"; }
                    ?>
                </span>
            </p>
            <p>
                Desired salary:
                <span>
                    <?php
                        if (get_field('desired_salary',$postid)) {
                            the_field('desired_salary',$postid);
                        }else { echo "Not have Desired salary"; }
                    ?>
                </span>
            </p>
            <p>
                Experience (years):
                <span>
                    <?php
                        if (get_field('experience',$postid)) {
                            the_field('experience',$postid);
                        }else { echo "not Experience"; }
                    ?>
                </span>

            </p>
            <p>
                Stage:
                <span>
                    <?php
                        if (get_field('stage',$postid)) {
                            the_field('stage',$postid);
                        }else { echo "not have Stage"; }
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
                        }else { echo "not have Location"; }
                    ?>
                </span>
            </p>
            <p>Tel:
                <span>
                    <?php
                        if (get_field('tel',$postid)) {
                            the_field('tel',$postid);
                        }else { echo "not have phone number"; }
                    ?>
                </span>
            </p>
            <p>Email address:
                <span>
                    <?php
                        if (get_field('email',$postid)) {
                            the_field('email',$postid);
                        }else { echo "not have email?"; }
                    ?>
                </span>
            </p>
        </div>
    </div>
    <div class="col-sm-7 flex-column">
        <div class="flex-row row">
            <div class="col socials align-self-start d-inline-flex flex-column">
                <div class="d-inline-flex">
                    <p class="title-social">Social profiles: </p>
                    <?php if (get_field('social_link',$postid)): ?>
                        <a href="<?php if(get_field('social_link',$postid)){the_field('social_link',$postid);} ?>" class="social-facebook"><i class="fab fa-facebook-f"></i></a>
                    <?php endif;if (get_field('social_link_linkendin',$postid)): ?>
                        <a href="<?php if(get_field('social_link_linkendin',$postid)){the_field('social_link_linkendin',$postid);} ?>" class="social-linkendin"><i class="fab fa-linkedin"></i></i></a>
                    <?php endif; ?>
                </div>
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
                            }else{ echo "Not have rating"; }
                        ?>
                    </span></p>
                </div>
            </div>
            <div class="col set-new align-self-end">
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Set new interview</a>
                <a href="mailto: <?php echo get_field('email',$postid) ?: get_field('email',$postid) ?>" class="btn hire-button">Hire <i class="fas fa-plus"></i></a>
            </div>
        </div>
    </div>
</header>