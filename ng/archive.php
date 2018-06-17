<?php get_sidebar() ?>

<main id="page-body" <?php post_class('page-body'); ?>>
    <header class="masthead" id="masthead">
    </header>
    <section class="page-content">
        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>

        <article>
            <!-- Archive loops -->
            <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <?php the_content() ?>
        </article>

        <?php endwhile; endif; ?>
    </section>
</main>
