# Handoff — site MS Equipaseg em HTML estático

Atualizado em 11/09/2026.

## Objetivo agora

Implementar em HTML/CSS, fiel ao Figma em 1440px, as páginas do site institucional da MS Equipaseg. O tema WordPress fica para o fim.

## Decisões do usuário

- Só páginas em HTML estático por enquanto. Os arquivos `theme/ms-equipaseg/*.php` e o `MODEL.md` ficam parados até o usuário pedir o WordPress. Se a skill `figma-to-pixel-perfect-v2` for usada, trate como "só estático".
- Uma coisa por vez: mostrar cada página (link local) assim que ficar pronta e recolher ajustes antes de seguir.
- Mensagens curtas, em português simples. Antes de etapa longa (ferramenta nova, conferência detalhada, refatoração), explicar o plano em 2–3 linhas e esperar o ok.
- Nível de conferência: perguntar no início. Padrão sugerido: comparação visual lado a lado e medida dos alinhamentos principais. Diff pixel a pixel só quando o usuário pedir ou algo parecer fora.
- Mobile: pendente. O Figma só tem desktop; não criar layout mobile dedicado sem decisão.
- Chats em paralelo: o Mestre faz as páginas novas e cada página pronta ganha um chat filho para ajustes. Sessões abertas, escopo das mudanças e regras de edição simultânea em `CHATS.md` — ler antes de editar.

## Figma

- Arquivo: https://www.figma.com/design/I7qYIaCi6nFLVWPiu9y1Un/MS-Equipaseg---Site-Institucional (`fileKey` `I7qYIaCi6nFLVWPiu9y1Un`). Os frames das páginas ficam na página "Design - Desktop V2" (`679:599`).
- Para listar os frames de 1440px: `use_figma` (skill `figma-use`) lendo `children` da página `679:599`. `get_metadata` na página volta vazio.
- O link do usuário pode apontar para um bloco dentro da página (ex.: "image" `5241:427`): suba até o frame da página antes de começar.
- Páginas: Página inicial `3047:6` (pronta), Quem somos `5235:27` (pronta), Produtos > Dilacerador de Pneus `5235:496` (pronta), Produtos > Torniquete `5235:708` (pronta), Projetos `5278:2809` (pronta — o frame se chama "Produtos > Torniquete", mas o hero diz "Projetos"), Contato `5235:876` (pronta). Frames soltos de seção: História `5241:552`; Informações técnicas `5241:483`, `5253:1513`, `5253:1606`.
- Componentes compartilhados: Header `7020:1080` (há outra variante, `5051:151`), CTA `5235:1048`, Footer `5235:1049`.

## Estado do projeto

