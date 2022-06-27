<!DOCTYPE html>
<html lang="ja">
  <?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php include( TEMPLATEPATH . '/header.php' ); ?>
  <main>
    <h1>archive-blog.php</h1>
    <ul>

      <?php 
        if( have_posts() ) : while( have_posts() ) : the_post();
      ?>
        <li>
          <a href="<?= the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
          </a>
        </li>
      <?php 
        endwhile; endif;
      ?>

    </ul>
  </main>
  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>