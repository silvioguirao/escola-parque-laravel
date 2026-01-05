# Escola Parque - Guia de Instalação e Execução

## Requisitos

- PHP 8.2 ou superior
- MySQL 8.0 ou superior
- Composer 2.x
- Node.js 18.x ou superior
- pnpm (ou npm)

## Instalação

### 1. Instalar Dependências

```bash
# Instalar dependências PHP
composer install

# Instalar dependências Node.js
pnpm install
# ou
npm install
```

### 2. Configurar Banco de Dados

Crie o banco de dados MySQL:

```bash
mysql -u root -p
```

No MySQL:
```sql
CREATE DATABASE escola_parque CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 3. Configurar Variáveis de Ambiente

O arquivo `.env` já está configurado. Ajuste conforme necessário:

```env
DB_DATABASE=escola_parque
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui
```

### 4. Executar Migrations

```bash
php artisan migrate
```

### 5. Criar Usuário Administrador

```bash
php artisan db:seed --class=AdminUserSeeder
```

**Credenciais do Admin:**
- Email: `admin@escolaparque.com.br`
- Senha: `Admin@123`

### 6. Compilar Assets

```bash
# Para desenvolvimento (com watch)
pnpm run dev

# Para produção
pnpm run build
```

### 7. Iniciar Servidor

Em um terminal separado:

```bash
php artisan serve
```

O projeto estará disponível em: http://localhost:8000

## Funcionalidades Implementadas

### Área Pública
- Homepage com banners, diferenciais, notícias e parceiros
- Listagem e detalhes de notícias
- Listagem e detalhes de cursos
- Galeria de fotos
- Formulário de matrícula
- Formulário de contato

### Área Administrativa
- Dashboard com estatísticas
- Gestão completa de usuários
- Sistema de autenticação com:
  - Login/Registro
  - Recuperação de senha
  - Verificação de e-mail (configurável por usuário)
  - Autenticação de dois fatores (2FA)

## Próximos Passos (Opcional)

### Implementar Controllers Admin

Os controllers admin estão criados mas vazios. Para implementá-los:

1. Implemente CRUD completo em cada controller
2. Crie as views correspondentes
3. Adicione validação de formulários

### Configurar E-mail

Para habilitar envio de e-mails (recuperação de senha, 2FA):

```env
MAIL_MAILER=smtp
MAIL_HOST=seu-servidor-smtp.com
MAIL_PORT=587
MAIL_USERNAME=seu-usuario
MAIL_PASSWORD=sua-senha
MAIL_ENCRYPTION=tls
```

### Upload de Imagens

Para habilitar upload de imagens, configure AWS S3:

```env
AWS_ACCESS_KEY_ID=sua-key
AWS_SECRET_ACCESS_KEY=sua-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=seu-bucket
```

Ou use storage local:

```bash
php artisan storage:link
```

## Comandos Úteis

```bash
# Limpar caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Recriar banco (apaga tudo!)
php artisan migrate:fresh --seed

# Ver rotas
php artisan route:list

# Executar testes
php artisan test
```

## Estrutura do Projeto

```
escola-parque-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controllers públicos e admin
│   │   └── Middleware/       # Middleware customizado
│   └── Models/               # Models Eloquent
├── database/
│   ├── migrations/           # 15 migrations criadas
│   └── seeders/              # Seeder do admin
├── resources/
│   ├── views/
│   │   ├── home.blade.php    # Homepage
│   │   ├── news/             # Views de notícias
│   │   ├── courses/          # Views de cursos
│   │   ├── gallery/          # Views de galeria
│   │   ├── enrollment/       # Formulário de matrícula
│   │   └── contact/          # Formulário de contato
│   └── css/
│       └── app.css           # Tailwind + componentes
├── routes/
│   └── web.php               # Todas as rotas
└── .env                      # Configurações
```

## Segurança

Antes de colocar em produção:

1. Altere a senha do admin
2. Configure APP_DEBUG=false
3. Configure APP_ENV=production
4. Adicione HTTPS
5. Configure backups do banco
6. Revise permissões de arquivos

## Suporte

Para mais informações, consulte:
- PROJETO.md - Documentação completa
- INICIO-RAPIDO.md - Guia resumido
- https://laravel.com/docs - Documentação oficial do Laravel

## Licença

Este projeto foi desenvolvido para a Escola Parque.
