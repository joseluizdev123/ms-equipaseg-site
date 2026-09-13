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

Altura total: Figma 8051,12px, site 8160px (ver diferenças). O hero começa na mesma linha do Figma, mas ficou 13px mais alto: a linha de botões passou de 59px para 72px com os botões no padrão do site. A faixa "Nossos clientes", que não existe no frame, soma mais 104px, e os textos novos dos modelos tiram 8px. Por isso a faixa começa 13px abaixo do fim do hero do Figma, as seções seguintes descem 117px e, depois dos modelos, 109px. As divergências por seção acima são de 11/09/2026: diferenciais, "Em destaque" e modelos mudaram de texto em 13/09/2026 e não foram medidos de novo.

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px (itens em x 479, 600, 722, 831) | 32px, como na home | o site tem um header só; decisão pendente com o usuário, igual à da Quem somos |
| Item atual do menu | sem marcação | sem marcação | o frame desta página não traz o traço amarelo; mantido igual ao Figma |
| Fim das linhas em Inter | — | +1 a +4px | métricas da Inter do Google Fonts; quebras iguais |
| Botões do topo e do "Em destaque" | retangulares (`btn-solid` e `btn-ghost`), como no frame | padrão das outras páginas: "Solicitar cotação" `cta` 244×72, "Saber mais" `cta cta--claro` 160×72, "Saber mais sobre" `cta cta--67` 244×67 | pedido do usuário em 13/09/2026: os botões destoavam do resto do site; a página ficou 13px mais alta, toda essa diferença vem da linha de botões do hero (59px → 72px), igual no Projetos |
| Fotos do "Em destaque" e dos modelos | mostram o dilacerador | iguais ao Figma | o Figma usa a foto do dilacerador como provisória nos cards do torniquete; conteúdo a trocar |
| Textos do "Em destaque" | "…alta segurança. de alto risco." e "Lorem ipsum dolor sit amet" ×3 | a descrição do hero da página do Dilacerador e os 3 primeiros itens de "Diferenciais dos nossos dilaceradores"; o 2º item ocupa 2 linhas | pedido do usuário (13/09/2026): usar os textos da página do Dilacerador, como no card "Lançamento" do Projetos. A seção manteve 835px |
| Textos dos modelos | "Botoeira, controle de acesso…" repetido | Simples com o texto do modelo Embutido e Duplo com o do Lombada – Garra dupla, ambos da página do Dilacerador; títulos mantidos | pedido do usuário (13/09/2026). O texto do Duplo tem 3 linhas e o do Simples, 4: os cards esticam até a mesma altura e a faixa preta desce para o pé (`torniquete.css`). A seção ficou 8px mais baixa |
| Espaço entre título e texto no Duplo | 24px (só neste card; o Simples usa 8px) | 8px nos dois | pedido do usuário (13/09/2026): os textos dos dois cards começam na mesma linha |
| Card preto dos diferenciais | um parágrafo: "Construção estrutural totalmente em alumínio com pintura eletrostática, para ambientes de atmosfera agressiva (Região litorânea)." | título "Estrutura toda em alumínio" (Exo 24/32, branco) e texto de apoio em `--gray-03`: "Com pintura eletrostática, resiste a ambientes de atmosfera agressiva, como regiões litorâneas." | pedido do usuário (13/09/2026): o parágrafo único pesava no card. Regra em `torniquete.css`, presa a `.bento-card--escuro`; o card manteve 416px |
| Faixa "Nossos clientes" | não existe neste frame | faixa igual à do Dilacerador (`5293:1883`), logo depois do hero | pedido do usuário em 12/09/2026; a página ficou 104px mais alta |
| Botão dos cards de modelo | "Baixar manual" | "Baixar informações" com seta, `cta cta--xs` de 188px como no Dilacerador (13/09/2026); abre a lista Manual, Catálogo e Infraestrutura civil e elétrica | pedido do usuário em 12/09/2026, feito pelo chat do Dilacerador nas 3 páginas com cards de modelo; os links ficam em `#` até chegarem os arquivos |

## Imagens

As fotos com recorte no Figma (hero, "Em destaque" e modelos) foram baixadas **já recortadas**: as dos cards como nó exportado em 2x (`5277:2695`, `5277:2736`) e a do hero com `imageRef` + `cropTransform`. Sem isso, o `object-fit: cover` dá outro enquadramento (a diferença passava de 7%).

## Abaixo de 1440px

Sem rolagem lateral em 1440, 1425 (com a barra de rolagem), 1366, 1280, 1024, 768 e 390px. Os cards dos diferenciais ficam numa grade de 3 colunas que encolhe até 1024px, onde passa a 2 colunas; até 767px, uma coluna. Os cards de modelos empilham a partir de 1023px.

## Smoke test

Console sem erros. Ícones e fotos novos: `icon-escudo.svg`, `icon-escudo-claro.svg`, `icon-whatsapp-24.svg`, `shape-foto.svg` e as fotos `torniquete-*` em `assets/seed/`.
