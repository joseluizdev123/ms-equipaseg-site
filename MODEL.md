# MS Equipaseg — modelo de dados WordPress

Fonte: Figma `I7qYIaCi6nFLVWPiu9y1Un`, frame **Página inicial** (`3047:6`), largura de referência 1440px.

Saída dupla: `index.html` estático na raiz (referência pixel perfect) e tema WordPress em `theme/ms-equipaseg/`. Os dois usam os mesmos `assets/css/main.css`, `assets/js/main.js` e imagens.

## Decisões assumidas (defaults — confirmar com o cliente)

| Decisão | Valor adotado |
|---|---|
| Campos personalizados | Meta box nativo, sem ACF |
| Quem opera o admin | Cliente leigo: rótulos em português; listas de "um item por linha" em vez de repetidores |
| Imagens | Assets exportados do Figma entram na Mídia pelo importador |
| Atualizações do tema | Git Updater: `GitHub Theme URI` no `style.css` está com `ORGANIZACAO` provisório |
| Prefixo | `mse_` |

## Conteúdo

| Conteúdo | Tipo | Slug WP | Campos principais |
|---|---|---|---|
| Produtos (Dilacerador de Pneus, Torniquete) | CPT | `mse_produto` | título, descrição, características, imagens, estilo da imagem, lado da imagem, selo, botão (texto, link, degradê), ordem |
| Clientes (logos) | CPT | `mse_cliente` | nome (título), logo (imagem destacada), altura do logo, ordem |
| Depoimentos | CPT | `mse_depoimento` | nome (título), foto (imagem destacada, opcional), texto, cargo/empresa, ordem |
| Hero | Customizer | `mse_hero_*` | título, texto, imagem de fundo, texto e link do botão |
| Projetos especiais (bloco da home) | Customizer | `mse_projetos_*` | título da seção, título do card, texto, itens (um por linha), imagem, botão |
| Sobre nós (bloco da home) | Customizer | `mse_sobre_*` | título, texto (`**negrito**`, linha em branco entre parágrafos), imagem, botão |
| Nossos números | Customizer | `mse_numeros_*` | título, 3 itens (destaque + complemento) |
| Depoimentos (cabeçalho) | Customizer | `mse_depoimentos_*` | título, texto de apoio |
| CTA final | Customizer | `mse_cta_*` | título, texto, imagem, texto e link do botão |
| Contato global | Customizer | `mse_contato_*` | WhatsApp, telefone, e-mail, endereço |
| Redes sociais | Customizer | `mse_social_*` | Instagram, Facebook, YouTube, LinkedIn (vazio oculta) |
| Rodapé | Customizer | `mse_footer_*` | texto institucional, botão, texto dos créditos |
| Cabeçalho | Customizer | `mse_header_*` | texto e link do botão "Fale conosco" |
| Menus | Nav menus | `primary`, `footer-navegacao`, `footer-produtos`, `footer-politicas` | itens de menu; o título de cada coluna do rodapé é o nome do menu |
| Página inicial | Page (front) | `/` | `front-page.php`; o importador define `show_on_front = page` |

Fica de fora por enquanto: CPT de projetos. A home só mostra um card-resumo; a listagem entra quando o Figma da página interna existir.

## Campos dos tipos de post

**Produtos** (`mse_produto`):

| Meta | Campo | Observação |
|---|---|---|
| `_mse_descricao` | Descrição | |
| `_mse_caracteristicas` | Características | uma por linha; `\|` quebra a linha dentro do item |
| `_mse_galeria` | Imagens | IDs separados por vírgula; com 2+ imagens as setas navegam |
| `_mse_estilo_midia` | Estilo da imagem | `foto` (preenche o quadro) ou `recorte` (PNG sobre fundo escuro com elipses) |
| `_mse_lado_imagem` | Lado da imagem | `esquerda`: lista em grade e borda `#C7C7C7`; `direita`: lista em duas colunas, borda `Gray/03`, descrição até 557px |
| `_mse_selo` | Selo sobre a imagem | opcional |
| `_mse_cta_texto` / `_mse_cta_link` | Botão | link vazio abre o WhatsApp do contato |
| `_mse_cta_degrade` | Botão com degradê | o Figma usa degradê só no Dilacerador |

**Clientes** (`mse_cliente`): `_mse_logo_altura` (altura exibida em px; a largura segue a proporção).

