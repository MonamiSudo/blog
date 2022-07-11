<!DOCTYPE html>
<html lang="ja">
<?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php include( TEMPLATEPATH . '/header.php' ); ?>
  <main class="">
    <div class="container">

      <div class="row justify-content-evenly">

        <div class="col-12 col-lg-7">

          <section class="pt-15 pt-lg-30">
            <h1 class="mb-0 fw-bold"><?php the_title(); ?></h1>
            <p class="p-single__date mt-1 mb-0"><?= get_the_date(); ?></p>
            <figure class="p-single__img-layout mt-6 mt-lg-10">
              <?php the_post_thumbnail(); ?>
            </figure>
            <div class="p-single__container mt-6 lh-lg mt-lg-10"><?php the_content(); ?></div>
          </section>

        </div>

        <div class="col-0 col-lg-3 my-10 mt-md-15 mt-lg-30">
          <?php get_sidebar('profile'); ?>
          <?php get_sidebar('category'); ?>
        </div>
      
      </div>

    </div>
  </main>
  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>