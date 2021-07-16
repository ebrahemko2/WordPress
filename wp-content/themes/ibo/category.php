<?php
/*
    ** This function get the header
    ** But you can delete it without problem
    */
get_header();
?>


<div class="category-page container mt-5">
    <div class="alert alert-secondary border-0 mt-5 category-header" role="alert">
        <h1 class="h2">
            <?php echo single_cat_title('', false) . " Articles"; ?>
        </h1>
        <div class="category-description">
            <?php echo category_description(); ?>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-9">
            <?php
            if (have_posts()) : //check if have posts
                while (have_posts()) : the_post(); //loop through the posts 
            ?>
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
            <?php
                endwhile; //End Wihle loop
            endif; // End if
            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
        </div>
        <!-- Start Sidebar -->
        <div class="col-lg-3">
            <div class="sidebar-container mt-3">
                <?php
                // if (is_active_sidebar('main-sidebar')) :
                //     dynamic_sidebar('main-sidebar');
                // endif;
                get_sidebar();
                ?>
            </div>
        </div>
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