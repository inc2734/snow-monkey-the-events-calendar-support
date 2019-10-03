'use strict';

import $ from 'jquery';

export default class Inc2734_WP_Share_Buttons_Button {
  constructor(button, params = {}) {
    $(() => {
      this.button = button;
      this.params = $.extend({
        post_id: this.button.data('wp-share-buttons-postid'),
      }, params);;

      if (! this.button.data('wp-share-buttons-has-cache')) {
        if (this.button.find('.wp-share-button__count').length) {
          this.count();
        }
      }
      this.popup();
    });
  }

  count() {}

  popup() {}
}
