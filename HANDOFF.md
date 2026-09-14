# Handoff — site MS Equipaseg em HTML estático

Atualizado em 11/09/2026.

## Objetivo agora

Implementar em HTML/CSS, fiel ao Figma em 1440px, as páginas do site institucional da MS Equipaseg. O tema WordPress fica para o fim.

## Decisões do usuário

- Só páginas em HTML estático por enquanto. Os arquivos `theme/ms-equipaseg/*.php` e o `MODEL.md` ficam parados até o usuário pedir o WordPress. Se a skill `figma-to-pixel-perfect-v2` for usada, trate como "só estático".
- Uma coisa por vez: mostrar cada página (link local) assim que ficar pronta e recolher ajustes antes de seguir.
- Mensagens curtas, em português simples. Antes de etapa longa (ferramenta nova, conferência detalhada, refatoração), explicar o plano em 2–3 linhas e esperar o ok.
- Nível de conferência: perguntar no início. Padrão sugerido: comparação visual lado a lado e medida dos alinhamentos principais. Diff pixel a pixel só quando o usuário pedir ou algo parecer fora.
- Mobile: o Figma só tem desktop. O header já tem versão mobile (pedido de 12/09/2026): abaixo de 860px ficam o logo e o botão de menu, que abre os links e o "Fale conosco". O resto do layout mobile continua pendente — não criar sem decisão.
- Avatares dos depoimentos: cada página segue o Figma dela. Na Contato os quatro são amarelo claro (`--color-yellow-pale`, regra no `contato.css`). Nas outras, o Figma traz o 4º card mais claro, mas com o carrossel girando esse card ficava pulando de posição e o usuário pediu para igualar tudo no `--color-yellow` (12/09/2026).
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
| `index.html` | Página inicial, 13 seções (a de vídeos veio do site atual, fora do Figma), conferida em 1440px. Blocos de produto: Dilacerador de Pneus, Torniquete e Totem |
| `VALIDACAO.md` | Medidas da home e diferenças já aceitas |
| `quem-somos.html` | Quem somos, 9 seções, conferida em 1440px até a História. Textos novos do briefing da cliente (12/09/2026): História com título e texto novos, e duas seções fora do Figma, Soluções e Por que escolher; página com 4735px. Layout novo aguardando o ok do usuário |
| `VALIDACAO-QUEM-SOMOS.md` | Medidas da Quem somos e diferenças já aceitas |
| `dilacerador-de-pneus.html` | Produtos > Dilacerador de Pneus, 11 seções, conferida em 1440px |
| `VALIDACAO-DILACERADOR.md` | Medidas do Dilacerador e diferenças já aceitas |
| `torniquete.html` | Produtos > Torniquete, 12 seções (a faixa "Nossos clientes" foi pedida pelo usuário e não está no frame), conferida em 1440px |
| `VALIDACAO-TORNIQUETE.md` | Medidas do Torniquete e diferenças já aceitas |
| `contato.html` | Contato, 5 seções com formulário e mapa, conferida em 1440px |
| `VALIDACAO-CONTATO.md` | Medidas do Contato e diferenças já aceitas |
| `projetos.html` | Projetos, 7 seções, conferida em 1440px. Desde 12/09/2026, a pedido do usuário: hero com título e texto novos, sem Depoimentos e sem Perguntas frequentes, e o card "Lançamento" com o texto e 3 diferenciais do Dilacerador |
| `controle-de-acesso.html` | Virou a página dos Totens para Controle de Acesso (fora do Figma), produto novo do briefing da cliente, no molde da página do Dilacerador (`5235:496`). Carrega o `dilacerador-de-pneus.css`. O nome do arquivo continua o antigo. Desde 14/09/2026 o item do menu diz "Totens para Controle de Acesso". Em 13/09/2026, a pedido do usuário: "Instalações" com as mesmas 13 imagens do Dilacerador e do Torniquete, "Possibilidades de aplicação" com os mesmos 5 cards do Torniquete e perguntas frequentes escritas com as informações do briefing |
| `produtos-alfa.html` | Página geral de produtos (fora do Figma): hero com o título e o subtítulo do site (foto ainda cinza), faixa de clientes, 3 blocos copiados da home (Dilacerador de Pneus, Torniquete e Totem de Acesso) com "Consulte os modelos" levando à página de cada um, CTA e rodapé |
| `VALIDACAO-PROJETOS.md` | Medidas do Projetos, o que difere do Torniquete e diferenças já aceitas |
| `theme/ms-equipaseg/assets/css/main.css` | CSS comum do site (tokens no `:root`) e blocos da home. O HTML aponta para este caminho; mantenha assim para o tema reaproveitar depois |
| `theme/ms-equipaseg/assets/css/quem-somos.css` | CSS da Quem somos |
| `theme/ms-equipaseg/assets/css/dilacerador-de-pneus.css` | CSS do Dilacerador; galeria de fotos e perguntas frequentes ficam no `main.css` |
| `theme/ms-equipaseg/assets/css/torniquete.css` | CSS do Torniquete: "Outros modelos", larguras das galerias e dos textos dos diferenciais |
| `theme/ms-equipaseg/assets/css/projetos.css` | CSS do Projetos: larguras da galeria e de um texto dos diferenciais |
| `theme/ms-equipaseg/assets/css/contato.css` | CSS do Contato (hero com formulário e mapa). Só esta página carrega a fonte Roboto, usada nos campos |
| `theme/ms-equipaseg/assets/js/main.js` | Carrosséis do site e abre/fecha do menu no mobile. Todos giram sem fim (cópias dos cards antes e depois do trilho, então entra card pelos dois lados) e andam sozinhos a cada 5s, parando com o mouse em cima, com o teclado dentro, fora da tela e para quem pediu menos movimento. Nas fotos dos cards de produto a troca desliza: uma sai para o lado enquanto a outra entra, com a etiqueta junto. Também troca a capa de vídeo (`data-video`) pelo player do YouTube no clique |
| `theme/ms-equipaseg/assets/images/` | Ícones e formas (SVG exportados do Figma) |
| `theme/ms-equipaseg/assets/seed/` | Fotos e logos |
| `fotos-para-o-site/` | Onde o usuário deixa as fotos da cliente, uma subpasta por página (fora do repositório). O Mestre redimensiona para 2x do tamanho exibido e copia para `assets/seed/`. Foto original solta na raiz entra no commit: mova para cá depois de converter |
| `theme/ms-equipaseg/*.php`, `MODEL.md` | Tema WordPress só da home, nunca executado — parado. Os bugs já encontrados numa revisão de código estão no fim do `MODEL.md` |
| `CONTEUDO-SITE-ATUAL.md` | O que o site no ar (https://equipaseg.com.br) tem e o novo não tem: o que já foi trazido e o que o usuário deixou parado |
| `tools/` | Servidor e ferramentas de conferência (abaixo) |
| `_ref/` | PNG de referência do Figma (`page-full.png` = home) e comparativos em `_ref/diff/` |

## Rodar e conferir

```bash
node tools/serve.mjs
```

- Abre em http://localhost:5500, sem cache. No app, `.claude/launch.json` tem a configuração `equipaseg-estatico` com `autoPort`: se outro chat já usa a 5500, o servidor sobe noutra porta (o Browser de um chat não enxerga o servidor de outro).
- Referência do Figma: exportar o frame da página em 1x para `_ref/` com `download_figma_images` (`pngScale: 1`).
- Se o `download_figma_images` falhar com "fetch failed": referência com `get_screenshot` (`maxDimension` maior que a altura do frame) e `curl`; fotos e ícones pelas URLs do `get_design_context` com `curl`; SVG de um nó com `use_figma` e `exportAsync({ format: 'SVG_STRING' })`.
- O `shot.ps1` força "menos movimento" no Chrome: os carrosséis ficam parados no primeiro card, então a conferência sempre compara a mesma posição.
- O `shot.ps1` roda um screenshot por vez entre todos os chats (uma trava do Windows; quem chega depois espera) e usa sempre o mesmo perfil do Chrome, que guarda as fontes do Google em cache. Não troque por um perfil novo a cada execução: a Exo às vezes não chega a tempo e o PNG sai com outra fonte, sem erro. Grava num arquivo temporário e só troca o PNG antigo se deu certo. Antes de registrar um número, confira no PNG se os títulos estão em Exo.
- Screenshot do site em 1440px: `powershell -ExecutionPolicy Bypass -File tools/shot.ps1 -Url http://localhost:5500/<pagina>.html -Out _ref/site-<pagina>.png -Height <altura do frame>`
- Diferença por região: `powershell -ExecutionPolicy Bypass -File tools/pixeldiff.ps1 -Figma _ref/<figma>.png -Site _ref/site-<pagina>.png -Y <y> -H <altura> -Out _ref/diff/<nome>.png`
- Carrossel: `_ref/teste-carrossel.html?pagina=/torniquete.html&alvo=.galeria__inner&i=0&n=6` abre a página num quadro de 1440px, dá N cliques (ou `dir=prev`) e escreve o estado em cima; capture com o `shot.ps1`. Fica fora do repositório.
- Posição de textos, bordas e blocos: `tools/extents.ps1` (uso no cabeçalho do arquivo).
- Sobreposição do Figma na página: `?overlay` na URL. O PNG vem do `data-overlay` do `<body>` (sem ele, `_ref/page-full.png`, da home).
- Compare com 1440px de largura útil: no Windows a barra de rolagem ocupa ~15px.

## Publicação

- Repositório: https://github.com/joseluizdev123/ms-equipaseg-site (público, branch `main`, conta `joseluizdev123`).
- Site no ar: https://joseluizdev123.github.io/ms-equipaseg-site/ — o GitHub Pages republica a cada push na `main`.
- `_ref/` fica fora do repositório (68MB de PNGs de conferência), então o `?overlay` só funciona local.
- Para publicar uma correção: `git add`, `git commit` e `git push`. Antes de dar push, rode `git pull --rebase`: vários chats mexem na mesma pasta.

## Convenções

- Reusar tokens e componentes antes de criar novos: `.container`, `.section-title`, `.btn-outline`, `.cta` (`--67`, `--degrade`, `--dark`, `--sm`), `.feature-card`, `.feature-list`, `.feature-media`, `.arrow-btn`, `.site-header`, `.site-footer`.
- Header e footer idênticos em todas as páginas: copiar o markup do `index.html`. Tipografia no celular (até 767px, pedido do usuário em 14/09/2026): mesma escala do site atual — 48→32, 40→28, 32→24, 24→20, 20→18, 18→16, 16→15px; 15px ou menos não muda; cabeçalho de fora. Exceção: o `.hero__title` (home e produtos-alfa) fica com 28px/37px no celular, porque o texto é longo. Com 32px ele tinha 8 linhas em 390px e o "Solicitar cotação" saía da primeira tela em 360px (pedido do usuário, 14/09/2026). Está no fim do `main.css`, num bloco gerado a partir de todas as regras de desktop, cada uma com `:root` na frente. Quem criar ou mudar um `font-size` de desktop precisa pôr a versão do celular nesse bloco (com `:root`), senão o texto fica no tamanho do computador no celular. O tamanho fluido do título do hero do Projetos abaixo de 480px (`min(32px, calc((100vw - 48px) / 8.5))`) só existe nesse bloco do `main.css`; o `projetos.css` guarda apenas o `line-height: 1.33`. Sem essa regra, "Desenvolvimento" passa da tela abaixo de 320px. Títulos com altura fixa do Figma precisam de `height: auto` abaixo de 768px, senão passam por cima do conteúdo quando quebram em duas linhas: já estão assim `.section-title`, `.destaque__title` (`main.css`) e `.modelo__title` (`dilacerador-de-pneus.css`). O header fica fixo no topo ao rolar (`position: sticky`, `z-index: 100`, pedido do usuário em 14/09/2026). O `html` tem `scroll-padding-top` de 72px (73px abaixo de 860px), para as âncoras pararem logo abaixo dele. Com o menu do celular aberto, o header vai no máximo até a altura da tela e rola por dentro. Nada que precise aparecer por cima do header pode ter `z-index` de 100 ou mais, exceto o "Pular para o conteúdo" (110) e o `?overlay` (9999). Todo botão "Solicitar cotação" abre o WhatsApp numa aba nova, como no site atual: `https://wa.me/551156679440?text=Ol%C3%A1!%20Vim%20do%20site%2C%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es` com `target="_blank" rel="noopener"` (pedido do usuário, 13/09/2026). Botão flutuante do WhatsApp nas 8 páginas (pedido do usuário, 14/09/2026, feito pelo chat da Página inicial):
  - Markup: `<a class="whatsapp-flutuante" href="https://wa.me/551156679440?text=..." target="_blank" rel="noopener" aria-label="Falar com a MS Equipaseg no WhatsApp">` com `icon-whatsapp-light.svg`, logo depois do `</footer>`. Página nova precisa levar esse trecho.
  - CSS: `.whatsapp-flutuante` no `main.css`, fixo, com `z-index: 90` (abaixo do header). Tem 60px a 24px das bordas; abaixo de 768px, 56px a 16px das bordas.
  - Ele some enquanto os créditos do rodapé estão na tela, porque cobria o "Desenvolvido por Artemis" de 768 a 1440px e em 320px. Isso é feito pela classe `.whatsapp-flutuante--escondido`, ligada por um IntersectionObserver no fim do `main.js`.
  - Nas capturas do `tools/shot.ps1` para comparar com o Figma, use a janela bem mais alta que a página (`-Height 12000`) e compare só a altura do frame (`-H <altura do frame>` no `pixeldiff.ps1`, ou recorte). Assim os créditos aparecem ao carregar e o botão some.
  - Testado em 14/09/2026: 0 pixels verdes no Projetos, nos Totens, na Home e no Contato.
  - Com pouca folga o botão ainda aparece. No Contato, a janela de 3052px (página de 3051px) ainda mostrou o botão. No Projetos com `-Height 4400`, ele ficou em y 4316 a 4374.

Celular igual ao site atual (pedido do usuário, 14/09/2026, feito pelo chat da Página inicial): texto primeiro e foto depois.
  - Até 1279px: `.feature-card` em `column`.
  - Até 767px, `.hero`: em coluna, com a foto embaixo, na proporção 390/340.
  - Até 767px, `.feature-media`: quadrada.
  - Até 767px, `.sobre`: em coluna, com a foto embaixo.
  - Até 767px, `.cta-final`: a foto aparece embaixo do botão e o quadradinho some.
  - Até 767px, rodapé: em coluna, com as redes em 2×2.
  - Os topos do Dilacerador e dos Totens (`produto-hero`) e do Torniquete e do Projetos (`hero-produto`) ainda deixam o título por cima da foto apagada. O chat da Página inicial vai perguntar ao usuário se eles devem seguir o mesmo padrão. O header tem o botão `site-header__toggle` (três barras) logo depois do logo: some no desktop e, abaixo de 860px, abre o menu e o "Fale conosco" (classe `is-open` no `.site-header`, regras no fim do `main.css`). "Quem somos" aponta para `quem-somos.html`; Produtos e Projetos ainda apontam para âncoras da home (`./#produtos`, `./#projetos`). Ao criar páginas, apontar para os arquivos novos e marcar o item atual com `is-current` e `aria-current="page"`.
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

## Pendências com o usuário

- Conteúdo do site atual: lista e decisões em `CONTEUDO-SITE-ATUAL.md`. Em 12/09/2026 ele liberou só os dados de contato (telefone, e-mail, endereço); vídeos, políticas, banner de cookies e o resto ficam parados.

- Espaço entre os itens do menu: 24px no Figma das páginas internas, 32px no site (o header é um só). Decisão dele; está no `VALIDACAO` de cada página interna.
- Nome da página de produtos: hoje `produtos-alfa.html`. Ele decide se renomeia para `produtos.html` — aí os links das 8 páginas mudam juntos.
- Formulário do Contato não envia: falta o destino (e-mail, serviço ou WordPress).
- Conteúdo provisório vindo do Figma (revisto em 14/09/2026):
  - os 4 depoimentos em latim ("Ut enim ad minim veniam…", "Nome cliente", "Cargo/Empresa") na home, no Dilacerador, no Torniquete, nos Totens e no Contato;
  - no Torniquete, o card "Em destaque" mostra o Dilacerador. Os cards "Simples" e "Duplo" usam foto e texto de dilacerador (veículos, garras), e a legenda da galeria "Instalações" fala de veículos;
  - nos Totens, o card de modelo se chama "Modelo 1";
  - "+1.000" na Quem somos contra "+100.000 produtos" na home.
- Imagens: todos os originais em `fotos-para-o-site/` (as 13 de instalação e o totem) têm a marca C2PA do gpt-image/OpenAI. São imagens geradas por IA, não fotos de obras. As cópias em `assets/seed/` perderam os metadados no JPG. Confirmar com o usuário/cliente antes de apresentá-las como "Instalações".
- Briefing da cliente (conferido em 14/09/2026). Falta material da cliente:
  - Manual e Infraestrutura civil e elétrica do Dilacerador;
  - descritivos do Torniquete;
  - catálogo dos Totens;
  - foto do Dilacerador unidirecional;
  - fotos de totens instalados;
  - fotos de projetos.
- Briefing da cliente. Falta decisão:
  - Dilacerador: o briefing tem 2 modelos (Bidirecional e Unidirecional), e o site tem 3 cards (Embutido, Lombada, Lombada – Garra dupla);
  - Projetos: a cliente pediu "somente texto e fotos", e ainda há Diferenciais e Outros projetos com texto de torniquete, além de Lançamento e CTA;
  - Quem somos: manter Missão, Visão, Valores e Números;
  - Torniquete: "Manual" e "Infraestrutura" no lugar dos descritivos;
  - Totens na coluna "Produtos" do rodapé.
- Mobile: só o header tem versão própria; o resto das seções continua no layout fluido, sem mobile dedicado.
- Tema WordPress: parado até ele pedir.
- Arquivos para baixar: o "Catálogo" da lista "Baixar informações" já abre o PDF da cliente no Dilacerador (`assets/docs/catalogo-dilacerador-de-pneus.pdf`, o folheto V2) e no Torniquete (`assets/docs/catalogo-torniquetes.pdf`, o folder), desde 13/09/2026. Ainda em `#`: Manual e Infraestrutura civil e elétrica nas três páginas, e o Catálogo dos Totens.
- Dilacerador — confirmar com a cliente: o texto oficial do Unidirecional (100% mecânico, sem energia elétrica) agora descreve o Embutido, mas o site atual mostra o Embutido como elétrico ("atua em 1 segundo").
- Nome do modelo com garra dupla: "Lombada – Garra dupla" na página do Dilacerador (igual ao site atual) e "Duplo" na galeria da home. Decidir se alinha.
- Favicon: o site não tem, e todas as páginas dão 404 em `/favicon.ico` no console. Falta escolher o ícone (dá para sair do logo).
- Nome do produto (decisão do usuário, 14/09/2026): é sempre "Totens para Controle de Acesso", em todo o site. Página nova segue o mesmo nome. Já trocado em:
  - menu Produtos das 8 páginas;
  - texto do rodapé das 8 páginas ("totens para controle de acesso");
  - home: h1, subtítulo, título e texto do card;
  - produtos-alfa: meta description, h1, subtítulo, título e texto do card;
  - página dos Totens: texto do topo.
  Ficaram como estavam:
  - "totem simples para duplo" nas listas, porque é o nome do modelo;
  - os `alt` das fotos;
  - "o totem" e "os totens" nas galerias, nos modelos e nas perguntas frequentes da página dos Totens, onde o assunto já está claro.
- Rolagem lateral no celular: corrigida em 14/09/2026 com o ok do usuário. Medida nas 8 páginas em 320, 360, 375, 390, 414 e 767px: tudo 0. Computador e tablet (1440 e 1024) ficaram iguais, com 0% de diferença. O que mudou, só abaixo de 768px:
  - `torniquete.css`: `.modelos-torniquete__grid` com `flex-wrap: nowrap`. Com wrap, a coluna de cards ficava com 588px.
  - `main.css`: `.foto-produto` segue a largura do card na proporção 515:500, e o recorte e o círculo encolhem junto. Vale para Torniquete e Projetos.
  - `main.css`: o círculo para 4px antes do recorte amarelo.
  - `main.css`: `.menu-baixar` encolhe até a faixa preta em telas de 320 a 355px.
  - `main.css`: `.site-footer__desc` virou `max-width: 298px`.
  - Página inicial (feito pelo chat dela): `.videos__lista` com `minmax(min(300px, 100%), 1fr)`. No celular, os `.numeros__item` perderam o traço da direita e o `.numeros__text` usa `pre-wrap`.
  - `main.js`: a lista do "Baixar informações" fica a pelo menos 8px das duas bordas da tela.
- Fotos de instalação: as galerias "Instalações" do Dilacerador, do Torniquete e dos Totens mostram as mesmas 13 fotos da cliente (`seed/instalacao-01.jpg` a `-13.jpg`, na numeração dela), com o mesmo visual escuro, a pedido do usuário em 13/09/2026. Ainda não há fotos só de totens.

## Primeiros passos

1. Ler este arquivo, o `VALIDACAO.md` e o `CHATS.md`.
2. Correções da Página inicial: ficam com o chat filho dela (`CHATS.md`).
3. Listar as páginas do Figma e combinar com o usuário quais fazer e em que ordem.
4. Combinar o nível de conferência.
5. Para cada página: mapear as seções (node IDs), reaproveitar componentes, implementar, conferir no nível combinado e mostrar o link.
