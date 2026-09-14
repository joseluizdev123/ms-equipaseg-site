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
| Galerias dos produtos | 1 foto por card; etiqueta só no Torniquete ("Linha MD 200"); setas apagadas nas pontas | 4 fotos no Dilacerador e 3 no Torniquete, cada uma com a sua etiqueta; giram sem fim e trocam sozinhas a cada 5s, então nenhuma seta nasce apagada (muda 128 pixels, 64 em cada seta "anterior") | fotos e etiquetas a pedido do usuário em 11/09/2026; giro sem fim e troca sozinha vieram do `main.js` comum em 12/09/2026 |
| Depoimentos | seta "anterior" apagada no começo; carrossel parado até alguém clicar | gira sem fim e anda sozinho a cada 5s (para com o mouse em cima, com o teclado dentro, fora da tela e com menos movimento no sistema); nenhuma seta fica apagada, o que muda 64 pixels do desenho da seta "anterior". Com as cópias dos dois lados, na tirinha de 48px à esquerda aparece o fim do card anterior, onde o Figma tem só fundo (0,196% da página) | mudanças comuns do `main.js` em 12/09/2026, a pedido do usuário |
| Card de Projetos especiais | "Conheça os projetos", descrição repetida do Dilacerador, 3 itens "Lorem ipsum", botão para a própria seção (`#projetos`) e mídia vazia | conteúdo da página Projetos (`projetos.html`): título "Desenvolvimento de projetos personalizados", a descrição do topo de lá, as 3 primeiras áreas de "Outros projetos" na lista e a foto do topo de lá (torniquete branco instalado); o botão "Saber mais sobre" abre `projetos.html` | pedido do usuário em 13/09/2026, para a seção da home ficar ligada à página de Projetos. Como o site é HTML estático, o texto foi copiado; no WordPress ele vai sair do mesmo lugar nas duas páginas |
| Card do Totem em Produtos | não existe no Figma (só Dilacerador e Torniquete) | terceiro card, na mesma forma do Dilacerador (1282×564, imagem à esquerda): título "Totem", descrição e 6 dos diferenciais da página de Totens (`controle-de-acesso.html`); foto `totem-controle-de-acesso.jpg` (a mesma da página de Totens, 1672×941), recortada no centro para caber na caixa de 515×500: o totem fica inteiro no meio, com o dilacerador à esquerda e a cancela à direita (foto colocada em 13/09/2026) | pedido do usuário em 13/09/2026; a página passa a ter 6991px de altura |
| Texto do hero | "Fabricamos torniquetes, dilaceradores de pneus e desenvolvemos projetos personalizados, entregando qualidade, inovação e agilidade" | "Fabricamos torniquetes, dilaceradores de pneus e totens, além de desenvolver projetos personalizados, com qualidade, inovação e agilidade" | pedido do usuário em 12/09/2026 (entrar "totens" sem repetir "e"; texto escolhido entre três opções); o parágrafo continua com 3 linhas em 1440px e nada do hero muda de lugar |
| Vídeos em funcionamento | não existe no Figma | seção nova entre Produtos e Projetos especiais, com fundo preto (`--color-black`, pedido do usuário) e título branco, copiando a do site no ar: título "Vídeos dos produtos em funcionamento" (no site no ar é só "Vídeos em funcionamento"; trocado a pedido do usuário em 13/09/2026) e três vídeos do YouTube lado a lado (405×228 cada, 32px entre eles). A capa é a miniatura do YouTube com um play amarelo; o player (`youtube-nocookie.com`) só carrega no clique, então a página não chama o YouTube em quem só passa | pedido do usuário em 12/09/2026; ids e origem no `CONTEUDO-SITE-ATUAL.md` do Mestre |
| Texto do rodapé | lorem ipsum | "Fabricamos torniquetes, dilaceradores de pneus e totens, além de desenvolver projetos personalizados, com qualidade, inovação e agilidade para proteger sua empresa." — o mesmo texto do topo da home | rodapé comum das 8 páginas; o Mestre trocou o lorem ipsum pelo texto antigo do topo e, em 13/09/2026, o usuário pediu para usar o texto novo, com os totens |
| Contatos do rodapé | telefone e e-mail de exemplo | dados reais do site atual: WhatsApp e telefone "11 5667-9440" e e-mail `email@msequipaseg.com.br` | rodapé comum atualizado pelo Mestre em 12/09/2026, com autorização do usuário; muda 2.400 pixels (0,028%) nas três linhas de contato, sem mexer no resto |
| Avatar do 4º depoimento | amarelo claro (`--color-yellow-pale`) | igual aos outros três (`--color-yellow`) | com o carrossel girando, esse card muda de lugar e a cor ficava pulando; pedido do usuário em 12/09/2026. Na home só aparece a beirada desse avatar na borda direita: 742 pixels, 0,009% da página |
| Nossos clientes | 6 logos parados, 79,4px entre eles | faixa rodando da direita para a esquerda (30s por volta, 88px entre logos), pontas apagadas em 120px; a 2ª cópia da lista tem `aria-hidden`; fica parada com `prefers-reduced-motion` | pedido do usuário em 11/09/2026 |

