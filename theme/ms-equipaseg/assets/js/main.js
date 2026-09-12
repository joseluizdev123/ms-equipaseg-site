// MS Equipaseg — comportamento do tema.

// Galerias dos cards: as setas só agem com 2+ imagens. Com uma imagem, ficam como no Figma.
document.querySelectorAll('[data-gallery]').forEach((gallery) => {
  const slides = [...gallery.querySelectorAll('.feature-media__slide')];
  const prev = gallery.querySelector('.feature-media__nav--prev');
  const next = gallery.querySelector('.feature-media__nav--next');
  if (!prev || !next || slides.length < 2) return;

  let index = 0;
  const show = (target) => {
    index = Math.max(0, Math.min(slides.length - 1, target));
    slides.forEach((slide, i) => slide.classList.toggle('is-active', i === index));
    prev.setAttribute('aria-disabled', String(index === 0));
    next.setAttribute('aria-disabled', String(index === slides.length - 1));
  };

  prev.addEventListener('click', () => show(index - 1));
  next.addEventListener('click', () => show(index + 1));
  show(0);
});

// Carrossel de depoimentos: avança um card por vez; pontos e setas acompanham a posição.
document.querySelectorAll('[data-carousel]').forEach((carousel) => {
  const track = carousel.querySelector('[data-carousel-track]');
  const cards = track ? [...track.children] : [];
  const dots = [...carousel.querySelectorAll('[data-carousel-dot]')];
  const prev = carousel.querySelector('[data-carousel-prev]');
  const next = carousel.querySelector('[data-carousel-next]');
  if (cards.length < 2 || !prev || !next) return;

  let index = 0;
  const go = (target) => {
    index = Math.max(0, Math.min(cards.length - 1, target));
    const step = cards[1].offsetLeft - cards[0].offsetLeft;
    track.style.transform = index ? `translateX(${-index * step}px)` : '';
    dots.forEach((dot, i) => {
      dot.classList.toggle('is-active', i === index);
      if (i === index) dot.setAttribute('aria-current', 'true');
      else dot.removeAttribute('aria-current');
    });
    prev.setAttribute('aria-disabled', String(index === 0));
    next.setAttribute('aria-disabled', String(index === cards.length - 1));
  };

  prev.addEventListener('click', () => go(index - 1));
  next.addEventListener('click', () => go(index + 1));
  dots.forEach((dot, i) => dot.addEventListener('click', () => go(i)));
});
