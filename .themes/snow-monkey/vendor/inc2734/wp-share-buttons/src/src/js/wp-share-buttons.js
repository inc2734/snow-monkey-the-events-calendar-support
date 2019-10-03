'use strict';

import $ from 'jquery';
import Inc2734_WP_Share_Buttons_Facebook from './_facebook.js';
import Inc2734_WP_Share_Buttons_Twitter from './_twitter.js';
import Inc2734_WP_Share_Buttons_Hatena from './_hatena.js';
import Inc2734_WP_Share_Buttons_GooglePlus from './_google-plus.js';
import Inc2734_WP_Share_Buttons_Line from './_line.js';
import Inc2734_WP_Share_Buttons_Pocket from './_pocket.js';
import Inc2734_WP_Share_Buttons_Pinterest from './_pinterest.js';
import Inc2734_WP_Share_Buttons_Feedly from './_feedly.js';
import Inc2734_WP_Share_Buttons_Copy from './_copy.js';

export default class Inc2734_WP_Share_Buttons {
  constructor() {
    $(() => {
      $('.wp-share-button--facebook').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Facebook($(e));
      });

      $('.wp-share-button--twitter').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Twitter($(e));
      });

      $('.wp-share-button--hatena').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Hatena($(e));
      });

      $('.wp-share-button--google-plus').each((i, e) => {
        new Inc2734_WP_Share_Buttons_GooglePlus($(e));
      });

      $('.wp-share-button--line').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Line($(e));
      });

      $('.wp-share-button--pocket').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Pocket($(e));
      });

      $('.wp-share-button--pinterest').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Pinterest($(e));
      });

      $('.wp-share-button--feedly').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Feedly($(e));
      });

      $('.wp-share-button--copy').each((i, e) => {
        new Inc2734_WP_Share_Buttons_Copy($(e));
      });
    });
  }
}

new Inc2734_WP_Share_Buttons();
