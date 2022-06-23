<!DOCTYPE html>
<html lang="ja">
  <?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php include( TEMPLATEPATH . '/header.php' ); ?>
  <main>
    <section class="pt-20">
      <h1>taxonomy-genre-skincare.php</h1>
      <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <a href="<?= the_permalink(); ?>">
          <h2><?php the_title(); ?></h2>
          <p><?php the_content(); ?></p>
        </a>
      <?php endwhile; endif; ?>
    </section>
  </main>
  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>