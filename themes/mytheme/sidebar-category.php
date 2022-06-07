<?php 
  $theme_path = get_template_directory_uri();
  $img_path = $theme_path . '/assets/images';

  $post_type = 'blog';
  $taxonomy = 'genre';
  $terms = get_terms($taxonomy);
?>

<section class="mt-10">
  <h2>記事カテゴリ一覧</h2>
  <ul class="p-0 mt-4 d-flex flex-column gap-3">

<?php
  foreach( $terms as $term ) :

  $args = array(
    'post_type' => $post_type,
    'order' => 'ASC',
    'tax_auery' => array(
      array(
        'taxonomy' => $taxonomy,
        'field' => 'slug',
        'terms' => $term->slug
      )
    )
  );
?>

    <li>
      <a class="d-flex align-items-center gap-2" href="<?= home_url('/' . $term->slug); ?>">
        <figure class="p-sb-category__folder u-img__cover mr-3 my-auto">
          <img src="<?= $img_path ?>/icon/folder.png" alt="フォルダのアイコン">
        </figure>
        <p class="mb-0"><?= $term->name ?>（<?= $term->count ?>）</p>
      </a>
    </li>

<?php
  endforeach;
?>

  </ul>
</section>

<!-- <section class="mt-10">
  <h1>記事カテゴリ一覧</h1>
  <ul>
    <li class="">フェイスケア</li>
    <li class="">ゴリゴリ</li>
  </ul>
</section> -->