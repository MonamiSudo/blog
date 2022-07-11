<!DOCTYPE html>
<html lang="ja">
  <?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body>
  <?php include( TEMPLATEPATH . '/header.php' ); ?>
  
  <?php 
    $uri = rtrim($_SERVER["REQUEST_URI"], '/');
    $uri = substr($uri, strrpos($uri, '/') + 1); // URL末尾のパス（ターム）を取得

    $args = array(
      'post_type' => 'blog',
      'opsts_per_page' => 8,
      'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => 'genre',
          'field'    => 'slug',
          'terms'    => $uri,
        )
      )
    );

    $query = new WP_Query($args);
  ?>

  <main>

    <div class="container">

      <div class="row justify-content-between">

        <div class="col-12 col-lg-8">

        <section class="pt-15 pt-lg-30">
          <h1 class="mb-0">スキンケア</h1>
          <ul class="p-taxonomy__items p-0 mt-6 gap-3 d-flex flex-wrap justify-content-between mt-md-10 gap-md-6">

          <?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>
            <li class="l-card__item">
              <a href="<?= the_permalink(); ?>" class="text-decoration-none d-flex flex-column flex-md-row gap-md-3">
                <figure class="l-card__img-layout u-img__cover m-0">
                  <?= the_post_thumbnail(); ?>
                </figure>
                <div class="l-card__content mt-2 mt-md-0">
                  <h3 class="fs-6 fw-bold mb-0"><?php the_title(); ?></h3>
                  <p class="c-date mb-0 mt-1 text-primary"><?= get_the_date(); ?></p>
                  <p class="l-card__text mt-1 mb-0"><?= wp_trim_words( get_the_content(), 40, '....【続きを読む】' ); ?></p>
                </div>
              </a>
            </li>
          <?php endwhile; endif; the_posts_pagination($args_pagination); wp_reset_postdata(); ?>

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