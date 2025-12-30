# 🚀 Guia de Início Rápido - Escola Parque

## Passo 1: Instalar Dependências

```bash
cd /home/ubuntu/escola-parque-laravel
composer install
pnpm install
```

## Passo 2: Configurar Banco de Dados

```bash
# Criar banco de dados MySQL
mysql -u root -p
```

No MySQL:
```sql
CREATE DATABASE escola_parque CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

## Passo 3: Configurar .env

O arquivo `.env` já está configurado com:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=escola_parque
DB_USERNAME=root
DB_PASSWORD=
```

**Ajuste a senha do MySQL se necessário!**

## Passo 4: Executar Migrations

```bash
php artisan migrate
```

## Passo 5: Criar Usuário Administrador

```bash
php artisan db:seed --class=AdminUserSeeder
```

**Credenciais criadas:**
- Email: `admin@escolaparque.com.br`
- Senha: `Admin@123`

## Passo 6: Compilar Assets

```bash
pnpm run build
```

## Passo 7: Iniciar Servidor

```bash
php artisan serve
```

Acesse: **http://localhost:8000**

## ✅ Pronto!

Agora você pode:

1. **Acessar o site público**: http://localhost:8000
2. **Fazer login como admin**: http://localhost:8000/login
3. **Acessar dashboard admin**: http://localhost:8000/admin/dashboard

## 📋 Checklist de Funcionalidades

### ✅ Implementado
- [x] Laravel 12 + Tailwind CSS
- [x] Todas as migrations e models
- [x] Sistema de autenticação completo (Breeze + Fortify)
- [x] Recuperação de senha
- [x] Autenticação de dois fatores (2FA)
- [x] Verificação de e-mail configurável por usuário
- [x] Controllers para todas as funcionalidades
- [x] Rotas públicas e administrativas
- [x] Middleware de autorização (admin)
- [x] Layout público com Tailwind
- [x] Homepage funcional
- [x] Dashboard admin com estatísticas
- [x] Gestão de usuários com controle de verificação de e-mail
- [x] Seeder para admin inicial

### 🔧 Para Completar (Opcional)

- [ ] Views completas para todas as páginas admin
- [ ] Views para notícias, cursos, galeria
- [ ] Upload de imagens (AWS S3 ou local)
- [ ] Configuração de e-mail (SMTP)
- [ ] Testes automatizados
- [ ] Seeders com dados de exemplo

## 🎯 Próximos Passos Recomendados

### 1. Configurar E-mail (Importante para 2FA e recuperação de senha)

Edite `.env`:
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

### 2. Testar Funcionalidades

```bash
# Criar um usuário de teste
php artisan tinker
```

No tinker:
```php
User::create([
    'name' => 'Teste',
    'email' => 'teste@example.com',
    'password' => Hash::make('password'),
    'role' => 'user',
    'email_verified_at' => now(),
]);
```

### 3. Desenvolver Views Faltantes

As views principais já estão criadas:
- `resources/views/layouts/public.blade.php` - Layout público
- `resources/views/home.blade.php` - Homepage

Você pode criar as demais views seguindo o mesmo padrão.

### 4. Adicionar Dados de Exemplo

Crie seeders para popular o banco com dados de exemplo:

```bash
php artisan make:seeder ExampleDataSeeder
```

## 🔐 Segurança

**IMPORTANTE:** Antes de colocar em produção:

1. Altere a senha do admin
2. Configure APP_KEY única
3. Configure APP_DEBUG=false
4. Configure HTTPS
5. Configure backups do banco
6. Configure logs de auditoria

## 📚 Documentação Completa

Veja `PROJETO.md` para documentação detalhada de:
- Estrutura do banco de dados
- Todas as rotas disponíveis
- Funcionalidades implementadas
- Guia de deploy

## 🆘 Problemas Comuns

### Erro de conexão com banco
```bash
# Verifique se o MySQL está rodando
sudo service mysql status

# Verifique as credenciais no .env
```

### Erro de permissões
```bash
chmod -R 755 storage bootstrap/cache
```

### Assets não carregam
```bash
pnpm run build
php artisan view:clear
```

### Migrations já existem
```bash
# Recriar banco (CUIDADO: apaga todos os dados!)
php artisan migrate:fresh --seed
```

## 📞 Suporte

Dúvidas? Consulte:
- `PROJETO.md` - Documentação completa
- `README.md` - Informações do Laravel
- https://laravel.com/docs - Documentação oficial

---

**Boa sorte com o projeto! 🎉**
