<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
<style>
body.with-sidebar{
    display: unset;
}
</style>
<main style="margin: 200px auto; max-width: 900px">
 <h2><?php the_title(); ?></h2>

 <p><?php the_content(); ?></p>
</main>
 <?php endwhile; endif; 

 get_footer(); ?>