<?php
    $countphone = 0;
    $countscreen = 0;
    $countoffice = 0;
    $countmakeoffer = 0;
    $count_posts = wp_count_posts( 'candidate' )->publish;
    $posts = get_posts(array(
        'posts_per_page'    => -1,
        'post_type'         => 'candidate'
    ));
    $postslist = new WP_Query($posts);



    if( $posts ) {
        foreach ( $posts as $post) {
            $postid = $post->ID;
            $stage  = get_field('stage',$postid);
            $stage = strtolower(preg_replace('/\s+/', '', $stage));
            switch ($stage) {
                case 'phoneinterview':
                    $countphone++;
                    break;
                case 'in-officeinterview':
                    $countoffice++;
                    break;
                case 'makeanoffer':
                    $countmakeoffer++;
                    break;
                case 'screening':
                    $countscreen++;
                    break;
                default:
                    echo "This stage not exist!";
            }
        }
    }
?>
<div class="candidates">
    <div class="wrap col-xs-12 title-candidates">
        <h1><?php _e( 'Candidates', 'vacancy' ); ?></h1>
    </div>
    <div class="d-flex row">
            <div class="menu-cadidates col-md-2">
                <ul class="d-flex flex-column">
                    <li class="d-flex">
                        Overview
                    </li>
                    <li class="d-flex">
                        Shorted-List
                    </li>
                    <li class="d-flex">
                        Hired
                    </li>
                    <li class="d-flex">
                        Rejected
                    </li>
                </ul>
            </div>
            <div class="content-candidates col-md-10">
                <div class="menu-interviews">
                    <ul class="d-flex flex-row">
                        <li class="d-flex flex-column menu-interview">
                            <span>
                                <?php if ($count_posts <= 0 ){ $count_posts = 0 ; echo $count_posts; }else{ echo $count_posts; } ?>
                            </span>
                            total candidates
                        </li>
                        <li class="d-flex flex-column menu-interview">
                            <span><?= $countscreen ?></span>
                            screening
                        </li>
                        <li class="d-flex flex-column menu-interview">
                            <span><?= $countphone ?></span>
                            in-office interview
                        </li>
                        <li class="d-flex flex-column menu-interview">
                            <span><?= $countoffice ?></span>
                            Testing
                        </li>
                        <li class="d-flex flex-column menu-interview">
                            <span><?= $countmakeoffer ?></span>
                            make an offer
                        </li>
                    </ul>
                </div>
                <div class="table-show-candidates">
                    <div class="control">
                        <a href="" class="btn btn-bulk">Bulk</a>
                        <a href="" class="btn btn-apply">Apply</a>
                        <select name="" id="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                        <a href="" class="btn btn-filter">Filter</a>
                    </div>
                    <div class="table">
                        <table>
                            <tr>
                                <th id="date">Date</th>
                                <th id="name">Name</th>
                                <th id="rating">Rating</th>
                                <th id="applied_position">Applied Position</th>
                                <th id="stage">Stage</th>
                                <th id="action">Action</th>
                            </tr>
                            <?php if( $posts ): foreach ( $posts as $post): $postid = $post->ID; ?>
                            <tr>
                                <td><?php
                                    $date = $post->post_modified;
                                    $createDate = new DateTime($date);
                                    $strip = $createDate->format('d-m-Y');
                                    echo $strip; // string(10) "2012-09-09"
                                ?></td>
                                <td><?= get_field('candidate_name',$postid); ?></td>
                                <td><?= get_field('rating',$postid); ?></td>
                                <td><?= get_field('applied_position',$postid); ?></td>
                                <td><?= get_field('stage',$postid); ?></td>
                                <td><a href="<?= get_permalink($postid) ?>">view</a></td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>