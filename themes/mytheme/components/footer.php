<?php 
  $args = array(
    'theme_location' => 'footer',
    'container_class' => 'l-footer__nav',
    'container' => 'nav',
    'menu_class' => 'l-footer__items',
  );
?>

<footer class="l-footer">
  <h2 class="text-center m-0 pt-10">Kinuo Blog</h2>
  <?php wp_nav_menu($args); ?>
  <small class="d-block bg-primary py-1 text-center ">© 2022 Kinuo Blog.</small>
</footer>

<script src="<?= $theme_path ?>/assets/dist/main.js"></script>
<?php wp_footer(); ?>