# 🏆 Bolão Innovate — Guia de Sprints para o Claude Code

> **Stack:** Laravel 13 · Livewire · Tailwind CSS · Flux UI · MySQL  
> **Idioma do código:** Português brasileiro (variáveis, métodos, rotas, comentários)  
> **Padrões:** Componentização Livewire, reaproveitamento de código, sem gambiarras  
> **Usuários:** ~20 funcionários internos  
> **Hospedagem gratuita:** Railway (plano hobby free) ou Render (free tier)
> **Telas responsivas para celular**

---

## Como usar este arquivo

Passe este arquivo inteiro para o Claude Code no início de cada sprint com o seguinte comando:

```
Leia o arquivo bolao-innovate-sprints.md e execute a Sprint [N].
Siga exatamente as tarefas, padrões e observações descritas.
Ao final de cada tarefa, confirme o que foi feito antes de avançar.
```

---

## Contexto do Sistema

Sistema interno de bolão para os jogos do **Brasil na Copa do Mundo**. Os funcionários registram palpites de placar antes de cada jogo. O sistema revela os palpites e calcula pontuação automaticamente após o resultado.

### Regras principais
- Apenas jogos do Brasil são cadastrados
- Cada usuário faz **1 palpite por jogo** — sem edição após confirmação
- Palpites ficam ocultos até: todos apostarem **ou** o jogo iniciar
- Pontuação: **3 pts** placar exato · **1,5 pt** acertou ganhador · **0,5 pt** placar parcial (acumuláveis)
- Pênaltis não contam nos gols — resultado é tratado como empate
- Jogos eliminatórios podem não ter adversário/data definidos ainda (editável pelo admin)

---

## Entidades do banco

```
usuarios        → id, nome, email, senha, perfil (admin|usuario), ativo, timestamps
jogos           → id, adversario (nullable), data_hora (nullable), fase (enum), gols_brasil (nullable), gols_adversario (nullable), penaltis (bool), status (enum: agendado|aberto|encerrado), timestamps
palpites        → id, usuario_id (FK), jogo_id (FK), gols_brasil, gols_adversario, pontuacao (nullable), pts_exato (bool), pts_ganhador (bool), pts_parcial (bool), timestamps · unique(usuario_id, jogo_id)
configuracoes   → chave (PK string), valor (text), timestamps
```

---

## Hospedagem gratuita (Railway ou Render)

O sistema deve estar pronto para deploy gratuito. O próprio Claude deve configurar tudo.

### Opção A — Railway (recomendada para este projeto)
- Deploy automático via GitHub push
- Plugin MySQL nativo gratuito (500MB, suficiente para o bolão)
- SSL automático, sem cold start no plano free
- Variáveis de ambiente configuradas direto no painel

### Opção B — Render (alternativa)
- Free tier com sleep após 15 min de inatividade (aceitável para uso interno)
- MySQL externo necessário (usar PlanetScale free tier ou Clever Cloud)

### O que o Claude deve gerar na Sprint 1
- `railway.toml` ou `render.yaml` com configuração de build
- `.env.example` completo
- `Procfile` se necessário
- Instruções de deploy em `DEPLOY.md`

---

## Sprint 1 — Base, Autenticação e Deploy

**Objetivo:** Projeto rodando localmente e hospedado gratuitamente com autenticação funcionando.

### Tarefas

**1.1 — Setup do projeto**
- Criar projeto Laravel 13
- Instalar e configurar: Livewire 3, Tailwind CSS, Flux UI
- Configurar `vite.config.js` e `tailwind.config.js`
- Garantir que `php artisan serve` e `npm run dev` funcionam

**1.2 — Migrations**
- Criar migrations na ordem correta respeitando FKs:
  1. `usuarios` (usar tabela `users` padrão do Laravel adaptada com campos `perfil` e `ativo`)
  2. `jogos`
  3. `palpites` com unique constraint `(usuario_id, jogo_id)`
  4. `configuracoes`
- Rodar `php artisan migrate`

