<?php 

// $term = get_terms('genre');
// var_dump($term);

// $args = array(
//   'post_type' => 'blog',
//   'order' => 'ASC'
// );

// $query = new WP_Query($args); 

// var_dump($query);

if( have_posts() ) : while( have_posts() ) : the_post();
?>
  <h2><?php the_title(); ?></h2>
  <p><?php $post->ID ?></p>
<?php
endwhile; endif;

print_r(get_queried_object());
?>

<ul>

<?php // while( $query->have_posts() ): the_post(); ?>

<!-- <li>
  <h2><?php the_title(); ?></h2>
  <p><?php the_permalink(); ?></p>
  <p><?php the_content(); ?></p>
</li> -->

<?php // endwhile; ?>

</ul>