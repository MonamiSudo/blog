<?php 
  $theme_path = get_template_directory_uri();
  $img_path = $theme_path . '/assets/images';

  $post_type = 'blog';
  $taxonomy = 'genre';
  $terms = get_terms($taxonomy);
?>

<section class="mt-10">
  <h3 class="bg-primary text-white p-2">記事カテゴリ一覧</h3>
  <ul class="p-0 mt-4 d-flex flex-column gap-3">

<?php
  foreach( $terms as $term ) :

  $args = array(
    'post_type' => $post_type,
    'orderby' => 'ID',
    'order' => 'DESC',
    'tax_auery' => array(
      array(
        'taxonomy' => $taxonomy,
        'field' => 'slug',
        'terms' => $term->slug
      )
    )
  );
?>
    <?php if( $term->count !== 0 ) : ?>
    <li>
      <a class="d-flex align-items-center gap-2" href="<?= home_url('/' . $term->slug); ?>">
        <figure class="p-sb-category__folder u-img__cover my-auto">
          <img src="<?= $img_path ?>/icon/folder.svg" alt="フォルダのアイコン">
        </figure>
        <p class="mb-0 mx-1"><?= $term->name ?>（<?= $term->count ?>）</p>
      </a>
    </li>
    <?php endif; ?>

<?php
  endforeach;
?>

  </ul>
</section>