**1.3 — Models e relacionamentos**
- `Usuario` (extende `Authenticatable`) → `hasMany(Palpite)`
- `Jogo` → `hasMany(Palpite)` · scopes: `aberto()`, `encerrado()`, `proximoJogo()`
- `Palpite` → `belongsTo(Usuario)` · `belongsTo(Jogo)`
- `Configuracao` → método estático `obter(chave, padrao)` e `definir(chave, valor)`

**1.4 — Autenticação**
- Usar autenticação nativa do Laravel (sem pacote extra)
- Middleware `AdminMiddleware` para rotas do painel admin
- Redirecionar após login para `/dashboard`
- Logout com botão no menu

**1.5 — Seeder**
- `UsuarioSeeder`: criar 1 usuário admin (`admin@innovate.com` / `senha123`) e 2 usuários de teste
- `JogoSeeder`: criar os 3 jogos da fase de grupos do Brasil (adversários e datas a preencher manualmente) + 4 jogos eliminatórios sem adversário/data
- `ConfiguracaoSeeder`: `premio_descricao` = "A definir" · `premio_valor` = "0"

**1.6 — Layout base Livewire**
- Componente `Layout` com menu superior responsivo
- Links: Dashboard · Meus Palpites · (Admin: Gerenciar Jogos · Usuários · Configurações)
- Menu mobile com hamburguer
- Cores base: azul marinho `#002776` (fundo) · verde `#009C3B` · amarelo `#FEDF00`

**1.7 — Configuração de deploy gratuito**
- Gerar `railway.toml` com build e start commands do Laravel
- Gerar `.env.example` com todas as variáveis necessárias
- Gerar `DEPLOY.md` com passo a passo para o Railway:
  1. Criar conta Railway
  2. Conectar repositório GitHub
  3. Adicionar plugin MySQL
  4. Configurar variáveis de ambiente
  5. Rodar migrations via Railway CLI ou painel

### Critério de conclusão
- [ ] `php artisan migrate --seed` roda sem erros
- [ ] Login funciona com o usuário admin criado no seeder
- [ ] Menu aparece corretamente em mobile e desktop
- [ ] Arquivos de deploy gerados e documentados

---

## Sprint 2 — Palpites e Revelação

**Objetivo:** Usuário consegue fazer seu palpite e o sistema revela no momento certo.

### Tarefas

**2.1 — Componente de palpite (`FazPalpite`)**
- Livewire component com dois campos: `gols_brasil` e `gols_adversario`
- Validação: inteiros >= 0, obrigatórios
- Botão "Confirmar Palpite" abre modal de confirmação
- Modal exibe o palpite digitado + aviso em destaque:
  > ⚠️ "Atenção: após confirmar, seu palpite não poderá ser editado."
- Ao confirmar: salva no banco, bloqueia o formulário, exibe mensagem de sucesso

**2.2 — Bloqueios e estados do palpite**
- Se jogo `status = encerrado` ou `status = agendado` sem adversário: ocultar formulário, exibir motivo
- Se usuário já apostou: ocultar formulário, exibir o próprio palpite
- Se jogo `data_hora <= now()`: bloquear novo palpite (verificação no backend também)

**2.3 — Lógica de revelação (`RevelaPalpites`)**
- Serviço `PalpiteService::deveRevelar(Jogo $jogo): bool`
- Condição 1: todos os usuários ativos apostaram no jogo
- Condição 2: `$jogo->data_hora <= now()`
- Livewire polling de 30 segundos na tela do jogo para verificar revelação
- Quando revelado: exibir grid com todos os palpites (nome do usuário + palpite)
- Quando não revelado: exibir apenas o palpite do próprio usuário (ou "Você ainda não apostou")

**2.4 — Tela do jogo (`/jogos/{jogo}`)**
- Cabeçalho: `BRA 🆚 [Adversário]`, fase, data/hora formatada
- Seção de palpite (componente `FazPalpite`)
- Seção de palpites revelados (quando aplicável): grid de cards com inicial do nome, nome e palpite
- Após encerrado: exibir resultado oficial e destaque nos palpites que acertaram

