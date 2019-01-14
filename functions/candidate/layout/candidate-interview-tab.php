<div class="row">
    <?php if (isset($postmeta)) {
        for ($k=0; $k < $countsubmit; $k++) {
            $post_typeInterview = 'post_typeInterview'.$k;
            $post_Duration = 'post_Duration'.$k;
            $post_interviewrs = 'post_interviewrs'.$k;
            $post_interviewDetails = 'post_interviewDetails'.$k;
            $post_InterviewDate = 'post_InterviewDate'.$k;
            $post_Interviewtime = 'post_Interviewtime'.$k;
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
                    <p>Interview Date: <span>
                    <?= $postmeta[$post_InterviewDate][0]; ?>
                    </span></p>
                <?php endif; ?>
                <?php if (isset($postmeta[$post_Interviewtime][0])) : ?>
                    <p>Interview Time: <span>
                    <?= $postmeta[$post_Interviewtime][0]; ?>
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