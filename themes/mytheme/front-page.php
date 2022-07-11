<?php
  $post_type = 'blog';
  $taxonomy = 'genre';
?>

<!doctype html>
<html lang="ja">
<?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body class="top-page">

  <?php get_header(); ?>

  <section class="p-fv pt-lg-20">
    <div class="position-relative">
      <figure class="u-img__cover p-fv__img-layout mb-0">
        <img src="<?= $img_path ?>/toppage/fv-salon.jpg" alt="男性が美容院で髪を切っている">
      </figure>
      <h1 class="p-fv__title mb-0 position-absolute text-white lh-base fw-bold ">メンズ美容サイト<br>きぬおブログ</h1>
    </div>
  </section>

  <div class="container">

    <div class="row justify-content-between">

      <div class="col-12 col-lg-9">

        <section class="p-newpost pt-15">
          <h1 class="c-heading__section mb-0">新着記事</h1>
          <ul class="l-card__items p-0 mt-6 mb-7 gap-3 d-flex flex-wrap justify-content-between gap-md-6 mb-md-15">

            <?php 
              $args = array(
                'post_type' => $post_type,
                'order' => 'ASC',
                'posts_per_page' => 3
              );
            
              $query = new WP_Query($args);
            
              if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
            ?>

            <li class="mb-0 p-newpost__item">
              <a href="<?= the_permalink(); ?>" class="text-decoration-none d-flex flex-column flex-md-row justify-content-md-between gap-md-3">
                <figure class="u-img__cover p-newpost__img-layout mb-0">
                  <?php the_post_thumbnail(); ?>
                </figure>
                <div class="p-newpost__content mt-2 mt-md-0">
                  <h3 class="mb-0 fw-bold lh-base"><?php the_title(); ?></h3>
                  <p class="p-newpost__description mt-1 mb-0"><?= wp_trim_words( get_the_content(), 40, '....【続きを読む】' ); ?></p>
                  <p class="c-date mt-1 mb-0"><?= get_the_date(); ?></p>
                </div>
              </a>
            </li>

            <?php endwhile; endif; ?>
          </ul>
          <a href="<?= home_url('/blog/'); ?>" class="c-btn btn-secondary p-3">他の新着記事をみる</a>
        </section>

        <section class="p-pickup pt-15 pb-lg-15">
          <h1 class="c-heading__section mb-0">おすすめ記事</h1>
          <ul class="l-card__items p-0 mt-6 mb-0 gap-3 d-flex flex-wrap justify-content-between gap-md-6">

            <?php 
              $args = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,
                'tax_query' => array(
                  array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => 'osusume'
                  )
                )
              );

              $query = new WP_Query($args);

              if( $query->have_posts() ) : while( $query->have_posts() ): $query->the_post();
            ?>

            <li class="l-card__item ">
              <a href="<?= the_permalink(); ?>" class="text-decoration-none d-flex flex-column flex-md-row gap-md-3">
                <figure class="l-card__img-layout u-img__cover mb-0">
                  <?php the_post_thumbnail(); ?>
                </figure>
                <div class="l-card__content mt-2 mt-md-0">
                  <h3 class="mb-0 fw-bold lh-base"><?php the_title(); ?></h3>
                  <p class="c-date mb-0"><?= get_the_date(); ?></p>
                </div>
              </a>
            </li>
            
            <?php endwhile; endif; ?>
            
          </ul>
        </section>

      </div>

      <div class="col-0 col-lg-3 my-10 mt-md-15 mt-lg-30">
        <?php get_sidebar('profile'); ?>
        <?php get_sidebar('category'); ?>
      </div>

    </div>

  </div>

  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>

</body>
</html>