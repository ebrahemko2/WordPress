<?php
$all_categories = get_the_category();
$first_category_ID = $all_categories[0]->cat_ID;
$first_category_name = $all_categories[0]->name;
?>

<div class="breadcrumb-container mt-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="bg-white p-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?php bloginfo('url'); ?>" class="text-primary">
                        <?php bloginfo('name'); ?>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo get_category_link($first_category_ID); ?>" class="text-primary">
                        <?php echo $first_category_name; ?>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php the_title(); ?>
                </li>
            </ol>
        </nav>
    </div>
</div>