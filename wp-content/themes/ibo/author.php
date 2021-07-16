<?php get_header(); ?>
<?php //Declare avatar arguments
$avatar_arguments = array(
    'class' => 'img-fluid img-thumbnail mt-5  mx-auto d-block'
);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <header class="card p-5 mt-5">
                <?php echo get_avatar(get_the_author_meta('ID'), 196, '', 'User Avatar', $avatar_arguments); ?>
                <h1 class="h5 mt-4 text-primary">(<?php the_author_meta('nickname'); ?>)</h1>
                <h2 class="h4"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></h2>
                <hr />
                <?php if (get_the_author_meta('description')) : ?>
                    <p class="mt-3 text-muted"><?php the_author_meta('description'); ?></p>
                <?php endif; ?>
            </header>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center p-4 author-stats my-3">
                <p>
                    <i class="fas fa-scroll fa-3x text-primary-light"></i>
                </p>
                <h3 class="fw-normal my-3">Posts</h3>
                <p class="text-secondary h1">
                    <?php
                    if (!count_user_posts(get_the_author_meta('ID'))) {
                        echo "0";
                    } else {
                        echo count_user_posts(get_the_author_meta('ID'));
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4 author-stats my-3">
                <p>
                    <i class="fas fa-comment fa-3x text-primary-light"></i>
                </p>
                <h3 class="fw-normal my-3">Comments</h3>
                <p class="text-secondary h1">
                    <?php
                    $comment_count_args = array(
                        'count' => true,
                        'user_id' => get_the_author_meta('ID')
                    );
                    if (!get_comments($comment_count_args)) {
                        echo "0";
                    } else {
                        echo get_comments($comment_count_args);
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-4 author-stats my-3">
                <p>
                    <i class="fas fa-eye fa-3x text-primary-light"></i>
                </p>
                <h3 class="fw-normal my-3">Views</h3>
                <p class="text-secondary h1">1435</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2 class="alert alert-secondary border-0 h4 mt-5" role="alert">
                Latest Posts
            </h2>
            <?php
            $author_posts_arguments = array(
                'author' => get_the_author_meta('ID'),
                'posts_per_page' => 5
            );
            $author_posts_query = new WP_Query($author_posts_arguments);
            if ($author_posts_query->have_posts()) : //check if have posts
                while ($author_posts_query->have_posts()) : $author_posts_query->the_post(); //loop through the posts 
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
                echo '<p class="alert alert-light border-0" role="alert">There is no articles for this author yet.</p>';
            endif;
            wp_reset_postdata(); // End if
            ?>

            <h2 class="alert alert-secondary border-0 h4 mt-5" role="alert">
                Latest Comments
            </h2>
            <?php
            $author_comments_arguments = array(
                'user_id' => get_the_author_meta('ID'),
                'number' => 4,
                'status' => 'approve',
                'post_status' => 'publish',
                'post_type' => 'post'
            );

            $comments = get_comments($author_comments_arguments);
            ?>

            <div class="row">
                <?php
                if ($comments) :
                    foreach ($comments as $comment) :
                ?>

                        <!-- echo "<h4>" . get_the_title($comment->comment_post_ID) . "</h4>";
                echo "<p>" . $comment->comment_content . "</p>"; -->

                        <div class="col-md-6">
                            <div class="card mb-3 p-3">
                                <h3 class="h6 text-muted">
                                    <?php echo get_the_title($comment->comment_post_ID); ?>
                                </h3>
                                <p>
                                    <?php echo $comment->comment_content; ?>
                                </p>
                            </div>
                        </div>

                <?php endforeach;
                else :
                    echo '<div class="col"><p class="alert alert-light border-0" role="alert">There is no comments for this author yet.</p></div>';
                endif;
                ?>
            </div>

        </div>
    </div>

</div>



<?php get_footer(); ?>