// ハンバーガーメニュー開閉

export const HumburgerToggle = () => {

  const bodyElement = document.getElementsByTagName('body'); // body

  const toggleTarget = document.querySelector('.l-header-sp__menus'); // メニュー自体

  const line1 = document.querySelector('.line1'); // ハンバーガーライン
  const line2 = document.querySelector('.line2'); // ハンバーガーライン
  const line3 = document.querySelector('.line3'); // ハンバーガーライン

  const lineContainer = document.querySelector('.l-header-sp__line'); // ラインのコンテナ

  bodyElement[0].classList.toggle('activeFixed'); // bodyはスクロールを切り替え
  toggleTarget.classList.toggle('active'); // メニュー表示・非表示切り替え
  line1.classList.toggle('active'); // 線のtransform
  line2.classList.toggle('active'); // 線のtransform
  line3.classList.toggle('active'); // 線のtransform
  lineContainer.classList.toggle('active'); // ラインコンテナのbox-shadow切り替え

}