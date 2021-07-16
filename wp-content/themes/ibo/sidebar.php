<div class="first-widget mb-3">
    <h3 class="alert alert-secondary border-0 mb-0 rounded-0 h5" role="alert">Start From Here</h3>
    <div class="card border-0 rounded-0 p-3">
        <p>If you are fresh learner please start from here then go to newer articles.</p>
        <?php
        $first_five_posts_query_args = array(
            'posts_per_page' => 5,
            'cat' => get_queried_object()->term_id,
            'order' => 'ASC',
            'orderby' => 'modified'

        );

        $first_five_posts_query = new WP_Query($first_five_posts_query_args);
        ?>
        <ul class="list-unstyled">
            <?php
            if ($first_five_posts_query->have_posts()) : while ($first_five_posts_query->have_posts()) :
                    $first_five_posts_query->the_post();
            ?>
                    <li class="mb-2">
                        <a href="<?php the_permalink(); ?>" class="text-primary">
                            <?php the_title(); ?>
                        </a>
                    </li>
            <?php
                endwhile;
            endif;
            ?>
        </ul>
    </div>
</div>

<div class="second-widget mb-3">
    <h3 class="alert alert-secondary border-0 mb-0 rounded-0 h5" role="alert">Statistics</h3>
    <div class="card border-0 rounded-0">
        <ul class="list-unstyled p-3 text-muted">
            <li class="mb-2">
                Number of comments: <span class="badge bg-secondary"><?php ibo_comments_num_for_curr_cat(); ?></span>
            </li>
            <li>
                Number of posts: <span class="badge bg-secondary"><?php echo get_queried_object()->count; ?></span>
            </li>
        </ul>
    </div>
</div>