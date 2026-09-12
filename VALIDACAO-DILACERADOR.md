# Dilacerador de Pneus — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Produtos > Dilacerador de Pneus** (`5235:496`). Medições de 11/09/2026, com o método do `VALIDACAO.md`.

- Página: `dilacerador-de-pneus.html`. Sobreposição do Figma: `dilacerador-de-pneus.html?overlay`.
- Referência: `_ref/dilacerador-de-pneus-figma.png` (1440×7611, exportada com `get_screenshot`). Screenshot: `_ref/dilacerador-de-pneus-site.png`. Comparativos: `_ref/diff/dilacerador-de-pneus-*.png`.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento | Observações |
|---|---|---|---|---|---|
| 1 | Header | `5235:497` | 3,05% | 0, 0 | logo e botão iguais; menu em "Diferenças justificadas" |
| 2 | Hero | `5241:427` | 1,91% | 0, 0 | título, as 4 linhas do texto e os dois botões nas mesmas posições |
| 3 | Nossos clientes | `5293:1883` | 9,89% | 0, 0 | logos em movimento, como na home |
| 4 | Diferenciais | `5330:679` | 1,31% | 0, 0 | 9 itens com ícones e quebras iguais |
| 5 | Modelos disponíveis | `5253:1429` | 2,00% | 0, 0 | quebras iguais; o bloco do manual fica na mesma altura nos dois cards |
| 6 | Instalações | `5241:591` | 0,59% | 0, 0 | fotos, setas e pontos |
| 7 | Possibilidades de aplicação | `5277:2575` | 1,57% | 0, 0 | quebras dos cards iguais |
| 8 | Depoimentos | `5241:593` | 2,55% | 0, 0 | título de 40px; avatares em amarelo claro |
| 9 | Perguntas frequentes | `5250:1139` | 2,38% | 0, 0 | 4 perguntas com quebras iguais |
| 10 | CTA | `5241:676` | 0,67% | 0, 0 | igual à home |
| 11 | Footer | `5235:1166` | 2,16% | 0, 0 | igual à home |

Altura total: Figma 7610,12px, site 7610px. A divergência que sobra é rasterização de texto.

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px | 32px, como nas outras páginas | o site tem um header só. Decisão pendente com o usuário (a mesma da Quem somos) |
| Item ativo do menu | nenhum | nenhum | igual ao Figma; "Produtos" ainda leva à home |
| Faixa "Nossos clientes" | logos parados em 952px | logos rodando, como na home | pedido do usuário na home |
| Seta da 2ª pergunta | 2px mais baixa (centralizada na linha) | no topo, como as outras | inconsistência do arquivo |
| Perguntas frequentes | todas abertas | abrem e fecham (`<details>`), começam abertas | interação esperada numa FAQ |
| Galeria "Instalações" | 6 fotos | 7 fotos: a 2ª é uma instalação real enviada pelo usuário (`instalacao-cancela-2.jpg`) | pedido do usuário; os 4 pontos do Figma continuam iguais |
| "Garra dupla" | sem foto, texto "Descrição" | foto do modelo duplo, a mesma da página inicial (`duplo.png`) | pedido do usuário; o texto da descrição continua pendente |
| "Baixar manual" | — | link `#` | arquivo do manual pendente |
| 1425px úteis (barra de rolagem do Windows) | — | a 2ª resposta das perguntas quebra em 2 linhas | faltam 15px na caixa; com 1440px úteis fica igual |

## Abaixo de 1440px

Sem rolagem lateral em 1440 (com barra), 1366, 1024, 768 e 390px. Com a barra de rolagem, diferenciais e modelos mantêm 3 e 2 colunas. Até 1023px: diferenciais em 2 colunas, modelos em 1 e FAQ empilhada; até 767px: diferenciais em 1 coluna.

Abaixo de ~1360px o 3º card dos depoimentos fica cortado na borda, porque os cards têm 405px fixos do Figma. A página inicial faz igual; o usuário viu e pediu para deixar como está.

## Smoke test

- 46 imagens com resposta 200; console sem erros.
- Galerias: avançam 437px por clique; pontos e setas atualizam. Perguntas abrem e fecham.
- Arquivos novos: fotos em `seed/` (`dilacerador-hero.jpg`, `instalacao-cancela.jpg`, `instalacao-cancela-2.jpg`, `aplicacao-*.jpg`, `modelo-embutido.png`, `modelo-lombada.png`) e SVGs em `images/` (`icon-fence.svg`, `icon-arrow-down-up.svg`, `icon-bell-electric.svg`, `icon-app-window-mac.svg`, `icon-car.svg`, `icon-siren.svg`, `icon-cctv.svg`, `icon-circuit-board.svg`, `icon-chevron-left-dim.svg`, `icon-chevron-down-gray.svg`, `cta-shape-white-160.svg`, `cta-shape-142.svg`, `pattern-elipses-modelo.svg`, `faq-ilustracao.svg`).
