<!DOCTYPE html>
<html lang="ja">
<?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php include( TEMPLATEPATH . '/header.php' ); ?>
  <main class="pt-20">
    <h1>single-blog</h1>
    <p><?php the_content(); ?></p>
  </main>
  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>