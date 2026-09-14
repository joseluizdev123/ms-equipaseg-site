# Projetos — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame `5278:2809`. O frame está nomeado "Produtos > Torniquete" no arquivo, mas é a **página Projetos**: o hero do Figma diz "Projetos". Medições de 11/09/2026, com o método do `VALIDACAO.md`, refeitas em 13/09/2026 depois dos ajustes de conteúdo pedidos pelo usuário.

- Página: `projetos.html`. Sobreposição do Figma: `projetos.html?overlay` (só bate até o fim do header: o hero cresceu e duas seções saíram).
- Referência: `_ref/projetos-figma.png` (1440×5898). Screenshot: `_ref/projetos-site.png` (1440×4400). Comparativos: `_ref/diff/projetos-*.png`.

## Resultado por seção

Cada seção foi recortada nas duas imagens a partir do próprio topo e comparada; em todas o melhor deslocamento é 0, 0.

| # | Seção | Node | Topo no Figma → no site | Divergência real |
|---|---|---|---|---|
| 1 | Header | `5278:2810` | 0 → 0 | 3,05% |
| 2 | Hero | `5278:2824` | 72 → 72 | não se compara: título, texto e botões novos (altura 500px → 631px) |
| 3 | Diferenciais do produto | `5278:2832` | 572 → 703 | 12,65% (card alto com foto; mesma altura, 747px) |
| 4 | Lançamento | `5278:2878` | 1319 → 1450 | 4,87% (textos e botão novos; mesma altura, 835px) |
| 5 | Outros projetos | `5278:2985` | 2154 → 2285 | 2,41% |
| — | Depoimentos | `5278:3030` | 3068 → retirada | — |
| — | Perguntas frequentes | `5278:3112` | 3852 → retirada | — |
| 6 | CTA | `5278:3167` | 4696 → 3199 | 0,67% |
| 7 | Footer | `5278:3168` | 5232 → 3735 | 3,52% (texto de apresentação novo, em 5 linhas) |

Altura total: Figma 5897,12px, site 4400px. A conta fecha: +131px do hero (+118px do título e do texto, +13px dos botões), −784px dos depoimentos e −844px das perguntas frequentes. Fora o hero, o card alto dos diferenciais, os textos e o botão do card "Lançamento" e o texto do rodapé, a divergência que sobra é rasterização de texto.

## O que difere da página Torniquete (`5235:708`)

| | Torniquete | Projetos |
|---|---|---|
| Hero | com recorte amarelo no canto | **sem** o recorte; título e texto próprios |
| Diferenciais | card alto com foto à esquerda | card alto com foto **à direita**, textos diferentes |
| Seção do dilacerador | "Em destaque" | "**Lançamento**", com os textos da página do Dilacerador |
| Galeria | "Instalações" + "Possibilidades de aplicação" | só "**Outros projetos**" (mesmas fotos e textos da segunda) |
| Outros modelos | 2 cards | não existe |
| Depoimentos e perguntas frequentes | têm | **não têm** (retiradas em 13/09/2026) |

