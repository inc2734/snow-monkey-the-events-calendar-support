export default class Inc2734_WP_Share_Buttons_Popup {
  constructor(target, title, width, height) {
    const handleClick = (event) => {
      event.preventDefault();

      window.open(
        target.getAttribute('href'),
        title,
        `width=${ parseInt(width) }, height=${ parseInt(height) }, menubar=no, toolbar=no, scrollbars=yes`
      );
    };
    target.addEventListener('click', handleClick, false);
  }
}
