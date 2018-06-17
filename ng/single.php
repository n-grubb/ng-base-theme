<?php get_sidebar() ?>

<main id="page-body" <?php post_class('page-body'); ?>>
<?php if( have_posts() ): while( have_posts() ): the_post(); ?>

    <header class="masthead" id="masthead">
        <h2><?php the_title() ?></h2>
    </header>
    <section class="page-content">
        <!-- Archive loops -->
        <?php the_content() ?>
    </section>

<?php endwhile; endif; ?>
</main>
