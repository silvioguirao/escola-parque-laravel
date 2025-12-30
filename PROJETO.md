# Escola Parque - Sistema de Gestão Escolar

Sistema completo de gestão escolar desenvolvido em Laravel 12 com autenticação completa, dashboard administrativo e portal dos pais.

## 🚀 Tecnologias Utilizadas

- **Laravel 12** - Framework PHP
- **Tailwind CSS 3** - Framework CSS  
- **MySQL** - Banco de dados
- **Laravel Breeze** - Autenticação básica
- **Laravel Fortify** - Autenticação avançada (2FA, verificação de e-mail)
- **Alpine.js** - JavaScript framework
- **Vite** - Build tool

## ✨ Funcionalidades Implementadas

### Área Pública
✅ Homepage com carrossel de banners
✅ Listagem de diferenciais da escola
✅ Notícias e anúncios
✅ Galeria de fotos (álbuns)
✅ Cursos oferecidos
✅ Formulário de contato
✅ Formulário de matrícula
✅ Vídeos institucionais
✅ Parceiros/patrocinadores

### Sistema de Autenticação Completo
✅ Login/Registro tradicional
✅ Recuperação de senha via e-mail
✅ **Autenticação de dois fatores (2FA)**
✅ **Verificação de e-mail obrigatória (configurável por usuário)**
✅ Roles: admin, parent, user

### Dashboard Administrativo
✅ Estatísticas gerais do sistema
✅ Gestão completa de conteúdo (CRUD):
  - Hero Banners
  - Diferenciais
  - Notícias
  - Cursos
  - Galeria de fotos
  - Vídeos
  - Parceiros
✅ Gestão de matrículas (aprovar/rejeitar)
✅ Gestão de contatos (marcar como lido/respondido)
✅ **Gestão de usuários com controle individual de verificação de e-mail**
✅ Middleware de autorização por role

### Portal dos Pais
✅ Dashboard personalizado
✅ Visualização de progresso dos filhos
✅ Comunicações personalizadas
✅ Relatórios e notas

## 📋 Instalação Rápida

### 1. Instalar dependências

```bash
composer install
pnpm install
```

### 2. Configurar ambiente

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configurar banco de dados no .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=escola_parque
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

### 4. Executar migrations e criar admin

```bash
# Criar banco
mysql -u root -p -e "CREATE DATABASE escola_parque CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Migrations
php artisan migrate

# Criar usuário admin
php artisan db:seed --class=AdminUserSeeder
```

### 5. Compilar assets e iniciar

```bash
pnpm run build
php artisan serve
```

## 👤 Credenciais Padrão

**Administrador:**
- Email: `admin@escolaparque.com.br`
- Senha: `Admin@123`

⚠️ **Altere após primeiro login!**

## 📧 Configuração de E-mail

Configure no `.env` para habilitar:
- Recuperação de senha
- Verificação de e-mail
- Códigos 2FA
- Notificações

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_username
MAIL_PASSWORD=sua_senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@escolaparque.com.br"
MAIL_FROM_NAME="Escola Parque"
```

## 🗄️ Estrutura do Banco de Dados

### Tabelas Implementadas

1. **users** - Usuários (admin, parent, user) com campos:
   - role, phone, require_email_verification, last_signed_in
   - two_factor_secret, two_factor_recovery_codes (Fortify)

2. **hero_banners** - Banners da homepage
3. **differentials** - Diferenciais da escola
4. **news** - Notícias com categorias e publicação
5. **courses** - Cursos com níveis educacionais
6. **albums** / **photos** - Galeria de fotos
7. **enrollments** - Matrículas com aprovação
8. **contacts** - Formulário de contato
9. **partners** - Parceiros/patrocinadores
10. **videos** - Vídeos institucionais
11. **parents** - Pais/Responsáveis
12. **parent_student_relations** - Relação pais-alunos
13. **student_progress** - Progresso acadêmico
14. **parent_communications** - Comunicações personalizadas

## 🛣️ Rotas Principais

### Públicas
- `GET /` - Homepage
- `GET /noticias` - Listagem de notícias
- `GET /noticias/{slug}` - Detalhes da notícia
- `GET /cursos` - Cursos oferecidos
- `GET /galeria` - Galeria de fotos
- `GET /matricula` - Formulário de matrícula
- `POST /matricula` - Enviar matrícula
- `GET /contato` - Formulário de contato
- `POST /contato` - Enviar contato

### Autenticação (Breeze + Fortify)
- `GET /login` - Login
- `POST /login` - Processar login
- `GET /register` - Registro
- `POST /register` - Processar registro
- `GET /forgot-password` - Recuperação de senha
- `POST /forgot-password` - Enviar link de recuperação
- `GET /reset-password/{token}` - Resetar senha
- `POST /reset-password` - Processar reset
- `GET /verify-email` - Verificação de e-mail
- `GET /two-factor-challenge` - Desafio 2FA

### Admin (middleware: auth, verified, admin)
- `GET /admin/dashboard` - Dashboard
- `RESOURCE /admin/users` - Gestão de usuários
- `PATCH /admin/users/{user}/toggle-email-verification` - Toggle verificação
- `RESOURCE /admin/hero-banners` - Gestão de banners
- `RESOURCE /admin/differentials` - Gestão de diferenciais
- `RESOURCE /admin/news` - Gestão de notícias
- `RESOURCE /admin/courses` - Gestão de cursos
- `RESOURCE /admin/albums` - Gestão de álbuns
- `RESOURCE /admin/partners` - Gestão de parceiros
- `RESOURCE /admin/videos` - Gestão de vídeos
- `RESOURCE /admin/enrollments` - Gestão de matrículas
- `PATCH /admin/enrollments/{enrollment}/approve` - Aprovar matrícula
- `PATCH /admin/enrollments/{enrollment}/reject` - Rejeitar matrícula
- `RESOURCE /admin/contacts` - Gestão de contatos
- `PATCH /admin/contacts/{contact}/mark-read` - Marcar como lido
- `PATCH /admin/contacts/{contact}/mark-replied` - Marcar como respondido

### Parent (middleware: auth, verified)
- `GET /parent/dashboard` - Dashboard dos pais

## 🎯 Funcionalidades Especiais

### 1. Controle de Verificação de E-mail por Usuário

O admin pode configurar individualmente se cada usuário precisa verificar o e-mail:

```php
// No dashboard admin
PATCH /admin/users/{user}/toggle-email-verification

