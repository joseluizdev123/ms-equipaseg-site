# Chats em paralelo — site MS Equipaseg

Vários chats trabalham ao mesmo tempo nesta pasta. O **Mestre** cria as páginas novas; cada página pronta tem um **filho** onde o usuário pede os ajustes dela. Projeto, preferências do usuário e ferramentas: `HANDOFF.md`.

## Chats abertos

| Chat | Sessão | Dono de |
|---|---|---|
| Mestre · MS Equipaseg | `local_380530cb-f430-4db5-9624-f03ae062a4a0` | páginas em construção, `HANDOFF.md`, `CHATS.md`, `tools/` |
| Ajustar Página inicial · MS Equipaseg | `local_bd9eb915-f80c-4a00-8214-1641c692b0fa` | `index.html`, `VALIDACAO.md`, blocos da home no `main.css` |
| Ajustar Quem somos · MS Equipaseg | `local_de8c4d1d-b1ce-497d-9ec8-d63f007add58` | `quem-somos.html`, `quem-somos.css`, `VALIDACAO-QUEM-SOMOS.md` |
| Ajustar Dilacerador de Pneus · MS Equipaseg | `local_99febc06-43da-4019-904c-3a15f88fdc4d` | `dilacerador-de-pneus.html`, `dilacerador-de-pneus.css`, `VALIDACAO-DILACERADOR.md` |
| Ajustar Torniquete · MS Equipaseg | a preencher | `torniquete.html`, `torniquete.css`, `VALIDACAO-TORNIQUETE.md` |
| Ajustar Contato · MS Equipaseg | a preencher | `contato.html`, `contato.css`, `VALIDACAO-CONTATO.md` |
| Ajustar Projetos · MS Equipaseg | a preencher | `projetos.html`, `projetos.css`, `VALIDACAO-PROJETOS.md` |
| Ajustar Produtos alfa · MS Equipaseg | a preencher | `produtos-alfa.html`, `produtos-alfa.css` |
| Ajustar Controle de acesso · MS Equipaseg | a preencher | `controle-de-acesso.html`, `controle-de-acesso.css` |

O Mestre atualiza esta tabela quando abre um filho ou termina uma página.

## Escopo de cada mudança

Toda mudança tem um **escopo**:

- **Página**: os arquivos do dono. No `main.css`, os blocos da home são os de comentário numerado 2, 4–6, 7–8 e 9 (Hero, Produtos, Projetos especiais, Sobre nós + Nossos números) e as regras dessas seções em "Larguras menores que 1440px". Página nova: `<pagina>.html` e o CSS próprio dela (convenção no `HANDOFF.md`).
- **Site todo**: as **partes comuns** — o resto do `main.css` (tokens, botões, CTAs, setas, header, títulos de seção, Nossos clientes, cards, listas, galerias, depoimentos, perguntas frequentes, CTA final, footer), o markup de header e footer copiado em cada `.html` e o `main.js`.

Quando um pedido do usuário cai numa parte comum:

1. Pergunte: "Isso vale só para esta página ou para o site todo?"
2. Só esta página: escreva a regra nos seus blocos, presa a um seletor da sua página.
3. Site todo: aplique na parte comum (header e footer em todos os `.html`) e avise o Mestre com `mcp__ccd_session_mgmt__send_message` na sessão dele: o que mudou e onde.

## Edição simultânea

- Se o Edit recusar porque o arquivo mudou, outro chat acabou de editar: releia o arquivo e refaça a edição.
- Scripts só leem e geram imagens; quem altera arquivo é o Edit.
- Cada chat abre o próprio servidor: `preview_start` com `equipaseg-estatico`. O Browser de um chat não enxerga o servidor de outro, e o `autoPort` escolhe uma porta livre. Nos scripts de `tools/`, passe `-Url` com a porta do seu servidor.
- Arquivos novos em `_ref/` e `_ref/diff/` começam com o nome da página (`inicio-`, `sobre-`...).

## Filho: ao abrir

1. Confira a pasta de trabalho: `C:\Users\josel\OneDrive\Documentos\artemis\equipaseg_claude`. Em qualquer outra pasta (cópia ou worktree), pare e peça ao usuário para abrir uma sessão nova nessa pasta, sem worktree, com a mensagem: Você é o chat filho "<título deste chat>". Leia CHATS.md e siga a seção Filho: ao abrir.
2. Leia `HANDOFF.md` e, na home, `VALIDACAO.md`.
3. Abra a sua página em 1440px.
4. Peça ao usuário a lista de correções.

## Filho: cada correção

1. Corrija dentro do escopo combinado.
2. Mostre o resultado em 1440px: screenshot da região ou comparativo Figma/Site (`tools/pixeldiff.ps1`).
3. A correção termina quando o usuário viu e passou para a próxima.

## Mestre

- Ao terminar cada página, abra o filho dela na hora, sem perguntar (pedido do usuário): `mcp__ccd_session__spawn_task` com título "Ajustar <Página> · MS Equipaseg" e um prompt que manda ler este arquivo. Quando a sessão aparecer em `list_sessions`, preencha a tabela e mova a sessão para o grupo "MS Equipaseg" da barra lateral.
- Ao receber aviso de um filho, releia o trecho que mudou antes de seguir com a página em construção e repasse o aviso aos outros filhos abertos.
- Ao mudar uma parte comum, avise os filhos abertos.
