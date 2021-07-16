<?php
/*
    ** This function get the header
    ** But you can delete it without problem
    */
get_header();
include(get_template_directory() . "/includes/breadcrumb.php");
?>


<div class="single-post container mt-5">
    <?php
    if (have_posts()) : //check if have posts
        while (have_posts()) : the_post(); //loop through the posts 
    ?>
            <div class="post card p-3 border-0">
                <?php edit_post_link('<i class="fas fa-edit"></i> Edit', '', '', null, 'edit-btn text-end ms-auto'); ?>
                <h3 class="post-title h4 fw-bold mb-3">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <ul class="post-header list-unstyled text-muted d-flex">
                    <li class="me-3"><i class="far fa-calendar me-1"></i><?php the_time('Y/m/d'); ?></li>
                    <li>
                        <i class="far fa-comment me-1"></i>
                        <?php comments_popup_link('0 Comments', '1 Comment', '% Comments', 'link', 'Comments Disabled'); ?>
                    </li>
                </ul>
                <?php the_post_thumbnail('large', array("class" => "img-fluid img-thumbnail mb-3", "title" => "Post Image", "alt" => get_the_title())); ?>
                <p class="post-content">
                    <?php the_content(); ?>
                </p>
                <hr>
                <div class="d-flex justify-content-between">
                    <ul class="list-unstyled d-flex text-secondary categories">
                        <li class="me-1"><i class="fas fa-folder"></i></li>
                        <li class="ms-1">
                            <?php the_category(', '); ?>
                        </li>
                    </ul>
                    <ul class="list-unstyled d-flex text-muted tags">
                        <?php
                        if (has_tag()) {
                            the_tags('<li class="me-1"><i class="fas fa-tags text-secondary"></i></li>');
                        } else {
                            echo '<p>There is no tags</p>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
    <?php
        endwhile; //End Wihle loop
    endif; // End if
    ?>

    <?php //Declare avatar arguments
    $avatar_arguments = array(
        'class' => 'img-fluid img-thumbnail me-3'
    );
    ?>

    <?php if (get_the_author_meta('description')) : ?>
        <div class="accordion mt-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <?php echo get_avatar(get_the_author_meta('ID'), 64, '', 'User Avatar', $avatar_arguments); ?>
                        <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?> (<?php the_author_meta('nickname'); ?>)
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?php the_author_meta('description'); ?></p>
                        <p class="fw-bold">
                            Profile link: <a class="btn btn-outline-primary btn-sm" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" role="button"><?php the_author(); ?></a>
                        </p>
                        <p class="fw-bold">
                            User Posts: <span class="badge bg-secondary fw-normal"><?php echo count_user_posts(get_the_author_meta('ID')); ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php
    else :
        echo '<p class="alert alert-light border-0 mt-5" role="alert">There is no bio for this author.</p>';
    endif;
    ?>


    <div class="pagnination-links text-center mt-5 d-flex justify-content-between">
        <?php
        if (get_previous_post_link()) {
            previous_post_link('%link', '<i class="fas fa-chevron-left"></i> Newer', true, '', 'category');
        }
        ?>
        <?php
        if (get_next_post_link()) {
            next_post_link('%link', 'Older <i class="fas fa-chevron-right"></i>', true, '', 'category');
        }
        ?>
    </div>
    <hr class="my-5" />
    <?php comments_template(); ?>
    <hr class="my-5" />
    <?php
    //Get the current post id => get_queried_object_id()
    //Get the current post categories => wp_get_post_categories(get_queried_object_id())
    //The Related Posts Query Arguments
    $related_posts_arguments = array(
        'category__in' => wp_get_post_categories(get_queried_object_id()),
        'post_status' => array('publish'),
        'orderby' => 'rand',
        'posts_per_page' => 6,
        'post_type' => 'post',
        'post__not_in' => array(get_queried_object_id()),
    );
    //The Related Posts Query
    $related_posts_query = new WP_Query($related_posts_arguments);
    ?>
    <h3 class="alert alert-secondary border-0 h4 mt-5" role="alert">Related Articles</h3>
    <?php
    if ($related_posts_query->have_posts()) : //check if have posts
        while ($related_posts_query->have_posts()) : $related_posts_query->the_post(); //loop through the posts 
    ?>
            <div class="col">
                <div class="card p-3 mt-3">
                    <div class="d-flex align-items-center author-post">
                        <div class="flex-grow-1 me-3">
                            <strong class="d-inline-block mb-2 text-primary text-decoration-none">
                                <?php the_category(', '); ?>
                            </strong>
                            <h3 class="mb-0">
                                <?php the_title(); ?>
                            </h3>
                            <div class="mb-1 text-muted">
                                <?php the_time('M d'); ?>
                            </div>
                            <?php the_excerpt(); ?>
                            <a href="<?php echo get_permalink(); ?>" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="flex-shrink-0 col-auto d-none d-lg-block">
                            <?php the_post_thumbnail('medium', array("class" => "img-fluid", "title" => "Post Image", "alt" => get_the_title())); ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        endwhile; //End Wihle loop
    else :
        echo '<p class="alert alert-light border-0" role="alert">There is no related articles.</p>';
    endif;
    wp_reset_postdata(); // End if
    ?>
</div>




<?php
/*
    ** This function get the footer with all scripts that very important for your theme to be round
    ** Don't delete this function it's very important for theme to be run without any problem
    */
get_footer();
?>