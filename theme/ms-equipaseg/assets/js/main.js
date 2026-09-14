// MS Equipaseg — comportamento do tema.

// De quanto em quanto tempo os carrosséis andam sozinhos.
const PASSO_SOZINHO = 5000;

// Liga o "anda sozinho" de uma área: para com o mouse em cima, com o teclado dentro, fora da tela e
// para quem pediu menos movimento no sistema. Devolve a função que recomeça a contagem.
function andarSozinho(area, passo) {
  const menosMovimento = window.matchMedia('(prefers-reduced-motion: reduce)');
  let relogio = 0;
  let naTela = false;

  const parar = () => {
    clearInterval(relogio);
    relogio = 0;
  };

  const recomecar = () => {
    parar();
    if (!naTela || menosMovimento.matches) return;
    relogio = setInterval(passo, PASSO_SOZINHO);
  };

  area.addEventListener('mouseenter', parar);
  area.addEventListener('mouseleave', recomecar);
  area.addEventListener('focusin', parar);
  area.addEventListener('focusout', recomecar);
  menosMovimento.addEventListener('change', recomecar);

  new IntersectionObserver((entradas) => {
    naTela = entradas.some((entrada) => entrada.isIntersecting);
    recomecar();
  }, { threshold: 0.2 }).observe(area);

  return recomecar;
}

// Galerias dos cards de produto: as setas só agem com 2+ imagens. Com uma imagem, ficam como no
// Figma. Com mais, a foto sai para o lado e a próxima entra, como virar a página de um livro; a
// última leva de volta à primeira e a troca acontece sozinha.
const TROCA_FOTO = 650;

document.querySelectorAll('[data-gallery]').forEach((gallery) => {
  const slides = [...gallery.querySelectorAll('.feature-media__slide')];
  const prev = gallery.querySelector('.feature-media__nav--prev');
  const next = gallery.querySelector('.feature-media__nav--next');
  if (!prev || !next || slides.length < 2) return;

  prev.removeAttribute('aria-disabled');
  next.removeAttribute('aria-disabled');

  let index = 0;
  let trocando = 0;

  // A etiqueta de cada foto vem logo depois dela no HTML e anda junto com ela.
  const comEtiqueta = (slide) => {
    const etiqueta = slide.nextElementSibling;
    return etiqueta && etiqueta.classList.contains('feature-media__tag') ? [slide, etiqueta] : [slide];
  };

  const deslizar = (slide, px, animar) => {
    comEtiqueta(slide).forEach((peca) => {
      peca.style.transition = animar ? '' : 'none';
      peca.style.setProperty('--desliza', `${px}px`);
    });
  };

  // Fecha a troca: só a foto da vez continua visível e as outras voltam para o lugar.
  const assentar = () => {
    clearTimeout(trocando);
    trocando = 0;
    slides.forEach((slide, i) => {
      if (i === index) return;
      slide.classList.remove('is-active');
      deslizar(slide, 0, false);
    });
  };

  const mostrar = (alvo, sentido) => {
    // Clique em cima de clique: fecha a troca anterior antes de começar a próxima, senão as fotos
    // do caminho ficam todas visíveis ao mesmo tempo.
    if (trocando) assentar();

    const anterior = index;
    index = ((alvo % slides.length) + slides.length) % slides.length;
    if (index === anterior) return;

    const largura = gallery.clientWidth;
    const sai = slides[anterior];
    const entra = slides[index];

    deslizar(entra, sentido * largura, false);
    entra.classList.add('is-active');
    void entra.offsetWidth;
    deslizar(entra, 0, true);
    deslizar(sai, -sentido * largura, true);

    trocando = setTimeout(assentar, TROCA_FOTO);
  };


  const recomecar = andarSozinho(gallery, () => mostrar(index + 1, 1));
  const naMao = (alvo, sentido) => {
    mostrar(alvo, sentido);
    recomecar();
  };

  prev.addEventListener('click', () => naMao(index - 1, -1));
  next.addEventListener('click', () => naMao(index + 1, 1));
});