As duas páginas usam os mesmos blocos do `main.css` (hero, diferenciais, foto de produto, card de destaque, galeria, CTA, rodapé); o Torniquete usa também depoimentos e perguntas frequentes.

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px | 32px, como na home | o site tem um header só; mesma decisão pendente das outras páginas internas |
| Título do hero | "Projetos", caixa de 492px | "Desenvolvimento de projetos personalizados", caixa de 610px (a largura do texto abaixo), em 2 linhas | pedido do usuário (13/09/2026). Em 492px o título ia para 3 linhas. Regra em `projetos.css`, presa a `.hero-produto--projetos` |
| Texto do hero | "Controle de acesso eficiente e seguro para diferentes ambientes…" (veio do Torniquete) | "Desenvolvemos projetos personalizados, criando soluções sob medida…", em 5 linhas | pedido do usuário (13/09/2026). Com o título, o texto e os botões novos, o hero passou de 500px para 631px |
| Botões do hero | "Solicitar cotação" amarelo e "Saber mais" com borda, 59px de altura | `cta` (244×72, ícone do WhatsApp escuro de 20px) e `cta cta--claro` (160×72), como no Dilacerador | pedido do usuário ao Mestre (13/09/2026): botões iguais aos das outras páginas. O hero cresceu 13px |
| Card alto dos diferenciais ("Passagem confortável, sem impactos ou travamentos") | branco, com ícone e o texto em cima | `bento-card--foto`: fundo escuro (`--color-media-dark`), foto `seed/produto-torniquete-mdduplo.jpg` de 296×268 em cima, até as bordas e com o pé esmaecido, e o texto em `--gray-03` no pé; sem ícone | pedido do usuário ao chat do Torniquete (13/09/2026), aplicado nas duas páginas. O card manteve 296×416 e a seção foi de 1,40% para 12,65% |
| Depoimentos e Perguntas frequentes | existem | retiradas | pedido do usuário (13/09/2026) |
| Textos do card "Lançamento" | "Lorem ipsum dolor sit amet" ×3 e "…alta segurança. de alto risco." | a descrição do hero da página do Dilacerador e os 3 primeiros itens de "Diferenciais dos nossos dilaceradores"; o 2º item ocupa 2 linhas | pedido do usuário (13/09/2026): usar os textos da página do Dilacerador. Com os textos, a seção foi de 1,55% para 4,24% e manteve a altura |
| Botão do card "Lançamento" | "Saber mais sobre" amarelo, 59px de altura | `cta cta--67` (244×67), como na home | pedido do usuário ao Mestre (13/09/2026): botões iguais aos das outras páginas. A seção foi de 4,24% para 4,87% e manteve a altura |
| Texto de "Outros projetos" | fala de torniquete | igual ao Figma | o texto veio da página do Torniquete |
| Foto do círculo no "Lançamento" | imagem própria deste frame | `projetos-circulo.png` | é uma imagem diferente da usada no Torniquete |
| Contatos do rodapé | telefones e e-mail de exemplo ("11 99999-8989", "11 3333-4444", `email@exemplo.com.br`) | dados reais do site atual: "11 5667-9440" no WhatsApp e no telefone, `email@msequipaseg.com.br` | o usuário autorizou os dados reais (parte comum, 12/09/2026) |
| Texto de apresentação do rodapé | lorem ipsum | "Fabricamos torniquetes, dilaceradores de pneus e totens, além de desenvolver projetos personalizados, com qualidade, inovação e agilidade para proteger sua empresa." | pedido do usuário (parte comum, 13/09/2026; o texto foi trocado duas vezes no mesmo dia). Em 1440px o parágrafo passou de 4 para 5 linhas; o rodapé manteve 665px e foi de 2,19% para 3,52% |
| Seta "anterior" da galeria | apagada | ativa | o carrossel gira sem fim, então nenhuma seta desliga (carrossel do `main.js`, 12/09/2026) |
| Faixa à esquerda de "Outros projetos" | fundo | fim da foto anterior | o carrossel gira sem fim nos dois sentidos, com uma cópia antes do trilho (carrossel do `main.js`, 12/09/2026); a seção foi de 1,16% para 2,41% |

## Abaixo de 1440px

Sem rolagem lateral em 1440, 1425 (com a barra de rolagem), 1024, 479, 430, 390 e 360px. Com os botões novos, conferido de novo em 1440, 390, 360 e 320px: em 390 e 360px os dois botões do hero ficam um embaixo do outro. Os diferenciais vão de 3 para 2 colunas em 1023px e para 1 coluna em 767px; o card de destaque empilha em 1279px. O card alto com foto ocupa a linha inteira em 1023px, com a foto de 296×268 centralizada, e fica com 342×356 em 390px.

Abaixo de 480px a fonte do título do hero acompanha a tela (`min(48px, (100vw - 48px) / 8.5)`), senão a palavra "Desenvolvimento" (390px em 48px) não cabe: fica com 40px em 390px e 45px em 430px.

Em 360px a rolagem lateral acabou em 13/09/2026: os créditos do rodapé, que passavam da tela, voltaram a quebrar linha (`main.css`, parte comum). Em 320px ainda sobram 24px: a forma amarela da foto do card "Lançamento" (`.foto-produto__shape`, 296px) termina em x = 344, e o texto de apresentação do rodapé passa 2px da tela. As duas são partes comuns (a largura fixa do texto do rodapé é 298px): ficam como pendência no `HANDOFF.md`, com o Mestre, até o usuário decidir se corrige a rolagem lateral no celular.

## Smoke test

Console sem erros (13/09/2026). A página reaproveita todas as imagens e ícones já baixados; só o círculo do card "Lançamento" é novo (`projetos-circulo.png`).

Cabeçalho fixo no topo (parte comum, 14/09/2026): conferido em 1440 e 390px, rolando por 9 posições da página, que nada passa por cima dele, e que a âncora `#outros-projetos` (link "Saber mais" do hero) para a galeria logo abaixo do cabeçalho (72px do topo em 1440px, 73px em 390px). A página não tem `z-index` próprio. Com a página parada, nada muda.

## Carrossel (12/09/2026)

Cada passo leva 0,7s com curva macia (`cubic-bezier(0.65, 0, 0.35, 1)`). A galeria "Outros projetos" (5 fotos) gira sem fim nos dois sentidos — há cópias das fotos antes e depois do trilho — e anda sozinha a cada 5s; para com o mouse em cima, com o teclado dentro, fora da tela e para quem pediu menos movimento. Conferido com o Chrome headless: em 13s anda 2 passos (3º pontinho aceso). Os 4 pontinhos ficam visíveis. O `tools/shot.ps1` força "menos movimento", então o screenshot sempre pega a galeria parada na primeira foto. Os depoimentos, que tinham o mesmo carrossel, saíram da página em 13/09/2026.
