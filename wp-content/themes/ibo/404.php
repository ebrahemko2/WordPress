<?php get_header(); ?>
<div class="container">
    <div class="page-not-found text-center">
        <img src="<?php echo get_template_directory_uri() . '/images/404.svg'; ?>" alt="Page Not Found" class="img-fluid mx-auto d-block w-75 mt-5">
        <h1 class="text-muted mt-3">Page Not Found</h1>
        <a type="button" class="btn btn-primary mt-4" href="<?php bloginfo('url'); ?>">Go To Home Page</a>
    </div>
</div>
<?php get_footer(); ?>