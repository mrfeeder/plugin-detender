<div style="display: none" class="remove-template"><?php comments_template(); ?></div>
<?php  $comments = get_comments(); if (have_comments()) : ?>
    <h2>
        Rating & Comments
    </h2>
    <div class="content-rating-comments">
        <h3 class="col-xs-5th-5">
            Stages
        </h3>
        <?php
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