# MS Equipaseg — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Página inicial** (`3047:6`). Medições de 11/09/2026.

## Como avaliar

- Página local: http://localhost:5500 (servidor: `node tools/serve.mjs`, sem cache).
- Sobreposição do Figma: http://localhost:5500/?overlay. Teclas: **O** liga/desliga, **D** modo diferença, **↑/↓** opacidade.
- A comparação só vale com **1440px de largura útil**. No Windows, a barra de rolagem come ~15px: use uma janela de ~1457px ou o modo responsivo do DevTools em 1440.

## Método

1. Referência: PNG do frame exportado do Figma em 1x (`_ref/page-full.png`, 1440×5837).
2. Site: screenshot do Chrome headless em 1440px, sem barra de rolagem (`tools/shot.ps1`).
3. `tools/pixeldiff.ps1` mede, por região:
   - **divergência real**: pixels cuja cor não aparece na outra imagem num raio de 1px (desconta antialiasing);
   - **melhor deslocamento** (dx, dy) entre site e Figma.
4. `tools/extents.ps1` mede a posição de bordas, linhas de texto e blocos nas duas imagens.
5. Comparativos visuais (Figma / Site / Diff) em `_ref/diff/`.

A divergência que sobra é rasterização de texto: Figma e Chrome desenham os mesmos glifos nas mesmas posições com antialiasing diferente.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento | Âncoras (Figma = site, px) |
|---|---|---|---|---|---|
| 1 | Header | `7020:1080` | 2,61% | dx 1 (texto) | logo x 80–151; bordas do botão y 12 e 59; menu ±1–2 |
| 2 | Hero | `5051:133` | 2,30% | 0, 0 | título y 203/267/331; subtítulo y 414/441/468; CTA 80–323 × 521–592; foto 0,000% |
| 3 | Nossos clientes | `5051:163` | 1,35% | 0, 0 | 6 logos nas mesmas colunas (±1); borda y 816. Medido com os logos parados; hoje eles rodam (ver Diferenças justificadas) |
| 4 | Produtos (título) | `5275:717` | 0,36% | 0, 0 | glifos y 926–956 |
| 5 | Dilacerador de Pneus | `5051:235` | 2,59% | 0, 0 | bordas x 80/1361 e y 1020/1583; foto 112–626 × 1052–1551 (0,005%) |
| 6 | Torniquete | `5275:756` | 2,25% | 0, 0 | bordas y 1644/2207; mídia x 813–1327; selo y 1708–1746; CTA y 2082–2148 |
| 7 | Projetos especiais (título) | `5275:793` | 0,51% | 0, 0 | glifos y 2418–2457 |
| 8 | Projetos especiais (card) | `5275:796` | 1,79% | dx 1 (texto) | card 80–1359 × 2511–3074; itens y 2767/2819/2871 |
| 9 | Sobre nós + números | `5060:357` | 1,99% | 0, 0 | 6 linhas de texto; CTA y 3576–3642; borda y 3743; foto 0,66% |
| 10 | Depoimentos | `5060:1948` | 2,59% | 0, 0 | cards x 80/517/954/1391, altura 352; divisor y 4286–4287; pontos e setas |
| 11 | CTA final | `5235:1048` | 0,67% | 0, 0 | título y 4768–4816/4835–4871; botão y 4979–5050; foto x 725–1439 (0,024%) |
| 12 | Footer | `5235:1049` | 2,15% | 0, 0 | borda y 5339; colunas x 529/675/874/1081 (±1); ícones de contato; créditos |

Altura total: Figma 5836,12px, site 5836px.

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Sublinhado do item ativo | vetor fixo em x 484–585; o texto começa em 466 | sob o texto do item ativo (466–565) | no WordPress ele acompanha o item atual; no arquivo está 18px deslocado |
| Linhas longas em Inter | — | até 3px a mais no fim da linha; ±1px nos itens do menu | métricas da Inter do Google Fonts × Inter do Figma; quebras de linha idênticas |
| "Nossos números" | itens a partir de x 474 | x 478 | as larguras de texto se acumulam numa linha alinhada à direita |
| Item "Controle de acesso, remotamente" | sem letter-spacing | −0,01em como os outros itens | inconsistência do arquivo; 5px no fim da linha |
| " Farol verde e vermelho." | espaço no início | sem o espaço | espaço acidental; 3px na linha |
| CTA do Dilacerador | bordas antialiasadas em y 1439,5 | y 1440 | conteúdo centralizado cai em meio pixel; o Chrome arredonda |
| Foto do Sobre | ajuste de cor na imagem (não sai na exportação) | ajuste medido por regressão entre as duas imagens e gravado no `sobre.jpg` | erro médio por canal 13,4 → 3,6; média RGB 83,70,45 × 83,70,46 |
| Fundo do hero | 3 imagens sobrepostas | só a camada visível | as outras duas ficam sob a de cima e sob o degradê opaco; diff da foto 0,000% |
| Recorte do torniquete | imagem girada 1,64° | PNG exportado pelo Figma já girado | editável no WordPress; 1,14% nas bordas do recorte |
| Ano nos créditos | 2025 | 2025 no estático; ano atual no tema | — |
| Hover, clique e foco | não existem no Figma | botões amarelos e escuros sobem 2px com sombra no hover e descem escurecendo no clique; "Fale conosco" com borda amarela; menu com traço amarelo que cresce do centro; setas ficam amarelas com a seta escura e encolhem no clique; pontos do carrossel escurecem (área de clique de 12×24px); links do rodapé e redes sociais amarelos; logos clareiam; foco de teclado com anel amarelo e um anel escuro por dentro (no CTA final, de fundo amarelo, o contorno fica escuro). Hover só em aparelhos com mouse; sem deslocamento com `prefers-reduced-motion` | feedback e acessibilidade; pedido do usuário em 11/09/2026, para o site todo |
| Galerias dos produtos | 1 foto por card; etiqueta só no Torniquete ("Linha MD 200") | 4 fotos no Dilacerador e 3 no Torniquete, cada uma com a sua etiqueta | pedido do usuário em 11/09/2026 |
| Nossos clientes | 6 logos parados, 79,4px entre eles | faixa rodando da direita para a esquerda (30s por volta, 88px entre logos), pontas apagadas em 120px; a 2ª cópia da lista tem `aria-hidden`; fica parada com `prefers-reduced-motion` | pedido do usuário em 11/09/2026 |

