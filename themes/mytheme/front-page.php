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
      <figure class="p-fv__img-layout mb-0">
        <img class="u-img__cover" src="<?= $img_path ?>/toppage/fv-salon.jpg" alt="男性が美容院で髪を切っている">
      </figure>
      <h1 class="p-fv__title mb-0 position-absolute text-white lh-base fw-bold ">メンズ美容サイト<br>きぬおブログ</h1>
    </div>
  </section>
  <section class="p-newpost">
    <div class="u-wrapper__1152">
      <h1 class="mt-10">新着記事</h1>
      <ul>
        <?php 
          $args = array(
            'post_type' => $post_type,
            'order' => 'ASC'
          );

          $query = new WP_Query($args);

          if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
        ?>

        <li>
          <a href="">
            <figure>
              <?php the_post_thumbnail(); ?>
            </figure>
            <h2><?php the_title(); ?></h2>
            <p><?php the_content(); ?></p>
          </a>
        </li>

        <?php endwhile; endif; ?>
      </ul>
    </div>
  </section>
  <?php include( TEMPLATEPATH . '/components/footer.php' ); ?>
</body>
</html>