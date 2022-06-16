<?php
  $post_type = 'blog';
?>

<!doctype html>
<html lang="ja">
<?php include( TEMPLATEPATH . '/components/head.php' ); ?>
<body class="top-page">

  <?php get_header(); ?>

  <section class="p-fv pt-20">
    <div class="position-relative">
      <figure class="u-img__cover p-fv__img-layout mb-0">
        <img src="<?= $img_path ?>/toppage/fv-salon.jpg" alt="男性が美容院で髪を切っている">
      </figure>
      <h1 class="p-fv__title mb-0 position-absolute text-white lh-base fw-bold ">メンズ美容サイト<br>きぬおブログ</h1>
    </div>
  </section>

  <div class="container">

    <div class="row">

      <div class="col-12 col-lg-8">

        <section class="p-newpost py-10 py-md-15">
          <h1 class="c-heading__section mb-0">新着記事</h1>
          <ul class="p-0 mt-6 mb-10">
            <?php 
              $args = array(
                'post_type' => $post_type,
                'order' => 'ASC'
              );
            
              $query = new WP_Query($args);
            
              if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
              // var_dump( $query->posts[0] );
              var_dump( the_content() );
              // var_dump( $query->posts->post_content );
            ?>
            <li class="mb-4">
              <a href="" class="text-decoration-none d-flex flex-column flex-md-row gap-md-6">
                <figure class="u-img__cover p-newpost__img-layout">
                  <?php the_post_thumbnail(); ?>
                </figure>
                <div class="p-newpost__content">
                  <h2><?php the_title(); ?></h2>
                  <p><?= get_the_date(); ?></p>
                  <p><?php the_content(); ?></p>
                </div>
              </a>
            </li>
            <?php endwhile; endif; ?>
          </ul>
          <a href="/" class="c-btn py-4 px-3">他の新着記事をみる</a>
        </section>

        <section class="p-pickup py-10 py-md-15">
          <h1 class="c-heading__section mb-0">おすすめ記事</h1>
        </section>

      </div>

      <div class="col-0 col-lg-4 mt-10 mt-md-15">
        <?php get_sidebar('profile'); ?>
        <?php get_sidebar('category'); ?>
      </div>

    </div>

  </div>

  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>