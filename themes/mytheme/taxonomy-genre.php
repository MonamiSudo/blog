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

        <section class="pt-30">
          <h1 class="mb-0">スキンケア</h1>
          <ul class="p-taxonomy__items p-0 mt-10 d-flex flex-wrap justify-content-between">

          <?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>
            <li class="p-taxonomy__item">
              <a href="<?= the_permalink(); ?>">
                <figure class="p-taxonomy-img__layout m-0">
                  <?= the_post_thumbnail(); ?>
                </figure>
                <h3 class="fs-6 mt-3 mb-0"><?php the_title(); ?></h3>
                <p class="p-taxonomy__date mb-0 mt-1 text-primary"><?= get_the_date(); ?></p>
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