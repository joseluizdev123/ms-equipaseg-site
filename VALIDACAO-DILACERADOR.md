# Dilacerador de Pneus — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Produtos > Dilacerador de Pneus** (`5235:496`). Medições de 11/09/2026, com o método do `VALIDACAO.md`.

- Página: `dilacerador-de-pneus.html`. Sobreposição do Figma: `dilacerador-de-pneus.html?overlay`.
- Referência: `_ref/dilacerador-de-pneus-figma.png` (1440×7611, exportada com `get_screenshot`). Screenshot: `_ref/dilacerador-de-pneus-site.png`. Comparativos: `_ref/diff/dilacerador-de-pneus-*.png`.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento | Observações |
|---|---|---|---|---|---|
| 1 | Header | `5235:497` | 3,05% | 0, 0 | logo e botão iguais; menu em "Diferenças justificadas" |
| 2 | Hero | `5241:427` | 1,91% (antes do texto oficial) | 0, 0 | título e botões como no Figma; desde 12/09 o texto oficial do cliente ocupa 6 linhas em vez de 4, e o hero ficou 54px mais alto (594px) |
| 3 | Nossos clientes | `5293:1883` | 9,89% | 0, 0 | logos em movimento, como na home |
| 4 | Diferenciais | `5330:679` | 1,31% (com os 9 itens do Figma) | 0, 0 | desde 13/09 são 11 itens: a lista oficial do cliente mais 5 itens do Figma |
| 5 | Modelos disponíveis | `5253:1429` | 3,46% (antes dos textos oficiais) | 0, 0 | quebras iguais; o bloco do manual fica no fim de cada card; desde 12/09 o Embutido e a "Lombada – Garra dupla" têm os textos oficiais do Unidirecional e do Bidirecional |
| 6 | Instalações | `5241:591` | 24,53% | 0, 0 | a 2ª foto é a instalação real enviada pelo usuário, e as seguintes andaram uma casa; sem ela a seção dava 0,59% |
| 7 | Possibilidades de aplicação | `5277:2575` | 1,57% | 0, 0 | quebras dos cards iguais |
| 8 | Depoimentos | `5241:593` | 2,55% | 0, 0 | título de 40px; avatares em amarelo claro |
| 9 | Perguntas frequentes | `5250:1139` | 2,38% | 0, 0 | 4 perguntas com quebras iguais |
| 10 | CTA | `5241:676` | 0,67% | 0, 0 | igual à home |
| 11 | Footer | `5235:1166` | 2,16% | 0, 0 | igual à home |