## Abaixo de 1440px

O Figma só tem a versão de 1440px. As regras fluidas não alteram nada em 1440px:

- 1280–1439: o conteúdo dos cards encolhe;
- até 1279: cards empilham (imagem em cima);
- até 1023: título dos depoimentos quebra linha, foto do Sobre menor;
- até ~900: a faixa de clientes desce para baixo do título;
- até 859: menu principal escondido;
- até 767: listas em uma coluna, foto do CTA oculta.

Sem rolagem lateral medida em 1440, 1366, 1280, 1024, 768 e 390px. Mobile de verdade (menu recolhível, tipografia e espaçamentos) depende de layout ou decisão: pendente.

## Smoke test

- 67 imagens (6 são a cópia da faixa de clientes), nenhuma quebrada; nenhuma resposta com status ≥ 400; console sem erros.
- Faixa de clientes: anda ~36px/s (1083px em 30s); cada cópia da lista cobre a faixa em 1440, 1366, 1280, 1024, 768 e 390px, sem vão na emenda e sem rolagem lateral.
- Estados de hover, clique e foco: conferidos em 11 botões e links (menu, "Fale conosco", CTAs do topo, do card, final e do rodapé, setas da galeria e dos depoimentos, ponto do carrossel, rede social e link do rodapé). Em repouso, home e Quem somos continuam pixel a pixel iguais à versão anterior; só a faixa de clientes muda, porque anda sozinha.
- Carrossel de depoimentos: avança 437px por clique; pontos e setas atualizam; volta ao início.
- Galerias dos cards de produto: Dilacerador com 4 fotos e Torniquete com 3; as setas trocam a foto e param na primeira e na última. A etiqueta com o nome vem logo depois de cada foto no HTML e só a da foto ativa aparece (regra no bloco Produtos do `main.css`).
  - Dilacerador: foto original, etiqueta "Dilacerador" + Embutido, Duplo e Lombada (`produto-dilacerador-embutido.jpg`, `-duplo.jpg`, `-lombada.jpg`).
  - Torniquete: Linha MD 200 (recorte original) + Linha MD 300 e Linha MD Duplo (`produto-torniquete-md300.jpg`, `-mdduplo.jpg`). Essas duas ocupam a caixa inteira (`feature-media__slide--fill`).
  - Origem: `Embutido.png`, `duplo.png`, `lombada.png`, `linhamd300.png` e `mdduplo.png`, salvas em `seed/` em 11/09/2026 em 515×500 (1x). Todas, menos a duplo, já vinham com o fundo da mídia do Torniquete, com as elipses na mesma posição do site. A duplo veio sem fundo e recebeu esse fundo, capturado do site.
- CSS (medido em 11/09/2026, depois das galerias e da faixa de clientes): 142 classes; sem uso nos `.html` estáticos só `sub-menu`, `page-content`, `page-content__body`, `page-content__title` (páginas do WordPress) e `depoimento__foto`; nenhuma cor fixa fora dos tokens.

## Tokens (Figma → CSS)

| Figma | CSS |
|---|---|
| frame 1440 / coluna 1280 / respiro 80 / gap 48 | `--frame-w` / `--content-w` / `--section-px: clamp(24px, 5.5556vw, 80px)` / `--content-gap` |
| `#0D0D0B` · `#1B1A17` · `#F7F7F7` | `--color-black` · `--color-ink` · `--color-surface` |
| `#F4B612` · `#FFC52B` · `#FFEDA6` · `#FFDE59` | `--color-yellow` · `--color-yellow-light` · `--color-yellow-soft` · `--color-yellow-pale` |
| Gray/01, 02, 03, 05, 06 | `--gray-01`, `--gray-02`, `--gray-03`, `--gray-05`, `--gray-06` |
| Exo (títulos) · Inter (texto) · Montserrat e Work Sans (rodapé) | `--font-heading` · `--font-body` · `--font-footer` · `--font-credits` |
| line-height "auto" da Exo (arredondado pelo Figma) | 48→64px, 40→53px, 32→43px, 24→32px, 20→27px |

## Pendências

- Botão "Consulte os modelos" do card do Dilacerador: hoje vai para `#contato`. O Mestre sugeriu apontar para `dilacerador-de-pneus.html`; em 11/09/2026 o usuário deixou a decisão para depois e pediu para ser lembrado.

## Ferramentas

- `node tools/serve.mjs`: servidor estático sem cache (porta 5500).
- `tools/shot.ps1`: screenshot headless em 1440px.
- `tools/pixeldiff.ps1`: divergência e deslocamento por região.
- `tools/extents.ps1`: posição de textos, bordas e blocos.
- `tools/overlay.js`: sobreposição do PNG do Figma na página (`?overlay`).
