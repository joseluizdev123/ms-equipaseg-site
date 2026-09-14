# Contato — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Contato** (`5235:876`). Medições de 11/09/2026, com o método do `VALIDACAO.md`.

- Página: `contato.html`. Sobreposição do Figma: `contato.html?overlay`.
- Referência: `_ref/contato-figma.png` (1440×3052). Screenshot: `_ref/contato-site.png`. Comparativos: `_ref/diff/contato-*.png`.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento |
|---|---|---|---|---|
| 1 | Header | `5235:877` | 3,05% | 0, 0 |
| 2 | Hero com formulário | `5254:467` | 1,58% | 0, 0 |
| 3 | Depoimentos | `5284:1443` | 2,58% | 0, 0 |
| 4 | Mapa | `5254:670` | 1,81% | 0, 0 |
| 5 | Footer | `5235:1280` | 3,52% | 0, 0 |

Altura total: Figma 3051,12px, site 3051px. As bordas entre seções caem nas mesmas linhas do Figma (hero termina em 1034, mapa começa em 1818, rodapé em 2386). A divergência que sobra é rasterização de texto.

Rechecada em 12/09/2026, depois das mudanças de parte comum (navegação, header mobile e carrossel): página inteira em 1,754% de divergência real, deslocamento 0, 0; a faixa dos depoimentos continua em 2,584%. Screenshot novo em `_ref/contato-site.png`, comparativo da faixa em `_ref/diff/contato-depoimentos-infinito2.png`.

Dados de contato reais (12/09/2026): com o endereço mais longo, o hero passou de 1,49% para 1,58% (a segunda linha do endereço ficou maior) e o mapa de 0,43% para 1,82% (o cartão cresceu 130px, então o texto e o botão saíram do lugar do Figma). Página inteira em 2,047%, deslocamento 0, 0. Comparativos em `_ref/diff/contato-hero-dados-reais.png` e `_ref/diff/contato-mapa-dados-reais.png`. O `CEP` e o número vão juntos por `&nbsp;`, para não quebrarem no meio.

Texto real do rodapé (13/09/2026, já na segunda versão, que cita os totens): o parágrafo passou de 4 para 5 linhas e o rodapé continua com 665px. A divergência do rodapé foi de 2,15% para 3,52%, concentrada nas linhas do parágrafo e logo abaixo dele (y 2607–2822); página inteira em 2,339%, deslocamento 0, 0. Comparativo em `_ref/diff/contato-rodape-texto-real.png`. Em 360px não há rolagem lateral e o "© 2025 MS Equipaseg…" quebra em 2 linhas.

Cuidado com os screenshots: numa das execuções do `tools/shot.ps1` a fonte Exo não carregou e o texto saiu em fonte do sistema. Os números subiram só nas áreas de texto (depoimentos 3,88%, hero 1,95%). Se um número pular assim, confira o título dos depoimentos no PNG e tire outro screenshot.

