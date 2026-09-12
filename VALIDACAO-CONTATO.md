# Contato — validação pixel perfect (desktop, 1440px)

Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Contato** (`5235:876`). Medições de 11/09/2026, com o método do `VALIDACAO.md`.

- Página: `contato.html`. Sobreposição do Figma: `contato.html?overlay`.
- Referência: `_ref/contato-figma.png` (1440×3052). Screenshot: `_ref/contato-site.png`. Comparativos: `_ref/diff/contato-*.png`.

## Resultado por seção

| # | Seção | Node | Divergência real | Deslocamento |
|---|---|---|---|---|
| 1 | Header | `5235:877` | 3,05% | 0, 0 |
| 2 | Hero com formulário | `5254:467` | 1,49% | 0, 0 |
| 3 | Depoimentos | `5284:1443` | 2,58% | 0, 0 |
| 4 | Mapa | `5254:670` | 0,43% | 0, 0 |
| 5 | Footer | `5235:1280` | 2,15% | 0, 0 |

Altura total: Figma 3051,12px, site 3051px. As bordas entre seções caem nas mesmas linhas do Figma (hero termina em 1034, mapa começa em 1818, rodapé em 2386). A divergência que sobra é rasterização de texto.

Medidas conferidas no navegador: formulário 624×750, campos 544×45, mensagem 544×100, botão "Enviar" 117,3×59 (118 no Figma), cartão do mapa 775,8×77 (775), botão "Ver no maps" 130,9×45 (131).

## Diferenças justificadas

| Onde | Figma | Site | Motivo |
|---|---|---|---|
| Espaço entre os itens do menu | 24px | 32px, como na home | o site tem um header só; mesma decisão pendente das outras páginas internas |
| Menu do header e rodapé | 5 itens simples | "Produtos" com seta e submenu (Dilacerador, Torniquete, Controle de acesso) e "Projetos" como aba própria | navegação do site ligada pelo Mestre em 12/09/2026; parte comum a todas as páginas |
| Larguras dos botões | 118 e 131px | 117,3 e 130,9px | largura do rótulo em Inter |
| Campos do formulário | textos de exemplo dentro da caixa | `placeholder` de verdade, com `<label>` acima | mesmo desenho, mas acessível e digitável |
| Envio do formulário | — | ainda não envia | falta o destino (WordPress, e-mail ou serviço); hoje o botão só valida o HTML |
| Ilustração | frame com brilho | PNG exportado do nó (515×322) posicionado na caixa de 308px | o brilho passa da caixa no Figma |

## Abaixo de 1440px

Sem rolagem lateral em 1440, 1425 (com a barra de rolagem), 1024 e 390px. Até 1279px a coluna de contatos e o formulário dividem a linha e depois empilham; até 767px o cartão do mapa vira coluna.

## Smoke test

Console sem erros. Ícones novos: `icon-email.svg`, `icon-endereco.svg`, `icon-whatsapp-contato.svg`, `icon-pin.svg`. Imagens novas: `mapa.png` e `contato-ilustracao.png`.

O mapa é a imagem do Figma, não um mapa interativo; o botão "Ver no maps" abre o Google Maps no endereço.