// No model User
$user->require_email_verification = true/false;
```

### 2. Autenticação de Dois Fatores (2FA)

Implementado via Laravel Fortify:
- QR Code para configuração
- Códigos de recuperação
- Validação via app autenticador

### 3. Middleware de Autorização

```php
// EnsureUserIsAdmin
if (!$request->user()->isAdmin()) {
    abort(403);
}
```

### 4. Scopes Úteis nos Models

```php
// Buscar apenas ativos
HeroBanner::active()->get();
News::published()->get();
Course::active()->get();

// Buscar pendentes
Enrollment::pending()->get();
Contact::new()->get();
```

## 📁 Arquivos Importantes

### Controllers
- `app/Http/Controllers/HomeController.php` - Homepage pública
- `app/Http/Controllers/Admin/DashboardController.php` - Dashboard admin
- `app/Http/Controllers/Admin/UserController.php` - Gestão de usuários
- Todos os outros controllers em `app/Http/Controllers/Admin/`

### Models
- `app/Models/User.php` - Model principal com 2FA e verificação
- Todos os models em `app/Models/`

### Middleware
- `app/Http/Middleware/EnsureUserIsAdmin.php` - Autorização admin

### Routes
- `routes/web.php` - Todas as rotas da aplicação

### Views
- `resources/views/layouts/public.blade.php` - Layout público
- `resources/views/layouts/app.blade.php` - Layout autenticado (Breeze)
- `resources/views/home.blade.php` - Homepage

### Migrations
- `database/migrations/` - Todas as migrations criadas

### Seeders
- `database/seeders/AdminUserSeeder.php` - Criar admin inicial

## 🔧 Comandos Úteis

```bash
# Limpar caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Otimizar para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Recriar banco (CUIDADO!)
php artisan migrate:fresh --seed

# Compilar assets
pnpm run dev      # Desenvolvimento
pnpm run build    # Produção
```

## 🚀 Deploy para Produção

1. Configure `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-dominio.com
```

2. Otimize:
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
pnpm run build
```

3. Permissões:
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 🔐 Segurança

✅ Senhas criptografadas com bcrypt
✅ CSRF protection
✅ SQL injection protection (Eloquent)
✅ XSS protection (Blade)
✅ Rate limiting em autenticação
✅ Middleware de autorização por roles
✅ 2FA disponível
✅ Verificação de e-mail configurável

## 📝 Próximos Passos Sugeridos

1. Implementar upload de imagens (AWS S3 ou local)
2. Criar views completas para todas as páginas admin
3. Implementar notificações em tempo real
4. Adicionar testes automatizados
5. Configurar CI/CD
6. Implementar busca avançada
7. Adicionar relatórios em PDF
8. Integrar com WhatsApp API

## 🤝 Suporte

Para dúvidas ou suporte:
- Email: suporte@escolaparque.com.br
- Documentação Laravel: https://laravel.com/docs

---

**Desenvolvido com ❤️ para Escola Parque**

Conversão completa de TypeScript/React para Laravel 12 + Tailwind CSS
