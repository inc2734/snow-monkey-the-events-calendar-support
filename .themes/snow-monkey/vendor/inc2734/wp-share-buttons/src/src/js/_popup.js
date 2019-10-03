'use strict';

import $ from 'jquery';

export default class Inc2734_WP_Share_Buttons_Popup {
  constructor(target, title, width, height) {
    this.target = target;
    this.title  = title;
    this.width  = parseInt(width);
    this.height = parseInt(height);
    this.setListener();
  }

  setListener() {
    this.target.on('click', (event) => {
      event.preventDefault();
      window.open(
        this.target.attr('href'),
        this.title,
        `width=${this.width}, height=${this.height}, menubar=no, toolbar=no, scrollbars=yes`
      );
    });
  }
}