Altura total: Figma 7610,12px. Site: 7610px com o conteúdo do Figma; desde 13/09, 7848px, com o texto oficial do hero (+54px), os textos oficiais nos modelos (+48px na linha da "Lombada – Garra dupla") e os 11 diferenciais (+136px: uma linha de itens a mais e o item dos módulos em 3 linhas). As medidas das seções depois do hero são de antes dessas mudanças. A divergência que sobra é rasterização de texto.

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px | 32px, como nas outras páginas | o site tem um header só. Decisão pendente com o usuário (a mesma da Quem somos) |
| Item ativo do menu | nenhum | nenhum | igual ao Figma; "Produtos" ainda leva à home |
| Faixa "Nossos clientes" | logos parados em 952px | logos rodando, como na home | pedido do usuário na home |
| Seta da 2ª pergunta | 2px mais baixa (centralizada na linha) | no topo, como as outras | inconsistência do arquivo |
| Perguntas frequentes | todas abertas | abrem e fecham (`<details>`), começam abertas | interação esperada numa FAQ |
| Galeria "Instalações" | 6 fotos | 7 fotos: a 2ª é uma instalação real enviada pelo usuário (`instalacao-cancela-2.jpg`) | pedido do usuário; os 4 pontinhos do Figma continuam, distribuídos pelas 7 fotos |
| Setas "anterior" dos carrosséis | apagadas no início | ativas desde o início | todos os carrosséis giram sem fim (`main.js`, pedido do usuário) |
| Faixa à esquerda dos carrosséis | fundo liso | ponta da foto/card anterior | os carrosséis giram sem fim dos dois lados (`main.js`, pedido do usuário) |
| Carrosséis parados | parados | andam sozinhos a cada 5s; param com o mouse em cima, com o teclado dentro, fora da tela e com "menos movimento" no sistema | pedido do usuário |
| "Garra dupla" | sem foto, texto "Descrição" | "Lombada – Garra dupla", como no site atual (equipaseg.com.br), com a foto do modelo duplo (`duplo.png`) e o texto oficial do Bidirecional | pedido do usuário |
| Textos dos modelos | Embutido com o texto do Figma; Garra dupla com "Descrição" | Embutido com o texto oficial do Unidirecional; "Lombada – Garra dupla" com o texto oficial do Bidirecional | o usuário considera que são os mesmos produtos. Confirmar com a MS Equipaseg: no site atual o Embutido é elétrico ("atua em 1 segundo") e o texto do Unidirecional diz 100% mecânico |
| Alinhamento do texto dos modelos | à esquerda | justificado; abaixo de 768px volta à esquerda, para não abrir buracos entre as palavras na coluna estreita | pedido do usuário; vale também para a página de Controle de acesso, que usa este CSS |
| Texto do rodapé | lorem ipsum | "Fabricamos torniquetes, dilaceradores de pneus e totens, além de desenvolver projetos personalizados, com qualidade, inovação e agilidade para proteger sua empresa.", em 5 linhas; o rodapé continua com 665px | parte comum, a pedido do usuário (13/09): primeiro o Mestre trouxe o texto do site atual e depois o chat da Página inicial acrescentou os totens |
| Diferenciais | 9 itens | 11 itens: primeiro os 6 da lista oficial do cliente, que substituem "portão e ou cancela", "laço detector", "Farol Verde Vermelho" e "Alerta de fechamento"; depois os 5 itens do Figma que não se repetem (controle de acesso, caixa de comando, alarme, CFTV, CLP). Ícones novos: régua (`icon-ruler.svg`) e chave (`icon-wrench.svg`); o escudo reaproveita `icon-escudo.svg` | pedido do usuário |
| Texto do hero | 4 linhas (texto do Figma) | texto oficial do cliente, em 6 linhas; o hero fica 54px mais alto | pedido do usuário |
| Botão dos cards de modelo | "Baixar manual", 142px | "Baixar informações" com seta, 188px, que abre a lista Manual, Catálogo e Infraestrutura civil e elétrica | pedido do usuário, igual no Torniquete e no Controle de acesso; os três arquivos ainda estão pendentes (links `#`) |
| 1425px úteis (barra de rolagem do Windows) | — | a 2ª resposta das perguntas quebra em 2 linhas | faltam 15px na caixa; com 1440px úteis fica igual |

## Abaixo de 1440px

Sem rolagem lateral em 1440 (com barra), 1366, 1024, 768 e 390px. Com a barra de rolagem, diferenciais e modelos mantêm 3 e 2 colunas. Até 1023px: diferenciais em 2 colunas, modelos em 1 e FAQ empilhada; até 767px: diferenciais em 1 coluna.

Abaixo de ~1360px o 3º card dos depoimentos fica cortado na borda, porque os cards têm 405px fixos do Figma. A página inicial faz igual; o usuário viu e pediu para deixar como está.

## Smoke test

- 46 imagens com resposta 200; console sem erros.
- Galerias: avançam 437px por clique; pontos e setas atualizam. Perguntas abrem e fecham.
- Arquivos novos: fotos em `seed/` (`dilacerador-hero.jpg`, `instalacao-cancela.jpg`, `instalacao-cancela-2.jpg`, `aplicacao-*.jpg`, `modelo-embutido.png`, `modelo-lombada.png`) e SVGs em `images/` (`icon-fence.svg`, `icon-ruler.svg`, `icon-wrench.svg`, `icon-arrow-down-up.svg`, `icon-bell-electric.svg`, `icon-app-window-mac.svg`, `icon-car.svg`, `icon-siren.svg`, `icon-cctv.svg`, `icon-circuit-board.svg`, `icon-chevron-left-dim.svg`, `icon-chevron-down-gray.svg`, `cta-shape-white-160.svg`, `cta-shape-142.svg`, `pattern-elipses-modelo.svg`, `faq-ilustracao.svg`).