| Caminho | O que é |
|---|---|
| `index.html` | Página inicial, 12 seções, conferida em 1440px |
| `VALIDACAO.md` | Medidas da home e diferenças já aceitas |
| `quem-somos.html` | Quem somos, 7 seções, conferida em 1440px |
| `VALIDACAO-QUEM-SOMOS.md` | Medidas da Quem somos e diferenças já aceitas |
| `dilacerador-de-pneus.html` | Produtos > Dilacerador de Pneus, 11 seções, conferida em 1440px |
| `VALIDACAO-DILACERADOR.md` | Medidas do Dilacerador e diferenças já aceitas |
| `torniquete.html` | Produtos > Torniquete, 11 seções, conferida em 1440px |
| `VALIDACAO-TORNIQUETE.md` | Medidas do Torniquete e diferenças já aceitas |
| `contato.html` | Contato, 5 seções com formulário e mapa, conferida em 1440px |
| `VALIDACAO-CONTATO.md` | Medidas do Contato e diferenças já aceitas |
| `projetos.html` | Projetos, 9 seções, conferida em 1440px |
| `controle-de-acesso.html` | Modelo da página do produto Controle de acesso (fora do Figma): mesmo escopo da Dilacerador (`5235:496`), com textos de exemplo e espaços de foto em cinza. Carrega o `dilacerador-de-pneus.css` |
| `produtos-alfa.html` | Modelo das páginas de produto que ainda não existem (fora do Figma): header, hero de exemplo, faixa de clientes, 4 blocos de produto com carrossel, CTA e rodapé. Textos de exemplo e espaço da foto em cinza |
| `VALIDACAO-PROJETOS.md` | Medidas do Projetos, o que difere do Torniquete e diferenças já aceitas |
| `theme/ms-equipaseg/assets/css/main.css` | CSS comum do site (tokens no `:root`) e blocos da home. O HTML aponta para este caminho; mantenha assim para o tema reaproveitar depois |
| `theme/ms-equipaseg/assets/css/quem-somos.css` | CSS da Quem somos |
| `theme/ms-equipaseg/assets/css/dilacerador-de-pneus.css` | CSS do Dilacerador; galeria de fotos e perguntas frequentes ficam no `main.css` |
| `theme/ms-equipaseg/assets/css/torniquete.css` | CSS do Torniquete: "Outros modelos", larguras das galerias e dos textos dos diferenciais |
| `theme/ms-equipaseg/assets/css/projetos.css` | CSS do Projetos: larguras da galeria e de um texto dos diferenciais |
| `theme/ms-equipaseg/assets/css/contato.css` | CSS do Contato (hero com formulário e mapa). Só esta página carrega a fonte Roboto, usada nos campos |
| `theme/ms-equipaseg/assets/js/main.js` | Galeria dos cards de produto e carrossel de depoimentos |
| `theme/ms-equipaseg/assets/images/` | Ícones e formas (SVG exportados do Figma) |
| `theme/ms-equipaseg/assets/seed/` | Fotos e logos |
| `theme/ms-equipaseg/*.php`, `MODEL.md` | Tema WordPress só da home, nunca executado — parado. Os bugs já encontrados numa revisão de código estão no fim do `MODEL.md` |
| `tools/` | Servidor e ferramentas de conferência (abaixo) |
| `_ref/` | PNG de referência do Figma (`page-full.png` = home) e comparativos em `_ref/diff/` |

## Rodar e conferir

```bash
node tools/serve.mjs
```

- Abre em http://localhost:5500, sem cache. No app, `.claude/launch.json` tem a configuração `equipaseg-estatico` com `autoPort`: se outro chat já usa a 5500, o servidor sobe noutra porta (o Browser de um chat não enxerga o servidor de outro).
- Referência do Figma: exportar o frame da página em 1x para `_ref/` com `download_figma_images` (`pngScale: 1`).
- Se o `download_figma_images` falhar com "fetch failed": referência com `get_screenshot` (`maxDimension` maior que a altura do frame) e `curl`; fotos e ícones pelas URLs do `get_design_context` com `curl`; SVG de um nó com `use_figma` e `exportAsync({ format: 'SVG_STRING' })`.
- Screenshot do site em 1440px: `powershell -ExecutionPolicy Bypass -File tools/shot.ps1 -Url http://localhost:5500/<pagina>.html -Out _ref/site-<pagina>.png -Height <altura do frame>`
- Diferença por região: `powershell -ExecutionPolicy Bypass -File tools/pixeldiff.ps1 -Figma _ref/<figma>.png -Site _ref/site-<pagina>.png -Y <y> -H <altura> -Out _ref/diff/<nome>.png`
- Posição de textos, bordas e blocos: `tools/extents.ps1` (uso no cabeçalho do arquivo).
- Sobreposição do Figma na página: `?overlay` na URL. O PNG vem do `data-overlay` do `<body>` (sem ele, `_ref/page-full.png`, da home).
- Compare com 1440px de largura útil: no Windows a barra de rolagem ocupa ~15px.

## Convenções

