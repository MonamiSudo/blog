import $ from "jquery";

import { HumburgerToggle } from '../js/HumburgerToggle'; // ハンバーガーメニュー開閉

$(document)
  .on('click', '.l-header-sp__line', HumburgerToggle);


// 全ての Bootstrap の名前付きエクスポート（named export）をインポート
import * as bootstrap from 'bootstrap';

// スタイルシート（Sass）をインポート
import './index.scss';