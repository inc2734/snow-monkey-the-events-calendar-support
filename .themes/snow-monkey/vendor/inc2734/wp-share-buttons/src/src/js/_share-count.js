'use strict';

import $ from 'jquery';

export default class Inc2734_WP_Share_Buttons_Share_Count {
  constructor(target, type = 'jsonp', data = {}) {
    this.target = target;
    this.type   = type;
    this.data   = data;
  }

  request() {
    return $.ajax({
      url     : this.target,
      dataType: this.type,
      data    : this.data
    });
  }
}
