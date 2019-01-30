<?php if ((get_field('email',$postid)) != null) :
    $emailcandidate = get_field('email',$postid);
    global $wpdb;
    $testdetails = $wpdb->get_results("
    select name, value from ".$wpdb->prefix."cf7_data_entry where data_id in (SELECT data_id FROM ".$wpdb->prefix."cf7_data_entry where name = 'Email' AND value like '%". $emailcandidate ."%')");
    if (isset($testdetails) && $testdetails != null) :
        $new = $testdetails[9];
        $new2 = $testdetails[8];
        array_unshift($testdetails, $new2);
        array_unshift($testdetails, $new);
        foreach ($testdetails as $testdetail) :
?>
    <?php
        if ( in_array($testdetail->name, array("Repo", "Instruction", "TaskUrl", "Taskname", "Hours", "UrlTask")) ) :
    ?>

        <p> <?= $testdetail->name; ?> : <?= $testdetail->value; ?> </p>
    <?php endif; ?>
<?php endforeach; else: ?>
    <h5>Not test yet</h5>
<?php endif; ?>
<?php else: ?>
    <p> Not have email </p>
<?php endif; ?>