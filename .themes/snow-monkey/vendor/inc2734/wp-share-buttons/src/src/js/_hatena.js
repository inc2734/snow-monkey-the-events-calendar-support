import Inc2734_WP_Share_Buttons_Button from './_button.js';
import Inc2734_WP_Share_Buttons_Share_Count from './_share-count.js';
import Inc2734_WP_Share_Buttons_Popup from './_popup.js';

export default class Inc2734_WP_Share_Buttons_Hatena extends Inc2734_WP_Share_Buttons_Button {
  count() {
    new Inc2734_WP_Share_Buttons_Share_Count(
      inc2734_wp_share_buttons_hatena.endpoint,
      'json',
      {
        action     : inc2734_wp_share_buttons_hatena.action,
        _ajax_nonce: inc2734_wp_share_buttons_hatena._ajax_nonce,
        post_id    : this.params.post_id,
        url        : this.params.url
      }
    ).request(
      {
        done: (json) => this.countComponent.textContent = json.count,
      }
    );
  }

  popup() {
    new Inc2734_WP_Share_Buttons_Popup(
      this.buttonComponent,
      'Hatena Bookmark',
      510,
      420
    );
  }
}