// Carrossel dos depoimentos e das galerias de fotos: gira sem fim e anda sozinho.
// Cópias dos cards ficam antes e depois do trilho, então sempre entra card dos dois lados e a volta
// ao começo acontece sem o olho ver.
document.querySelectorAll('[data-carousel]').forEach((carousel) => {
  const track = carousel.querySelector('[data-carousel-track]');
  const cards = track ? [...track.children] : [];
  const dots = [...carousel.querySelectorAll('[data-carousel-dot]')];
  const prev = carousel.querySelector('[data-carousel-prev]');
  const next = carousel.querySelector('[data-carousel-next]');
  if (cards.length < 2 || !prev || !next) return;

  const total = cards.length;
  let index = 0;
  let animando = false;
  let rede = 0;

  const passo = () => cards[1].offsetLeft - cards[0].offsetLeft;

  const copiar = (card) => {
    const copia = card.cloneNode(true);
    copia.setAttribute('aria-hidden', 'true');
    copia.querySelectorAll('a, button').forEach((foco) => foco.setAttribute('tabindex', '-1'));
    return copia;
  };

  // Cópias suficientes para encher a tela de cada lado.
  const copias = Math.max(1, Math.ceil(window.innerWidth / (total * passo())));
  for (let volta = 0; volta < copias; volta++) {
    cards.forEach((card) => track.appendChild(copiar(card)));
    [...cards].reverse().forEach((card) => track.prepend(copiar(card)));
  }
  const base = copias * total;

  // Girando sem fim, nenhuma das duas setas fica apagada.
  prev.removeAttribute('aria-disabled');
  next.removeAttribute('aria-disabled');

  // O Figma desenha 4 pontinhos, mas o número de cards varia: cada ponto cobre uma fatia do trilho.
  const pontoDoCard = (card) => (dots.length > 1 ? Math.round((card * (dots.length - 1)) / (total - 1)) : 0);
  const cardDoPonto = (ponto) => (dots.length > 1 ? Math.round((ponto * (total - 1)) / (dots.length - 1)) : 0);

  const marcar = () => {
    const atual = pontoDoCard(((index % total) + total) % total);
    dots.forEach((dot, i) => {
      dot.classList.toggle('is-active', i === atual);
      if (i === atual) dot.setAttribute('aria-current', 'true');
      else dot.removeAttribute('aria-current');
    });
  };

  const posicionar = (animar) => {
    const alvo = `translateX(${-(base + index) * passo()}px)`;
    if (!animar) {
      track.style.transition = 'none';
      track.style.transform = alvo;
      void track.offsetWidth;
      track.style.transition = '';
    } else if (track.style.transform !== alvo) {
      animando = true;
      clearTimeout(rede);
      rede = setTimeout(() => assentar(), 950);
      track.style.transform = alvo;
    }
    marcar();
  };

  // Fim do movimento: fora da volta original, o trilho pula para o card igual, sem o olho ver.
  const assentar = () => {
    clearTimeout(rede);
    animando = false;
    if (index >= total || index < 0) {
      index = ((index % total) + total) % total;
      posicionar(false);
    }
  };

  const ir = (alvo) => {
    if (animando) return;
    index = alvo;
    posicionar(true);
  };

  const recomecar = andarSozinho(carousel, () => ir(index + 1));

  // Clique do usuário manda: o relógio recomeça do zero depois dele.
  const naMao = (alvo) => {
    ir(alvo);
    recomecar();
  };

  track.addEventListener('transitionend', (evento) => {
    if (evento.target === track && evento.propertyName === 'transform') assentar();
  });

  prev.addEventListener('click', () => naMao(index - 1));
  next.addEventListener('click', () => naMao(index + 1));
  dots.forEach((dot, i) => dot.addEventListener('click', () => naMao(cardDoPonto(i))));
  window.addEventListener('resize', () => posicionar(false));
  window.addEventListener('load', () => posicionar(false));

  posicionar(false);
});

// Vídeos em funcionamento: a capa vira o player do YouTube só no clique, sem cookies e sem carregar
// nada do YouTube em quem só passa pela página.
document.querySelectorAll('[data-video]').forEach((capa) => {
  capa.addEventListener('click', () => {
    const player = document.createElement('iframe');
    player.className = 'videos__player';
    player.src = `https://www.youtube-nocookie.com/embed/${capa.dataset.video}?autoplay=1&rel=0`;
    player.title = capa.getAttribute('aria-label') || 'Vídeo';
    player.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
    player.allowFullscreen = true;
    capa.replaceWith(player);
    player.focus({ preventScroll: true });
  });
});

// Botão "Baixar informações" dos cards de modelo: abre um menu por vez, que fecha com clique fora,
// com Esc e depois de escolher uma opção.
const menusBaixar = [...document.querySelectorAll('details[data-menu-baixar]')];

menusBaixar.forEach((menu) => {
  const lista = menu.querySelector('.menu-baixar__lista');

  menu.addEventListener('toggle', () => {
    if (!menu.open) return;
    menusBaixar.forEach((outro) => {
      if (outro !== menu) outro.open = false;
    });
    // A lista abre alinhada à direita do botão; se isso a jogar para fora da tela (ou a menos de 8px da borda),
    // abre para a direita.
    lista.classList.remove('menu-baixar__lista--direita');
    lista.style.removeProperty('left');
    if (lista.getBoundingClientRect().left < 8) lista.classList.add('menu-baixar__lista--direita');
    // Em telas muito estreitas (320px) nenhum dos dois lados tem espaço: a lista volta para dentro da tela.
    const passa = lista.getBoundingClientRect().right - (document.documentElement.clientWidth - 8);
    if (passa > 0) lista.style.left = `${-passa}px`;
  });

  menu.querySelectorAll('a').forEach((opcao) => {
    opcao.addEventListener('click', () => {
      menu.open = false;
    });
  });
});

if (menusBaixar.length) {
  document.addEventListener('click', (evento) => {
    menusBaixar.forEach((menu) => {
      if (menu.open && !menu.contains(evento.target)) menu.open = false;
    });
  });

  document.addEventListener('keydown', (evento) => {
    if (evento.key !== 'Escape') return;
    menusBaixar.forEach((menu) => {
      if (!menu.open) return;
      menu.open = false;
      menu.querySelector('summary').focus();
    });
  });
}

// Menu do mobile: abaixo de 860px o botão do header abre e fecha a lista de links.
document.querySelectorAll('[data-menu-toggle]').forEach((toggle) => {
  const header = toggle.closest('.site-header');
  if (!header) return;

  toggle.addEventListener('click', () => {
    const aberto = header.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(aberto));
    toggle.setAttribute('aria-label', aberto ? 'Fechar menu' : 'Abrir menu');
  });
});
