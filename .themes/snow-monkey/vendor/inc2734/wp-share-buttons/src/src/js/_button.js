export default class Inc2734_WP_Share_Buttons_Button {
  constructor(button, params = {}) {
    this.button = button;
    this.countComponent  = this.button.querySelector('.wp-share-button__count');
    this.buttonComponent = this.button.querySelector('.wp-share-button__button');

    const defaultParams = {
      post_id: this.button.getAttribute('data-wp-share-buttons-postid'),
    };

    this.params = {};
    for (const key in defaultParams) {
      this.params[ key ] = 'undefined' !== typeof params[ key ]
        ? params[ key ]
        : defaultParams[ key ];
    }

    if (! this.button.getAttribute('data-wp-share-buttons-has-cache')) {
      if (!! this.countComponent) {
        this.count();
      }
    }
    this.popup();
  }

  count() {}

  popup() {}
}
