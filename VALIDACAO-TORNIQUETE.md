# Torniquete — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Produtos > Torniquete** (`5235:708`). Medições de 11/09/2026, com o método do `VALIDACAO.md`.

- Página: `torniquete.html`. Sobreposição do Figma: `torniquete.html?overlay`.
- Referência: `_ref/torniquete-figma.png` (1440×8052). Screenshot: `_ref/torniquete-site.png`. Comparativos: `_ref/diff/torniquete-*.png`.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento |
|---|---|---|---|---|
| 1 | Header | `5235:709` | 3,05% | 0, 0 |
| 2 | Hero | `5253:1499` | 1,72% | 0, 0 |
| 3 | Diferenciais do produto | `5253:1679` | 1,61% | 0, 0 |
| 4 | Em destaque | `5277:2692` | 1,55% | 0, 0 |
| 5 | Outros modelos | `5277:2731` | 1,38% | 0, 0 |
| 6 | Instalações | `5277:2771` | 0,50% | 0, 0 |
| 7 | Possibilidades de aplicação | `5253:1772` | 1,20% | 0, 0 |
| 8 | Depoimentos | `5253:1822` | 2,51% | 0, 0 |
| 9 | Perguntas frequentes | `5253:1906` | 2,67% | 0, 0 |
| 10 | CTA | `5253:1905` | 0,67% | 0, 0 |
| 11 | Footer | `5235:1281` | 2,15% | 0, 0 |

Altura total: Figma 8051,12px, site 8051px. Cada seção começa na mesma linha do Figma. A divergência que sobra é rasterização de texto.

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px (itens em x 479, 600, 722, 831) | 32px, como na home | o site tem um header só; decisão pendente com o usuário, igual à da Quem somos |
| Item atual do menu | sem marcação | sem marcação | o frame desta página não traz o traço amarelo; mantido igual ao Figma |
| Fim das linhas em Inter | — | +1 a +4px | métricas da Inter do Google Fonts; quebras iguais |
| Botão "Saber mais sobre" | 213px | 211,9px | largura do rótulo em Inter |
| Fotos do "Em destaque" e dos modelos | mostram o dilacerador | iguais ao Figma | o Figma usa a foto do dilacerador como provisória nos cards do torniquete; conteúdo a trocar |
| Texto do "Em destaque" | "…alta segurança. de alto risco." | igual ao Figma | erro de digitação do arquivo, mantido |
| Textos dos modelos | "Lorem ipsum" e "Botoeira, controle de acesso…" repetido | iguais ao Figma | conteúdo provisório |

## Imagens

As fotos com recorte no Figma (hero, "Em destaque" e modelos) foram baixadas **já recortadas**: as dos cards como nó exportado em 2x (`5277:2695`, `5277:2736`) e a do hero com `imageRef` + `cropTransform`. Sem isso, o `object-fit: cover` dá outro enquadramento (a diferença passava de 7%).

## Abaixo de 1440px

Sem rolagem lateral em 1440, 1425 (com a barra de rolagem), 1366, 1280, 1024, 768 e 390px. Os cards dos diferenciais ficam numa grade de 3 colunas que encolhe até 1024px, onde passa a 2 colunas; até 767px, uma coluna. Os cards de modelos empilham a partir de 1023px.

## Smoke test

Console sem erros. Ícones e fotos novos: `icon-escudo.svg`, `icon-escudo-claro.svg`, `icon-whatsapp-24.svg`, `shape-foto.svg` e as fotos `torniquete-*` em `assets/seed/`.
