<!DOCTYPE html>
<html lang="ja">
<?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php include( TEMPLATEPATH . '/header.php' ); ?>
  <?php 

// $term = get_terms('genre');
// var_dump($term);

$args = array(
  'post_type' => 'blog',
  'order' => 'ASC',
  'tax_query' => array(
    array(
      'taxonomy' => 'genre',
      'field' => 'slug',
      'terms' => array( 'gadget' )
    )
  )
);

$the_query = new WP_Query($args); 

if( $the_query->have_posts() ) : while( $the_query->have_posts() ) : $the_query->the_post();
?>
  <a  href="<?= the_permalink(); ?>">
    <h2 class="pt-15"><?php the_title(); ?></h2>
  </a>

<?php
endwhile; else : echo 'null'; endif;

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
<?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>