- Reusar tokens e componentes antes de criar novos: `.container`, `.section-title`, `.btn-outline`, `.cta` (`--67`, `--degrade`, `--dark`, `--sm`), `.feature-card`, `.feature-list`, `.feature-media`, `.arrow-btn`, `.site-header`, `.site-footer`.
- Header e footer idênticos em todas as páginas: copiar o markup do `index.html`. "Quem somos" aponta para `quem-somos.html`; Produtos e Projetos ainda apontam para âncoras da home (`./#produtos`, `./#projetos`). Ao criar páginas, apontar para os arquivos novos e marcar o item atual com `is-current` e `aria-current="page"`.
- Cada página nova tem CSS próprio em `theme/ms-equipaseg/assets/css/<pagina>.css`, carregado depois do `main.css`, com seções comentadas `/* Página · Seção — Figma <node> */` e classes curtas em português, no padrão atual. O que passar a se repetir entre páginas sobe para o `main.css`.
- Imagens do Figma: SVG para ícones; fotos em JPG redimensionadas para 2x do tamanho exibido.
- As regras fluidas abaixo de 1440px ficam no fim do `main.css`; qualquer ajuste ali não pode mudar a renderização em 1440px.

## Armadilhas do Figma (aprendidas na home)

- Line-height "auto" da Exo é arredondado pelo Figma para px inteiro. Use valores explícitos: 48→64px, 40→53px, 32→43px, 24→32px, 20→27px. Inter 15px × 1,5 → 23px.
- O traço do Figma é interno e não soma ao tamanho. No CSS, desconte a borda do padding (padding 12px com borda 1px → 11px).
- `get_design_context` pode trazer camadas escondidas (o hero tinha 3 fotos sobrepostas) e não exporta ajuste de cor de imagem (a foto do "Sobre" tinha tom sépia). Compare o tom da foto com o PNG do Figma.
- Imagem com `cropTransform`: baixar com `download_figma_images` passando `imageRef` e `cropTransform`, ou renderizar o nó em 2x sem `imageRef`.
- Larguras fixas de caixa de texto definem as quebras de linha; em itens curtos use `<br>` explícito.
- Posições absolutas de todos os nós: `get_metadata` no frame.
- O nome do frame engana: `5278:2809` se chama "Produtos > Torniquete" e é a página Projetos. Confira o título no hero antes de decidir que página é.
- O header de cada frame pode ser uma cópia desatualizada: na Quem somos o menu tem gap 24px; na home, 32px. O site usa um header só.
- Com a barra de rolagem do Windows a largura útil é 1425px: grades de largura fixa (3×405px, 3×296px, 2×616px) quebram linha — no flex, o `wrap` acontece antes de encolher. Use grid com colunas `minmax(0, <largura>)`.
- Foto com recorte no Figma (`scaleMode: CROP`): baixe já recortada — o nó exportado em 2x, ou `imageRef` + `cropTransform`. Reproduzir o recorte com `object-fit: cover` erra o enquadramento (passou de 7% de divergência no Torniquete).
- O Inter do navegador sai ~1% mais largo: numa caixa justa, a última palavra desce de linha. Confira as quebras com `extents.ps1` (modo cols, uma consulta por linha).
- Diferenças já aceitas: seção "Diferenças justificadas" de `VALIDACAO.md` (home), `VALIDACAO-QUEM-SOMOS.md`, `VALIDACAO-DILACERADOR.md`, `VALIDACAO-TORNIQUETE.md`, `VALIDACAO-CONTATO.md` e `VALIDACAO-PROJETOS.md`.

## Primeiros passos

1. Ler este arquivo, o `VALIDACAO.md` e o `CHATS.md`.
2. Correções da Página inicial: ficam com o chat filho dela (`CHATS.md`).
3. Listar as páginas do Figma e combinar com o usuário quais fazer e em que ordem.
4. Combinar o nível de conferência.
5. Para cada página: mapear as seções (node IDs), reaproveitar componentes, implementar, conferir no nível combinado e mostrar o link.
