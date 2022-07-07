<!DOCTYPE html>
<html lang="ja">
  <?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php include( TEMPLATEPATH . '/header.php' ); ?>
  <main>

    <div class="container">

      <div class="row justify-content-between">

        <div class="col-12 col-lg-8">

        <section class="pt-20">
          <h1>スキンケアの記事一覧</h1>
          <p>taxonomy-genre-skincare.php</p>
          <ul class="p-0">

          <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <li>
              <a href="<?= the_permalink(); ?>">
                <figure class="p-taxonomy-img__layout">
                  <?= the_post_thumbnail(); ?>
                </figure>
                <h2><?php the_title(); ?></h2>
                <!-- <p><?php the_content(); ?></p> -->
              </a>
            </li>
          <?php endwhile; endif; ?>

          </ul>
        </section>

        </div>

        <div class="col-0 col-lg-3 my-10 mt-md-15">
          <?php get_sidebar('profile'); ?>
          <?php get_sidebar('category'); ?>
        </div>
      
      </div>

    </div>

  </main>
  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>