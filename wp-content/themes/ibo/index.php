<?php
/*
    ** This function get the header
    ** But you can delete it without problem
    */
get_header();
?>


<div class="home-page container mt-5">
    <h1 class="alert alert-secondary border-0 mt-5 h2 category-header" role="alert">
        Latest Articles
    </h1>
    <div class="row g-4">
        <?php
        if (have_posts()) : //check if have posts
            while (have_posts()) : the_post(); //loop through the posts 
        ?>
                <div class="col-lg-6">
                    <div class="post card p-3 border-0">
                        <h3 class="post-title h4 fw-bold">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <ul class="post-header list-unstyled text-muted d-flex">
                            <li class="me-3"><i class="far fa-user me-1"></i><?php the_author_posts_link(); ?></li>
                            <li class="me-3"><i class="far fa-calendar me-1"></i><?php the_time('Y/m/d'); ?></li>
                            <li>
                                <i class="far fa-comment me-1"></i>
                                <?php comments_popup_link('0 Comments', '1 Comment', '% Comments', 'link', 'Comments Disabled'); ?>
                            </li>
                        </ul>
                        <?php the_post_thumbnail('large', array("class" => "img-fluid img-thumbnail mb-3", "title" => "Post Image", "alt" => get_the_title())); ?>
                        <?php the_excerpt(); ?>
                        <a href="<?php echo get_permalink(); ?>" class="btn btn-outline-primary" role="button">Continue Reading</a>
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
                </div>
        <?php
            endwhile; //End Wihle loop
        endif; // End if
        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div>
</div>

<nav aria-label="Page navigation" class="mt-5 text-center">
    <ul class="articles-pagination">
        <?php echo ibo_custom_pagination(); ?>
    </ul>
</nav>

<?php
/*
    ** This function get the footer with all scripts that very important for your theme to be round
    ** Don't delete this function it's very important for theme to be run without any problem
    */
get_footer();
?>