**2.5 — Painel admin: gerenciar jogos (`/admin/jogos`)**
- Listagem com: adversário, data/hora, fase, status, ações
- Botão "Editar" (adversário + data/hora) — apenas para jogos não encerrados
- Botão "Registrar Resultado" — apenas para jogos com status `aberto` (aparece quando jogo iniciou)
- Botão "Abrir palpites" — muda status de `agendado` para `aberto` manualmente

**2.6 — Painel admin: gerenciar usuários (`/admin/usuarios`)**
- Listagem com nome, email, perfil, status ativo/inativo
- Botão criar usuário (nome, email, senha temporária, perfil)
- Toggle ativar/desativar (usuários inativos não entram na contagem de revelação)

### Critério de conclusão
- [ ] Usuário consegue fazer palpite com confirmação via modal
- [ ] Não é possível editar palpite já registrado
- [ ] Palpites ficam ocultos até a condição de revelação ser atingida
- [ ] Admin consegue editar jogos eliminatórios e registrar resultados
- [ ] Polling de 30s atualiza a tela sem recarregar a página

---

## Sprint 3 — Resultados e Pontuação

**Objetivo:** Sistema calcula pontuação automaticamente e exibe ranking em tempo real.

### Tarefas

**3.1 — Serviço de pontuação (`PontuacaoService`)**

Criar `app/Services/PontuacaoService.php` com o método `calcular(Palpite $palpite, Jogo $jogo): void`

Lógica exata:
```
Se jogo->penaltis == true:
  Tratar resultado como empate para todos os cálculos de ganhador
  Não considerar gols para placar parcial (penaltis não contam)

pts_exato = (palpite->gols_brasil == jogo->gols_brasil AND palpite->gols_adversario == jogo->gols_adversario)
  → Se true: pontuacao += 3.0

pts_ganhador = sign(palpite->gols_brasil - palpite->gols_adversario) == sign(jogo->gols_brasil - jogo->gols_adversario)
  → Se true E NÃO acertou exato: pontuacao += 1.5

pts_parcial:
  acertou_brasil = palpite->gols_brasil == jogo->gols_brasil
  acertou_adversario = palpite->gols_adversario == jogo->gols_adversario
  Se (acertou_brasil XOR acertou_adversario) E NÃO acertou exato:
    pontuacao += 0.5
    pts_parcial = true

Salvar: palpite->pts_exato, palpite->pts_ganhador, palpite->pts_parcial, palpite->pontuacao
```

**3.2 — Observer ou Event ao registrar resultado**
- Quando admin salvar resultado no jogo: disparar `ResultadoRegistrado` event
- Listener `CalculaPontuacoes` itera todos os palpites do jogo e chama `PontuacaoService::calcular()`
- Atualizar `jogo->status = 'encerrado'`

**3.3 — Ranking Livewire (`TabelaRanking`)**
- Query: `usuarios` com `sum(palpites.pontuacao)` ordenado decrescente
- Colunas: `#` (posição) · `Participante` · `Pts` · `✓ Exato` · `✓ Placar` · `½ Gol`
- Destaque visual: 🥇 ouro · 🥈 prata · 🥉 bronze para top 3
- Polling de 60 segundos para atualizar após novos resultados
- Critério de desempate: mais placares exatos → mais ganhadores

**3.4 — Dashboard: bloco de resultado (`UltimoJogo`)**
- Exibir resultado do jogo mais recente encerrado
- Cards dos usuários que mais pontuaram naquele jogo com destaque
- "Palpiteiro da rodada": quem tirou mais pontos no jogo

**3.5 — Histórico do usuário (`/meus-palpites`)**
- Tabela com: jogo, palpite feito, resultado oficial, pontos obtidos
- Indicadores visuais por linha:
  - 🟢 Verde = placar exato
  - 🟡 Amarelo = acertou ganhador
  - 🔵 Azul = placar parcial
  - ⚪ Cinza = sem pontos / aguardando resultado

