<!DOCTYPE html>
<?php 
  $post_type = 'blog';

  // $args = array(
  //   'post_type' => $post_type,
  //   'posts_per_page' => 4,
  //   'order' => 'ASC',
  // );

  // $query = new WP_Query($args);
?>

<html lang="ja">
  <?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php get_header(); ?>

  <main class="pt-15 py-lg-30 pb-lg-15">
    <div class="container">

      <div class="row justify-content-between">

        <div class="col-12 col-lg-9">

          <section>
            <h1 class="mb-0">ブログ一覧</h1>
            <ul class="p-taxonomy__items p-0 mt-6 gap-3 d-flex flex-wrap justify-content-between mt-md-10 gap-md-6">

            <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
              <li class="l-card__item">
                <a href="<?= the_permalink(); ?>" class="text-decoration-none d-flex flex-column gap-md-3">
                  <figure class="l-card__img-layout u-img__cover m-0">
                    <?= the_post_thumbnail(); ?>
                  </figure>
                  <div class="l-card__content mt-2 mt-md-0">
                    <h3 class="fs-6 fw-bold mb-0 lh-base"><?php the_title(); ?></h3>
                    <?php include( TEMPLATEPATH . '/components/date.php' ); ?>
                    <p class="l-card__text mt-1 mb-0"><?= wp_trim_words( get_the_content(), 40, '....【続きを読む】' ); ?></p>
                  </div>
                </a>
              </li>
            <?php endwhile; endif; wp_reset_postdata(); ?>

            </ul>
          </section>

          <div class="mt-10">
            <?php the_posts_pagination($args_pagination); ?>
          </div>

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