<?php if ((get_field('email',$postid)) != null) :
    $emailcandidate = get_field('email',$postid);
    global $wpdb;
    $testdetails = $wpdb->get_results("
    select name, value from magentotest.wp_cf7_data_entry where data_id in (SELECT data_id FROM magentotest.wp_cf7_data_entry where name = 'Email' AND value like '%". $emailcandidate ."%')");
    if (isset($testdetails) && $testdetails != null) :
        foreach ($testdetails as $testdetail) :
?>
    <?php
        if ( in_array($testdetail->name, array("Repo", "Instruction", "TaskUrl", "Taskname", "Hours", "UrlTask")) ) :
    ?>
        <p> <?= $testdetail->name; ?> : <?= $testdetail->value; ?> </p>
    <?php endif; ?>
<?php endforeach; else: ?>
    <p> This email is not the same email as the email entered in test or this candidate not have test details</p>
<?php endif; ?>
<?php else: ?>
    <p> Not have email </p>
<?php endif; ?>