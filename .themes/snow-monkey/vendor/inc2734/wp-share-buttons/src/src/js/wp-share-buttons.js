import Inc2734_WP_Share_Buttons_Facebook from './_facebook.js';
import Inc2734_WP_Share_Buttons_Twitter from './_twitter.js';
import Inc2734_WP_Share_Buttons_Hatena from './_hatena.js';
import Inc2734_WP_Share_Buttons_Line from './_line.js';
import Inc2734_WP_Share_Buttons_Pocket from './_pocket.js';
import Inc2734_WP_Share_Buttons_Pinterest from './_pinterest.js';
import Inc2734_WP_Share_Buttons_Feedly from './_feedly.js';
import Inc2734_WP_Share_Buttons_Copy from './_copy.js';

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const facebookButtons = document.querySelectorAll('.wp-share-button--facebook');
    [].slice.call(facebookButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Facebook(button));

    const twitterButtons = document.querySelectorAll('.wp-share-button--twitter');
    [].slice.call(twitterButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Twitter(button));

    const hatenaButtons = document.querySelectorAll('.wp-share-button--hatena');
    [].slice.call(hatenaButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Hatena(button));

    const lineButtons = document.querySelectorAll('.wp-share-button--line');
    [].slice.call(lineButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Line(button));

    const pocketButtons = document.querySelectorAll('.wp-share-button--pocket');
    [].slice.call(pocketButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Pocket(button));

    const pinterestButtons = document.querySelectorAll('.wp-share-button--pinterest');
    [].slice.call(pinterestButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Pinterest(button));

    const feedlyButtons = document.querySelectorAll('.wp-share-button--feedly');
    [].slice.call(feedlyButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Feedly(button));

    const copyButtons = document.querySelectorAll('.wp-share-button--copy');
    [].slice.call(copyButtons).forEach((button) => new Inc2734_WP_Share_Buttons_Copy(button));
  }
);
