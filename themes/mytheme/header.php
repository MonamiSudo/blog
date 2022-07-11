<?php
  $nav_args = array(
    'theme_location' => 'header',
    'container' => 'nav', // ul（ナビ）を何で囲むか
    'container_class' => 'l-header__nav', // ulの親のクラス
    'menu_class' => 'l-header__items', // ulのクラス
  );

  $nav_sp_args = array(
    'theme_location' => 'header',
    'container' => 'nav', // ul（ナビ）を何で囲むか
    'container_class' => 'l-header-sp__nav', // ulの親のクラス
    'menu_class' => 'l-header-sp__items', // ulのクラス
  );
?>

<header class="l-header d-none d-lg-block shadow-sm position-fixed w-100 bg-white">
  <div class="u-wrapper__1152 l-header-wrapper d-flex align-items-center justify-content-between">
    <h1 class="mb-0"><a href="<?= home_url('/'); ?>">ホーム</a></h1>
    <?php 
      wp_nav_menu($nav_args);
    ?>
  </div>
</header>

<!-- ハンバーガーメニュー -->

<section class="l-header-sp">
  
  <ul class="l-header-sp__lines m-0">
    <li class="l-header-sp__line shadow-sm">
      <span class="l-header-sp__line-element"></span>
      <span class="l-header-sp__line-element line2"></span>
      <span class="l-header-sp__line-element line3"></span>
    </li>
  </ul>

  <div class="l-header-sp__menus position-absolute bg-white zindex-modal-backdrop">
    <?php wp_nav_menu($nav_sp_args); ?>
  </div>

</section>
