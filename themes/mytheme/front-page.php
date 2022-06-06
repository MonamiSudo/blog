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

      <div class="col-8">

        <section class="p-newpost py-10">
          <div class="u-wrapper__1152">
            <h1 class="mb-0">新着記事</h1>
            <ul class="p-0 mt-4 mb-10 mt-md-15">
              <?php 
                $args = array(
                  'post_type' => $post_type,
                  'order' => 'ASC'
                );
              
                $query = new WP_Query($args);
              
                if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
              ?>
              <li>
                <a href="" class="text-decoration-none">
                  <figure class="u-img__cover p-newpost__img-layout">
                    <?php the_post_thumbnail(); ?>
                  </figure>
                  <h2><?php the_title(); ?></h2>
                  <p><?= get_the_date(); ?></p>
                  <p><?php the_content(); ?></p>
                </a>
              </li>
              <?php endwhile; endif; ?>
            </ul>
            <a href="/" class="c-btn py-4 px-3">他の新着記事をみる</a>
          </div>
        </section>

      </div>

      <div class="col-4 mt-10 mt-md-15">
        <?php get_sidebar('profile'); ?>
        <?php get_sidebar('category'); ?>
      </div>

    </div>

  </div>

  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>