**Depoimentos** (`mse_depoimento`): `_mse_citacao` (parágrafos separados por linha em branco) e `_mse_cargo`. Sem foto, aparece o ícone do layout.

## Instalação do tema

1. Copie `theme/ms-equipaseg` para `wp-content/themes/` e ative em **Aparência → Temas**.
2. Em **Aparência → Conteúdo inicial**, clique em **Importar conteúdo**. Cria a página inicial, os 4 menus, 6 clientes, 2 produtos e 4 depoimentos, e importa as 11 imagens de `assets/seed/` para a Mídia. Pode rodar de novo: nada é duplicado nem sobrescrito.
3. Ajuste textos, imagens e contatos em **Aparência → Personalizar → MS Equipaseg**.
4. Antes de publicar: defina o repositório real em `style.css` (`Theme URI` e `GitHub Theme URI`) e troque os textos provisórios do layout (depoimentos, itens de Projetos especiais, texto do rodapé, contatos).

## Mapa de seções (Figma → código)

| # | Seção | Node ID | Template | Dados |
|---|---|---|---|---|
| 1 | Header | `7020:1080` | `header.php` | menu `primary` + Customizer |
| 2 | Hero | `5051:133` | `template-parts/hero.php` | Customizer |
| 3 | Nossos clientes | `5051:163` | `template-parts/clientes.php` | CPT `mse_cliente` |
| 4 | Produtos — título | `5275:717` | `template-parts/produtos.php` | Customizer |
| 5 | Produto: Dilacerador de Pneus | `5051:235` | `template-parts/produto-card.php` | CPT `mse_produto` |
| 6 | Produto: Torniquete | `5275:756` | `template-parts/produto-card.php` | CPT `mse_produto` |
| 7 | Projetos especiais — título | `5275:793` | `template-parts/projetos.php` | Customizer |
| 8 | Projetos especiais — card | `5275:796` | `template-parts/projetos.php` | Customizer |
| 9 | Sobre nós + números | `5060:357` | `template-parts/sobre.php` | Customizer |
| 10 | Depoimentos | `5060:1948` | `template-parts/depoimentos.php` | CPT `mse_depoimento` + Customizer |
| 11 | CTA final | `5235:1048` | `template-parts/cta.php` | Customizer |
| 12 | Footer | `5235:1049` | `footer.php` | Customizer + menus |

## Pendências do tema (revisão de código de 11/09/2026)

O tema nunca rodou num WordPress. Uma revisão do código achou os problemas abaixo; corrigir quando a fase WordPress começar.

**Bugs**

1. `template-parts/clientes.php`: 4 dos 6 logos saem recortados. Com tamanho em array, `wp_get_attachment_image()` cai na miniatura 150×150 cortada. Montar o `<img>` com a URL do tamanho `full` (`$mse_src[0]`) e `width`/`height` calculados. A coluna de logo do admin (`inc/cpt-cliente.php`) tem o mesmo problema: usar `'medium'`.
2. `inc/helpers.php` (`mse_link`, `mse_default_link`): âncoras como `#contato` não funcionam fora da home. Prefixar com `home_url( '/' )` quando `! is_front_page()`.
3. `inc/seeder.php` (`mse_seed_post`): `get_page_by_path()` com o tipo em string também procura anexos e pode devolver uma imagem. Passar `array( $post_type )`.
4. `inc/meta-fields.php` (`mse_save_meta_box`): `update_post_meta()` já remove escapes, então barras invertidas somem. Salvar `wp_slash( $value )` e ignorar valores em array antes de `array_key_exists()`.
5. `inc/menus.php` (`mse_nav_link_attributes`): âncoras dos menus do rodapé recebem `aria-current="page"` na home. Remover o atributo antes de checar o local do menu.

**Melhorias sugeridas**

- Importador: processar no hook `load-appearance_page_mse-seeder` e redirecionar ao terminar; ao importar de novo, não sobrescrever Configurações › Leitura nem os locais de menu.
- `mse_footer_menu()`: passar `'fallback_cb' => false`.
- `template-parts/produto-card.php`: filtrar os IDs da galeria com `wp_attachment_is_image()`.
- `template-parts/clientes.php`: aceitar logos sem dimensões gravadas (SVG).
- `index.php`: em listagens, títulos `<h2>` com link e paginação.
