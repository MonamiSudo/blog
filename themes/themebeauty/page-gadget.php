<!DOCTYPE html>
<html lang="ja">
<?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php get_header(); ?>

  <main class="pt-20">

    <div class="container">

      <div class="row justify-content-between">

        <div class="col-12 col-lg-8">

          <section class="p-newpost py-10 py-md-15">
            <h1 class="c-heading__section mb-0">新着記事</h1>
            <?php include( TEMPLATEPATH . '/taxonomy-genre-gadget.php' ); ?>
          </section>

        </div>

        <div class="col-0 col-lg-3 mt-10 mt-md-15">
          <?php get_sidebar('profile'); ?>
          <?php get_sidebar('category'); ?>
        </div>

      </div>

    </div>

  </main>

  <?php include( TEMPLATEPATH . '/components/head.php' ); ?>
</body>
</html>