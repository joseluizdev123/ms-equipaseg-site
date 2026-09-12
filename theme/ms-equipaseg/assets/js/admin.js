// Campo de imagens do produto: abre a Biblioteca de Mídia, guarda os IDs separados por vírgula
// e mostra as miniaturas na ordem escolhida.
(function ($) {
  $(document).on('click', '.mse-gallery__select', function (event) {
    event.preventDefault();
    const field = $(this).closest('.mse-gallery');
    const input = field.find('input[type="hidden"]');
    const preview = field.find('.mse-gallery__preview');

    const frame = wp.media({
      title: 'Imagens do produto',
      button: { text: 'Usar imagens' },
      library: { type: 'image' },
      multiple: 'add',
    });

    frame.on('open', () => {
      const selection = frame.state().get('selection');
      String(input.val())
        .split(',')
        .filter(Boolean)
        .forEach((id) => {
          const attachment = wp.media.attachment(id);
          attachment.fetch();
          selection.add(attachment);
        });
    });

    frame.on('select', () => {
      const items = frame.state().get('selection').toJSON();
      input.val(items.map((item) => item.id).join(','));
      preview.empty();
      items.forEach((item) => {
        const url = item.sizes && item.sizes.thumbnail ? item.sizes.thumbnail.url : item.url;
        preview.append($('<li>').append($('<img>', { src: url, alt: '' })));
      });
    });

    frame.open();
  });

  $(document).on('click', '.mse-gallery__clear', function (event) {
    event.preventDefault();
    const field = $(this).closest('.mse-gallery');
    field.find('input[type="hidden"]').val('');
    field.find('.mse-gallery__preview').empty();
  });
})(jQuery);
