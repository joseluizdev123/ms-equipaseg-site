# Quem somos — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Quem somos** (`5235:27`). Medições de 11/09/2026, com o método do `VALIDACAO.md`.

- Página: `quem-somos.html`. Sobreposição do Figma: `quem-somos.html?overlay`.
- Referência: `_ref/quem-somos-figma.png` (1440×3384). Screenshot: `_ref/quem-somos-site.png`. Comparativos: `_ref/diff/quem-somos-*.png`.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento | Âncoras (Figma = site, px) |
|---|---|---|---|---|---|
| 1 | Header | `5235:28` | 3,00% | 0, 0 | logo e botão iguais; menu em "Diferenças justificadas" |
| 2 | Hero | `5235:1044` | 2,47% | dx 1 (texto) | título y 204–249; linhas do texto y 198/225/252 |
| 3 | Nossa história | `5235:1478` | 4,00% | dx 1 (texto) | título y 502; 11 linhas nas mesmas posições e quebras |
| 4 | O que nos move | `5235:1481` | 3,03% | 0, 0 | borda y 858; cards y 1049–1312 e 1345–1608; bordas dos valores y 1179/1267/1355/1431/1519/1607 |
| 5 | Nossos números | `5235:1508` | 1,82% | 0, 0 | título y 1817; texto y 1891/1918/1945; rótulos x 150–348, 580–810, 1010–1213 |
| 6 | CTA | `5235:1050` | 0,67% | 0, 0 | igual à home |
| 7 | Footer | `5235:1051` | 2,15% | 0, 0 | igual à home |

Altura total: Figma 3383,12px, site 3383px. A divergência que sobra é rasterização de texto; História e O que nos move têm mais texto por área.

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px (itens em x 478, 598, 725, 834) | 32px, como na home (x 468, 597, 729, 845) | o site tem um header só e a home no Figma usa 32px. Decisão pendente com o usuário |
| Sublinhado do item ativo | x 598–699 | x 596–695 | acompanha o link, como na home |
| Fim das linhas em Inter | — | +1 a +5px | métricas da Inter do Google Fonts; quebras iguais |
| Descrição de "Comprometimento" | caixa de 446px | 6px de folga (`margin-right: -6px`) | sem a folga, o "e" desce de linha |
| Quadrados amarelos e caixas dos ícones 2 e 3 | posições fracionárias (43,23px; 514,67px) | bordas alinhadas ao pixel | arredondamento do Chrome |
| "+1.000 produtos fabricados" | este frame | igual ao Figma | a home diz "+100.000 produtos"; conteúdo a confirmar |
| Submenu de "Produtos" no menu | não existe neste frame | abre no hover e no foco do teclado, com Dilacerador de Pneus, Torniquete e Controle de acesso | navegação do site ligada pelo Mestre em 12/09/2026; em repouso fica escondido e não muda o desenho |
| Contatos do rodapé | telefone e e-mail de exemplo | dados reais do site atual: WhatsApp e telefone "11 5667-9440" e e-mail `email@msequipaseg.com.br` | rodapé comum atualizado pelo Mestre em 12/09/2026, com autorização do usuário; muda só as três linhas de contato (itens de 279×36px; a altura da página não mudou) |
| Hover, clique e foco | não existem no Figma | botões e links reagem ao mouse e o foco de teclado ganha anel amarelo | parte comum aprovada pelo usuário em 12/09/2026; em repouso nada muda |

## Abaixo de 1440px

Sem rolagem lateral em 1440, 1366, 1280, 1024, 768 e 390px. Até 1279px, missão e visão ficam acima dos valores e os números quebram em linhas; até 767px, os valores empilham. Abaixo de 860px o menu vira botão de três barras (header comum): conferido em 390px, abre e fecha no clique, sem rolagem lateral.

## Smoke test

Console sem erros. Ícones exportados do Figma para esta página: `icon-check-duplo.svg` (o desenho do `icon-check.svg`, 0,45px mais baixo) e `icon-numero-*-32.svg`.
