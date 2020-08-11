export default class Inc2734_WP_Share_Buttons_Copy {
  constructor(button) {
    const copyMessage = document.querySelector('.wp-share-buttons-copy-message');
    if (! copyMessage) {
      return;
    }

    const handleClick = () => {
      const title = button.getAttribute('data-title');
      const url   = button.getAttribute('data-url');

      let hashtags = button.getAttribute('data-hashtags');
      if (!! hashtags) {
        hashtags = hashtags.split(',');
        for (let i = 0; i < hashtags.length; i ++) {
          hashtags[i] = `#${ hashtags[i].trim() }`;
        }
        hashtags = hashtags.join(' ');
      }

      const input = document.createElement('input');
      const text  = `${ title } ${ url } ${ hashtags }`;
      input.value = text.trim();
      input.style.position = 'fixed';
      input.style.top = '100%';
      document.body.appendChild(input);
      input.select();

      const result = document.execCommand('copy');
      input.remove();

      const message = result ? 'Copied !' : 'Copy failed !';
      const messageWrapper = document.createElement('div');
      messageWrapper.classList.add('wp-share-buttons-copy-message');
      messageWrapper.textContent = message;
      document.body.appendChild(messageWrapper);

      setTimeout(() => messageWrapper.remove(), 2000);

      return result;
    };
    button.addEventListener('click', handleClick, false);
  }
}
