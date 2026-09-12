// Sobreposição do PNG exportado do Figma para conferência visual. Abra a página com ?overlay
// Teclas: O liga/desliga · D alterna modo diferença · ↑/↓ ajustam a opacidade.
// O PNG vem do data-overlay do <body>; sem ele, usa o da Página inicial.
(() => {
  if (!new URLSearchParams(location.search).has('overlay')) return;

  const img = document.createElement('img');
  img.src = document.body.dataset.overlay || '_ref/page-full.png';
  img.alt = '';
  Object.assign(img.style, {
    position: 'absolute',
    top: '0',
    left: '50%',
    width: '1440px',
    maxWidth: 'none',
    marginLeft: '-720px',
    opacity: '0.5',
    pointerEvents: 'none',
    zIndex: '9999',
  });
  document.body.appendChild(img);

  document.addEventListener('keydown', (event) => {
    if (event.target.closest('input, textarea, select')) return;
    const key = event.key.toLowerCase();
    if (key === 'o') img.hidden = !img.hidden;
    if (key === 'd') img.style.mixBlendMode = img.style.mixBlendMode === 'difference' ? '' : 'difference';
    if (key === 'arrowup' || key === 'arrowdown') {
      event.preventDefault();
      const step = key === 'arrowup' ? 0.1 : -0.1;
      img.style.opacity = String(Math.min(1, Math.max(0, Number(img.style.opacity) + step)));
    }
  });
})();