Medidas conferidas no navegador: formulário 624×750, campos 544×45, mensagem 544×100, botão "Enviar" 117,3×59 (118 no Figma), cartão do mapa 905×77 (775 no Figma, que tem o endereço sem CEP), botão "Ver no maps" 130,9×45 (131).

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px | 32px, como na home | o site tem um header só; mesma decisão pendente das outras páginas internas |
| Menu do header e rodapé | 5 itens simples | "Produtos" com seta e submenu (Dilacerador, Torniquete, Controle de acesso) e "Projetos" como aba própria | navegação do site ligada pelo Mestre em 12/09/2026; parte comum a todas as páginas |
| Telefone e endereço | (11) 99111-1111, endereço sem CEP | (11) 5667-9440, CEP 04809-260 | dados reais do site atual (https://equipaseg.com.br), autorizados pelo usuário em 12/09/2026; o cartão do mapa cresce de 775 para 905px para o endereço caber numa linha |
| Texto do rodapé | lorem ipsum em 4 linhas | "Fabricamos torniquetes, dilaceradores de pneus…" em 5 linhas | texto real pedido pelo usuário em 13/09/2026 (parte comum, nas 8 páginas); a altura do rodapé continua 665px |
| Seta "anterior" dos depoimentos | apagada no primeiro card | ativa desde o começo | carrossel infinito (parte comum, 12/09/2026): do primeiro card dá para voltar ao último |
| Faixa à esquerda dos depoimentos | fundo #F7F7F7 | fim do card anterior, 48×352px, branco | carrossel infinito dos dois lados (parte comum, 12/09/2026); são 8 tons de diferença, abaixo da tolerância do diff: a seção continua em 2,584% |
| Larguras dos botões | 118 e 131px | 117,3 e 130,9px | largura do rótulo em Inter |
| Campos do formulário | textos de exemplo dentro da caixa | `placeholder` de verdade, com `<label>` acima | mesmo desenho, mas acessível e digitável |
| Envio do formulário | — | ainda não envia | falta o destino (WordPress, e-mail ou serviço); hoje o botão só valida o HTML |
| Ilustração | frame com brilho | PNG exportado do nó (515×322) posicionado na caixa de 308px | o brilho passa da caixa no Figma |

## Abaixo de 1440px

Sem rolagem lateral em 1440, 1425 (com a barra de rolagem), 1100, 1024, 900, 844×390 (celular deitado), 768 e 390px. Até 1279px a coluna de contatos e o formulário dividem a linha e depois empilham; o endereço do cartão do mapa quebra linha quando não cabe (de 1024px para baixo fica em 2 linhas) e até 767px o cartão vira coluna.

Header mobile (parte comum, 12/09/2026): até 859px ficam logo + botão de menu. Conferido nesta página em 859 e 390px — o menu abre com todos os links, o submenu de Produtos e o "Fale conosco", sem rolagem lateral. Em 1440, 1425 e 1024px o header continua igual, com o botão escondido.

Corrigido (14/09/2026), a pedido do usuário: desde o endereço com CEP, entre 768 e cerca de 1020px o endereço não quebrava linha e empurrava o botão "Ver no maps" para fora do cartão — em 844×390 a página rolava 100px para o lado e em 768px, 171px. O cartão agora é centralizado pelas margens (`left: calc(var(--section-px) + 1px); right: var(--section-px); width: fit-content; margin-inline: auto`, sem `transform` nem `max-width`) e o endereço tem `min-width: 0`, sem `nowrap`. Conferido em 1440, 1100, 1024, 900, 844×390, 768 e 390px: nada passa da tela e o botão fica 24px dentro do cartão. Em 1440 o cartão continua 905,1×77 em x 260,4; o mapa foi de 1,818% para 1,812% e a página inteira de 2,339% para 2,338%. Entre o screenshot de antes e o de depois mudaram só 259px (0,006%), de suavização do texto e do botão dentro do cartão, sem deslocamento. Comparativo em `_ref/diff/contato-mapa-botao-corrigido.png`.

## Smoke test

Console sem erros. Ícones novos: `icon-email.svg`, `icon-endereco.svg`, `icon-whatsapp-contato.svg`, `icon-pin.svg`. Imagens novas: `mapa.png` e `contato-ilustracao.png`.

O mapa é a imagem do Figma, não um mapa interativo; o botão "Ver no maps" abre o Google Maps no endereço.

Depoimentos (carrossel comum, 12/09/2026): gira sem fim e anda sozinho a cada 5s. Conferido nesta página em 1440px, pelos cliques: 4 pontinhos para 4 depoimentos (o último card acende o último ponto), do último card passa para o primeiro, do primeiro volta para o último e o clique no ponto leva ao card certo. As duas setas ficam ativas. O passeio automático não foi exercitado aqui porque o painel do Browser estava escondido — a página fica `visibilityState: hidden` e o carrossel para fora da tela, como previsto.

Avatares dos depoimentos: claros (#ffde59) nesta página, pela regra própria `.depoimentos--contato .depoimento__avatar` do `contato.css` — é o que o Figma da Contato mostra nos quatro cards. As outras páginas ficaram com o amarelo forte, ajuste que o usuário pediu na home; decisão de 12/09/2026: cada página segue o Figma dela.

Cabeçalho fixo (parte comum, 14/09/2026): conferido nesta página em 1440 e 844×390, rolando pelo hero, depoimentos, setas do carrossel, cartão do mapa e rodapé — o cabeçalho fica no topo e nada passa por cima dele. O `#formulario` para em 72px, logo abaixo do cabeçalho. O `contato.css` não usa `z-index`.
