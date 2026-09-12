# Projetos — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame `5278:2809`. O frame está nomeado "Produtos > Torniquete" no arquivo, mas é a **página Projetos**: o hero diz "Projetos". Medições de 11/09/2026, com o método do `VALIDACAO.md`.

- Página: `projetos.html`. Sobreposição do Figma: `projetos.html?overlay`.
- Referência: `_ref/projetos-figma.png` (1440×5898). Screenshot: `_ref/projetos-site.png`. Comparativos: `_ref/diff/projetos-*.png`.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento |
|---|---|---|---|---|
| 1 | Header | `5278:2810` | 3,05% | 0, 0 |
| 2 | Hero | `5278:2824` | 1,61% | 0, 0 |
| 3 | Diferenciais do produto | `5278:2832` | 1,40% | 0, 0 |
| 4 | Lançamento | `5278:2878` | 1,55% | 0, 0 |
| 5 | Outros projetos | `5278:2985` | 2,41% | 0, 0 |
| 6 | Depoimentos | `5278:3030` | 2,51% | 0, 0 |
| 7 | Perguntas frequentes | `5278:3112` | 2,67% | 0, 0 |
| 8 | CTA | `5278:3167` | 0,67% | 0, 0 |
| 9 | Footer | `5278:3168` | 2,15% | 0, 0 |

Altura total: Figma 5897,12px, site 5897px. As bordas entre seções caem nas mesmas linhas (a seção amarela do CTA começa em 4696 nos dois). A divergência que sobra é rasterização de texto.

## O que difere da página Torniquete (`5235:708`)

| | Torniquete | Projetos |
|---|---|---|
| Hero | com recorte amarelo no canto | **sem** o recorte |
| Diferenciais | card alto preto à esquerda | card alto **branco à direita**, textos diferentes |
| Seção do dilacerador | "Em destaque" | "**Lançamento**" |
| Galeria | "Instalações" + "Possibilidades de aplicação" | só "**Outros projetos**" (mesmas fotos e textos da segunda) |
| Outros modelos | 2 cards | não existe |

As duas páginas usam os mesmos blocos do `main.css` (hero, diferenciais, foto de produto, card de destaque, galeria, depoimentos, FAQ, CTA, rodapé).

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px | 32px, como na home | o site tem um header só; mesma decisão pendente das outras páginas internas |
| Textos do card "Lançamento" | "Lorem ipsum dolor sit amet" ×3 e "…alta segurança. de alto risco." | iguais ao Figma | conteúdo provisório do arquivo |
| Texto de "Outros projetos" | fala de torniquete | igual ao Figma | o texto veio da página do Torniquete |
| Perguntas frequentes | falam de torniquete | iguais ao Figma | idem |
| Foto do círculo no "Lançamento" | imagem própria deste frame | `projetos-circulo.png` | é uma imagem diferente da usada no Torniquete |
| Contatos do rodapé | telefones e e-mail de exemplo ("11 99999-8989", "11 3333-4444", `email@exemplo.com.br`) | dados reais do site atual: "11 5667-9440" no WhatsApp e no telefone, `email@msequipaseg.com.br` | o usuário autorizou os dados reais (parte comum, 12/09/2026) |
| Setas "anterior" (galeria e depoimentos) | apagadas | ativas | todos os carrosséis giram sem fim, então nenhuma seta desliga (carrossel do `main.js`, 12/09/2026) |
| Faixa à esquerda de "Outros projetos" | fundo | fim da foto anterior | o carrossel gira sem fim nos dois sentidos, com uma cópia antes do trilho (carrossel do `main.js`, 12/09/2026); a seção foi de 1,16% para 2,41%. Nos depoimentos nada mudou (2,51%): os cards não passam da margem de 80px |

## Abaixo de 1440px

Sem rolagem lateral em 1440, 1425 (com a barra de rolagem), 1024 e 390px. Os diferenciais vão de 3 para 2 colunas em 1023px e para 1 coluna em 767px; o card de destaque empilha em 1279px.

## Smoke test

Console sem erros. A página reaproveita todas as imagens e ícones já baixados; só o círculo do card "Lançamento" é novo (`projetos-circulo.png`).

## Carrosséis (12/09/2026)

Cada passo leva 0,7s com curva macia (`cubic-bezier(0.65, 0, 0.35, 1)`). A galeria "Outros projetos" (5 fotos) e os depoimentos (4 cards) giram sem fim nos dois sentidos — há cópias dos cards antes e depois do trilho — e andam sozinhos a cada 5s; param com o mouse em cima, com o teclado dentro, fora da tela e para quem pediu menos movimento. Conferido com o Chrome headless: em 13s os dois andam 2 passos (3º pontinho aceso). Os 4 pontinhos de cada um ficam visíveis. O `tools/shot.ps1` força "menos movimento", então o screenshot sempre pega os dois parados no primeiro card.
