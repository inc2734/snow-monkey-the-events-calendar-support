'use strict';

import $ from 'jquery';

export default class Inc2734_WP_Share_Buttons_Copy {
  constructor(button) {
    button.on('click', () => {
      if ($('.wp-share-buttons-copy-message').length) {
        return;
      }

      const title = button.attr('data-title');
      const url = button.attr('data-url');

      let hashtags = button.attr('data-hashtags');
      if (hashtags) {
        hashtags = hashtags.split(',');
        for (let i = 0; i < hashtags.length; i++) {
          hashtags[i] = `#${hashtags[i].trim()}`;
        }
        hashtags = hashtags.join(' ');
      }

      const input = $('<input />');
      const text = `${title} ${url} ${hashtags}`;
      input.val( text.trim() ).css({ position: 'fixed', top: '100%' });
      input.appendTo('body');
      input.select();

      const result = document.execCommand('copy');
      input.remove();

      let message = '';
      if (result) {
        message = 'Copied !';
      } else {
        message = 'Copy failed !';
      }

      const messageWrapper = $('<div class="wp-share-buttons-copy-message" />');
      messageWrapper.text(message);
      messageWrapper.appendTo('body');

      setTimeout(() => {
        messageWrapper.remove();
      }, 2000);

      return result;
    });
  }
}