### Critério de conclusão
- [ ] `PontuacaoService` cobre todos os casos (exato, ganhador, parcial, pênaltis, acumulação)
- [ ] Pontuação é calculada automaticamente ao registrar resultado
- [ ] Ranking atualiza em tempo real via Livewire
- [ ] Histórico mostra palpites com indicadores visuais corretos
- [ ] Casos de borda testados: pênaltis, empate, placar 0x0

---

## Sprint 4 — UX, Polimento e Finalização

**Objetivo:** Sistema com visual temático Brasil, responsivo, e pronto para uso real.

### Tarefas

**4.1 — Design temático Brasil**
- Paleta: `#002776` (fundo/primário) · `#009C3B` (verde/ações) · `#FEDF00` (amarelo/destaques)
- Dark mode como padrão (fundo azul marinho profundo)
- Botões principais com gradiente verde
- Cards com bordas sutis e sombras suaves
- Ícones: troféu, bola de futebol, bandeiras (usar Heroicons disponíveis no Flux)

**4.2 — Countdown para o próximo jogo**
- Componente Livewire `Countdown` com polling de 1 segundo
- Formato: `00d 00h 00m 00s`
- Quando jogo iniciar: trocar countdown por "🔴 Ao vivo — palpites encerrados"
- Exibir no hero card do dashboard

**4.3 — Card de prêmio**
- Buscar `Configuracao::obter('premio_descricao')` e `premio_valor`
- Card com destaque dourado (borda amarela, ícone de troféu)
- Admin pode editar em `/admin/configuracoes`

**4.4 — Responsividade**
- Menu mobile com drawer lateral
- Tabela de ranking com scroll horizontal em mobile
- Grid de palpites revelados: 2 colunas mobile, 4 desktop
- Formulário de palpite com campos grandes (fácil de usar no celular)
- Testar em viewport 375px (iPhone SE)

**4.5 — Mini estatísticas por jogo**
- Abaixo do formulário de palpite (antes da revelação):
  - "X de Y participantes já apostaram"
  - Barra de progresso visual
- Após revelação: "XX% apostaram em vitória do Brasil"

**4.6 — Ajustes finais de UX**
- Toast de sucesso ao confirmar palpite
- Loading states nos botões (Livewire wire:loading)
- Página 404 customizada com tema
- Mensagem de boas-vindas no primeiro acesso do usuário
- Favicon com bandeira do Brasil ou troféu

**4.7 — Validação final e DEPLOY**
- Rodar `php artisan test` (criar testes básicos para PontuacaoService)
- Verificar todas as rotas com `php artisan route:list`
- Fazer deploy no Railway seguindo o `DEPLOY.md` gerado na Sprint 1
- Testar fluxo completo em produção: login → palpite → resultado → ranking

### Critério de conclusão
- [ ] Visual temático aplicado em todas as telas
- [ ] Countdown funcionando no dashboard
- [ ] Sistema 100% responsivo em mobile
- [ ] Deploy funcionando na URL pública gratuita
- [ ] Fluxo completo testado em produção com usuário real

---

## Checklist geral de boas práticas

O Claude deve seguir estes padrões em todas as sprints:

- **Código em português:** `$palpite`, `$usuarioAtivo`, `calcularPontuacao()`, `rota('jogos.palpitar')`
- **Componentes Livewire** para toda interação dinâmica (sem JS manual quando possível)
- **Services** para lógica de negócio (`PalpiteService`, `PontuacaoService`)
- **Observers ou Events** para efeitos colaterais (calcular pontuação, mudar status)
- **Scopes** nos models para queries reutilizáveis
- **Validação** tanto no frontend (Livewire) quanto no backend (FormRequest ou rules inline)
- **Sem lógica nas views** — Blade apenas para apresentação
- **Migrations reversíveis** com `up()` e `down()`
- Comentários em português explicando regras de negócio não óbvias

---

*Bolão Innovate · Documentação de Sprints v1.0 · Maio 2026*
