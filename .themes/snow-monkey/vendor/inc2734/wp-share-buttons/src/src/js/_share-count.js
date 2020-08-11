export default class Inc2734_WP_Share_Buttons_Share_Count {
  constructor(target, type = 'jsonp', data = {}) {
    this.target = target;
    this.type   = type;
    this.data   = data;
  }

  request( args ) {
    const xhr = new XMLHttpRequest();
    const queryString = Object.keys(this.data).map((key) => `${ key }=${ this.data[ key ] }`).join('&');
    const url = `${ this.target }?${ queryString }`;

    xhr.onreadystatechange = () => {
      if (4 === xhr.readyState) {
        if (200 === xhr.status) {
          args.done(JSON.parse(xhr.response));
        }
      }
    };

    xhr.open('GET', url, true);
    xhr.send(null);
  }
}
