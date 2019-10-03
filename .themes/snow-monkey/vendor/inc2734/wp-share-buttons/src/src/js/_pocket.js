'use strict';

import $ from 'jquery';
import Inc2734_WP_Share_Buttons_Button from './_button.js';
import Inc2734_WP_Share_Buttons_Popup from './_popup.js';

export default class Inc2734_WP_Share_Buttons_Pocket extends Inc2734_WP_Share_Buttons_Button {
  constructor(button, params) {
    super(button, params);
  }

  popup() {
    new Inc2734_WP_Share_Buttons_Popup(
      this.button.find('.wp-share-button__button'),
      'Pocket',
      550,
      350
    );
  }
}
