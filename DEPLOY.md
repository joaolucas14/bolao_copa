# Deploy — Bolão Innovate no Railway

## Pré-requisitos
- Conta no [Railway](https://railway.app) (gratuita)
- Repositório no GitHub com o código do projeto

---

## Passo a passo

### 1. Criar conta no Railway
1. Acesse [railway.app](https://railway.app) e crie uma conta com GitHub

### 2. Criar novo projeto
1. Clique em **New Project**
2. Selecione **Deploy from GitHub repo**
3. Autorize o acesso e escolha o repositório `bolao_copa`

### 3. Adicionar plugin MySQL
1. No painel do projeto, clique em **+ New**
2. Selecione **Database → MySQL**
3. Aguarde o provisionamento (30–60 segundos)

### 4. Configurar variáveis de ambiente
No serviço Laravel, clique em **Variables** e adicione:

```
APP_NAME=Bolão Innovate
APP_ENV=production
APP_KEY=              ← gerar com: php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://SEU-DOMINIO.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

> As variáveis `${{MySQL.*}}` são resolvidas automaticamente pelo Railway.

### 5. Rodar migrations e seed
Após o primeiro deploy, abra o **Railway CLI** ou use o painel Shell:

```bash
php artisan migrate --seed
```

### 6. Domínio personalizado (opcional)
Em **Settings → Domains**, gere o domínio público gratuito `.railway.app`.

---

## Rebuild manual
Para forçar um novo deploy, faça um push no branch `main` ou clique em **Redeploy** no painel.

---

## Variáveis geradas pelo Railway (referência)
| Variável Railway     | Uso no Laravel |
|---------------------|----------------|
| `MYSQLHOST`         | `DB_HOST`      |
| `MYSQLPORT`         | `DB_PORT`      |
| `MYSQLDATABASE`     | `DB_DATABASE`  |
| `MYSQLUSER`         | `DB_USERNAME`  |
| `MYSQLPASSWORD`     | `DB_PASSWORD`  |
| `PORT`              | Porta do servidor (configurado no `railway.toml`) |
