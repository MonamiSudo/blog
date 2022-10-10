<?php 
$theme_path = get_template_directory_uri();
$img_path = $theme_path . '/assets/images';
?>

<section class="p-profile py-6 px-4">
  <picture class="u-img__cover p-sb-prof__img-layout d-block rounded-circle m-auto">
    <source type="image/type" srcset="<?= $img_path ?>/icon/me.webp">
    <img class="rounded-circle" src="<?= $img_path ?>/icon/me.JPG" alt="サイト運営者のアイコン">
  </picture>
  <h1 class="text-center mt-3 mb-0">きぬお</h1>
  <p class="mt-3 mb-0 lh-lg u-ls-05" style="font-size:15px;">メンズ美容ブログを運営している「きぬお」と申します。社会人になり、様々な方と対面で話すことが増えました。そのため、元々肌が弱かったこともあり、自分自身の容姿を改善したいと思いました。メンズだけれども、美容やお洒落に気を使いたい！と思ったのがブログを始めたきっかけです。</p>
</section>