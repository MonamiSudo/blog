<?php
  $nav_args = array(
    'theme_location' => 'header',
    'container' => 'nav', // ul（ナビ）を何で囲むか
    'container_class' => 'l-header__nav', // ulの親のクラス
    'menu_class' => 'l-header__items', // ulのクラス
  );
?>

<header class="l-header position-fixed w-100 bg-white">
  <div class="u-wrapper__1152 l-header-wrapper d-flex align-items-center justify-content-between">
    <h1 class="mb-0">きぬおブログ</h1>
    <?php 
      wp_nav_menu($nav_args);
    ?>
  </div>
</header>