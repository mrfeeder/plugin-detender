<?php
    global $wpdb;
    $sqlsetforeignkeycheck = 'set foreign_key_checks=0';
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    dbDelta($sqlsetforeignkeycheck);
    $table_candidates = $wpdb->prefix."candidates";
    $table_jobs = $wpdb->prefix."jobs";
    $table_candidate = $wpdb->prefix."candidate";
    $table_test_details = $wpdb->prefix."test_details";
    $table_interview = $wpdb->prefix."interview";

    if ($wpdb->get_var('SHOW TABLES LIKE "%'.$table_interview.'%"') != $table_interview) {
        $sqltable_interview = 'CREATE TABLE '.$table_interview.'(
            interview_id                    int not null,
            type_interview                  text,
            interviewer                     text,
            duration                        float,
            interview_date                  datetime,
            PRIMARY KEY                     (interview_id)
        )ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($sqltable_interview);
    }
    if ($wpdb->get_var('SHOW TABLES LIKE "%'.$table_test_details.'%"') != $table_test_details) {
        $sqltable_test_details = 'CREATE TABLE '.$table_test_details.'(
            test_id                     int not null,
            create_at                   datetime,
            updated_at                  datetime,
            test_content                text,
            PRIMARY KEY                 (test_id)
        )ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($sqltable_test_details);
    }

    if ($wpdb->get_var('SHOW TABLES LIKE "%'.$table_candidate.'%"') != $table_candidate) {
        $sqltable_candidate = 'CREATE TABLE '.$table_candidate.'(
            candidate_id            int not null,
            candidate_name          text not null,
            location                text not null,
            experience              float,
            desired_salary          float,
            stage                   text,
            tel                     text,
            email                   text,
            social_link             text,
            cv                      text,
            rating                  text,
            comment                 text,
            test_id                 int,
            test_mark               float,
            PRIMARY KEY             (candidate_id),
            FOREIGN KEY (test_id)   REFERENCES test_details(test_id)
        )ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($sqltable_candidate);
    }
    if ($wpdb->get_var('SHOW TABLES LIKE "%'.$table_jobs.'%"') != $table_jobs) {
        $sqltable_jobs = 'CREATE TABLE '.$table_jobs.'(
            job_id          int not null,
            name_job        text,
            des_job         text,
            PRIMARY KEY     (job_id)
        )ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($sqltable_jobs);
    }
    if ($wpdb->get_var('SHOW TABLES LIKE "%'.$table_candidates.'%"') != $table_candidates) {
        $sql = 'CREATE TABLE '.$table_candidates.'(
            id              int not null,
            candidate_id    int not null,
            job_id          int not null,
            test_mark       float,
            interview_id    int not null,
            PRIMARY KEY  (id),
            FOREIGN KEY (candidate_id)  REFERENCES candidate(candidate_id),
            FOREIGN KEY (test_mark)     REFERENCES candidate(test_mark),
            FOREIGN KEY (job_id)        REFERENCES jobs(job_id),
            FOREIGN KEY (interview_id)  REFERENCES interview(interview_id)
        )ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
?>