## Abaixo de 1440px

O Figma só tem a versão de 1440px. As regras fluidas não alteram nada em 1440px:

- 1280–1439: o conteúdo dos cards encolhe;
- até 1279: cards empilham (imagem em cima);
- até 1023: título dos depoimentos quebra linha, foto do Sobre menor;
- até ~900: a faixa de clientes desce para baixo do título;
- até 859: menu principal escondido;
- até 767: listas em uma coluna, foto do CTA oculta.

Sem rolagem lateral medida em 1440, 1366, 1280, 1024, 768 e 390px. No celular já existem o menu recolhível (botão de três barras abaixo de 860px) e a escala de letras do site atual (bloco `@media (max-width: 767px)` no fim do `main.css`, com `:root` na frente de cada regra; conferido na home em 360 e 390px em 14/09/2026: título dos vídeos com 28px e quebrado em 2 linhas, título do card 24px, etiqueta 18px, título de clientes 20px, nenhum texto passando da própria caixa e sem rolagem lateral. O `.section-title` tem altura fixa de 43px no desktop e `height: auto` no celular; sem isso, a 2ª linha do título dos vídeos passava 31px por cima das capas). Espaçamentos próprios de celular continuam pendentes. Ao criar ou mudar um `font-size` de desktop na home, pôr a versão de celular nesse bloco.

## Smoke test

- 67 imagens (6 são a cópia da faixa de clientes), nenhuma quebrada; nenhuma resposta com status ≥ 400; console sem erros.
- Faixa de clientes: anda ~36px/s (1083px em 30s); cada cópia da lista cobre a faixa em 1440, 1366, 1280, 1024, 768 e 390px, sem vão na emenda e sem rolagem lateral.
- Vídeos em funcionamento: seção de 531px de altura entre Produtos e Projetos especiais; três capas de 405×228 em x 80, 517 e 955, com 32px entre elas; miniaturas e play carregam; o clique troca a capa pelo player do `youtube-nocookie.com`; sem rolagem lateral e sem erro no console. Conferido por HTTP em 12/09/2026 — aberto direto do disco (`file://`) o YouTube recusa o player com "erro 153", que é da origem nula, não do código.
- Cabeçalho fixo (parte comum, 14/09/2026): rolando a home em 1440×900, o cabeçalho (sticky, z-index 100, 72px) fica por cima da faixa de logos, das etiquetas e setas das galerias, da foto do Totem, dos vídeos, da foto de Projetos, do carrossel de depoimentos e do botão do CTA final; a âncora `#videos` para em y 72, logo abaixo dele. Qualquer z-index novo na home precisa ficar abaixo de 100.
- Estados de hover, clique e foco: conferidos em 11 botões e links (menu, "Fale conosco", CTAs do topo, do card, final e do rodapé, setas da galeria e dos depoimentos, ponto do carrossel, rede social e link do rodapé). Em repouso, home e Quem somos continuam pixel a pixel iguais à versão anterior; só a faixa de clientes muda, porque anda sozinha.
- Carrossel de depoimentos: gira sem fim (4 cards + 4 cópias no trilho), avança 437px por clique; os pontos acompanham 1→2→3→4→1, a seta "anterior" no primeiro leva ao quarto, não sobra espaço vazio na direita e o console fica limpo. Anda sozinho a cada 5s quando está na tela e para com o mouse em cima (conferido em 12/09/2026).
- Galerias dos cards de produto: Dilacerador com 4 fotos e Torniquete com 3; as setas trocam a foto e giram sem fim (da última volta à primeira e vice-versa), as fotos trocam sozinhas a cada 5s e param com o mouse em cima; nenhuma seta fica apagada e o console fica limpo. A troca desliza: a foto que sai anda para o lado com a etiqueta junto enquanto a próxima entra (0,45s). Numa rajada de 3 cliques em menos de meio segundo aparecem no máximo 2 fotos ao mesmo tempo, a que sai e a que entra, e em 1s assenta na foto certa (antes apareciam as 4; o Mestre corrigiu o `main.js` em 12/09/2026 depois do meu aviso). Conferido em 12/09/2026. A etiqueta com o nome vem logo depois de cada foto no HTML e só a da foto ativa aparece (regra no bloco Produtos do `main.css`).
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

- Nenhuma. Os botões "Consulte os modelos" dos cards de produto passaram a abrir a página de cada produto em 13/09/2026, a pedido do usuário: Dilacerador → `dilacerador-de-pneus.html`, Torniquete → `torniquete.html`, Totem → `controle-de-acesso.html`.

## Ferramentas

- `node tools/serve.mjs`: servidor estático sem cache (porta 5500).
- `tools/shot.ps1`: screenshot headless em 1440px.
- `tools/pixeldiff.ps1`: divergência e deslocamento por região.
- `tools/extents.ps1`: posição de textos, bordas e blocos.
- `tools/overlay.js`: sobreposição do PNG do Figma na página (`?overlay`).
