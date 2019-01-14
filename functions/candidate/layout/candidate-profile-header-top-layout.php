<?php if (isset($postmeta)) : ?>
    <header class="row flex-row">
        <div class="col-sm-1">
            <img src="<?php echo (get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : $image_icon_user; ?>" alt="user-icon" class="w-100">
        </div>
        <div class="col-sm-4 row">
            <div class="col-sm-6">

                <h2 class="candidate-name"> (
                    <?php
                        if ($postmeta['candidate_name'][0]) {
                            echo $postmeta['candidate_name'][0];
                        }else { echo "Dont have Name?"; }
                    ?>
                ) </h2>
                <p>
                    Applied position:
                    <span>
                        <?php
                            if ($postmeta['applied_position'][0]) {
                                echo $postmeta['applied_position'][0];
                            }else { echo "not Applied position"; }
                        ?>
                    </span>
                </p>
                <p>
                    Desired salary:
                    <span>
                        <?php
                            if ($postmeta['desired_salary'][0]) {
                                echo $postmeta['desired_salary'][0];
                            }else { echo "Not have Desired salary"; }
                        ?>
                    </span>
                </p>
                <p>
                    Experience (years):
                    <span>
                        <?php
                            if ($postmeta['experience'][0]) {
                                echo $postmeta['experience'][0];
                            }else { echo "not Experience"; }
                        ?>
                    </span>

                </p>
                <p>
                    Stage:
                    <span>
                        <?php
                            if ($postmeta['stage'][0]) {
                                echo $postmeta['stage'][0];
                            }else { echo "not have Stage"; }
                        ?>
                    </span>
                </p>
            </div>
            <div class="col-sm-6">
                <p>Location :
                    <span>
                        <?php
                            if ($postmeta['location'][0]) {
                                echo $postmeta['location'][0];
                            }else { echo "not have Location"; }
                        ?>
                    </span>
                </p>
                <p>Tel:
                    <span>
                        <?php
                            if ($postmeta['tel'][0]) {
                                echo $postmeta['tel'][0];
                            }else { echo "not have phone number"; }
                        ?>
                    </span>
                </p>
                <p>Email address:
                    <span>
                        <?php
                            if ($postmeta['email'][0]) {
                                echo $postmeta['email'][0];
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
                        <?php if ($postmeta['social_link'][0]): ?>
                            <a href="<?php if($postmeta['social_link'][0]){echo $postmeta['social_link'][0];} ?>" class="social-facebook"><i class="fab fa-facebook-f"></i></a>
                        <?php endif;if ($postmeta['social_link_linkendin'][0]): ?>
                            <a href="<?php if($postmeta['social_link_linkendin'][0]){echo $postmeta['social_link_linkendin'][0];} ?>" class="social-linkendin"><i class="fab fa-linkedin"></i></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="rating">
                        <p>Rating:
                        <span>
                            <?php
                                if ($postmeta['rating'][0]) {
                                    echo $postmeta['rating'][0];
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
                    <a href="mailto: <?php echo $postmeta['email'][0] ?: $postmeta['email'][0] ?>" class="btn hire-button">Hire <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
    </header>
<?php endif; ?>