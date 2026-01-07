# Lógica do Sistema - Escola Parque

## Visão Geral

O Sistema Escola Parque é uma plataforma web completa desenvolvida em Laravel 12 para gestão escolar, dividida em três áreas principais:
1. **Área Pública** - Site institucional acessível a todos
2. **Área Administrativa** - Dashboard para gestão completa do sistema
3. **Portal dos Pais** - Área restrita para pais/responsáveis

---

## Arquitetura do Sistema

### Stack Tecnológico

```
Frontend:
├── Blade Templates (Laravel)
├── Tailwind CSS 3
├── Alpine.js
└── Vite (Build tool)

Backend:
├── Laravel 12 (PHP 8.2+)
├── MySQL (Banco de dados)
├── Laravel Breeze (Autenticação)
└── Laravel Fortify (2FA)

Segurança:
├── CSRF Protection
├── Rate Limiting
├── SQL Injection Prevention (Eloquent)
├── XSS Protection (Blade)
└── Two-Factor Authentication
```

### Estrutura de Diretórios

```
app/
├── Enums/              # Enumerações type-safe (PHP 8.1+)
│   ├── ContactStatus.php
│   ├── EnrollmentStatus.php
│   ├── NewsCategory.php
│   └── EducationLevel.php
├── Http/
│   ├── Controllers/    # Controladores HTTP
│   │   ├── Admin/      # Controladores administrativos
│   │   ├── Auth/       # Controladores de autenticação
│   │   └── Parent/     # Controladores dos pais
│   ├── Middleware/     # Middlewares customizados
│   └── Requests/       # Form Request Validators
│       ├── StoreContactRequest.php
│       └── StoreEnrollmentRequest.php
├── Models/             # Models Eloquent
│   ├── User.php
│   ├── Enrollment.php
│   ├── Contact.php
│   ├── News.php
│   └── ... (outros models)
└── Services/           # Camada de serviços (lógica de negócio)
    ├── ContactService.php
    └── EnrollmentService.php
```

---

## Fluxo de Dados e Lógica de Negócio

### 1. Área Pública

#### Homepage (/)
```
Usuário acessa → HomeController
                 ↓
                 Carrega dados:
                 ├── Banners ativos (ordenados)
                 ├── Diferenciais ativos
                 ├── Últimas 6 notícias publicadas
                 └── Parceiros ativos
                 ↓
                 Renderiza view 'home'
```

**Lógica implementada:**
- Eager loading de relacionamentos (previne N+1 queries)
- Apenas conteúdo ativo é exibido
- Ordenação por campo 'order'
- Cache preparado para implementação futura

#### Formulário de Matrícula (/matricula)

```
1. GET /matricula
   └── Exibe formulário com lista de cursos ativos

2. POST /matricula (com dados do formulário)
   ↓
   Validação (StoreEnrollmentRequest)
   ├── Todos os campos obrigatórios
   ├── E-mail válido
   ├── Data de nascimento no passado
   └── Nível educacional válido (enum)
   ↓
   Se válido:
   ├── EnrollmentService.create()
   │   ├── Define status = 'pending'
   │   ├── Adiciona submitted_at = now()
   │   ├── Salva no banco
   │   └── Registra log
   └── Redireciona para home com mensagem de sucesso
   
   Se inválido:
   └── Retorna formulário com erros
```

**Rate Limiting:**
- Máximo de 5 submissões por minuto por IP
- Previne spam e abuso

**Dados salvos:**
```php
enrollments:
├── student_name      // Nome do aluno
├── birth_date        // Data de nascimento
├── parent_name       // Nome do responsável
├── parent_email      // E-mail do responsável
├── parent_phone      // Telefone do responsável
├── address           // Endereço completo
├── course_id         // Curso desejado (opcional)
├── level             // Nível educacional
├── status            // pending/approved/rejected
├── submitted_at      // Data de submissão
└── reviewed_at       // Data de revisão (após admin aprovar/rejeitar)
```

#### Formulário de Contato (/contato)

```
1. GET /contato
   └── Exibe formulário de contato

2. POST /contato (com dados do formulário)
   ↓
   Validação (StoreContactRequest)
   ├── Nome obrigatório
   ├── E-mail válido obrigatório
   ├── Assunto obrigatório
   ├── Mensagem obrigatória (máx 5000 chars)
   └── Telefone opcional
   ↓
   Se válido:
   ├── ContactService.create()
   │   ├── Define status = 'new'
   │   ├── Adiciona submitted_at = now()
   │   ├── Salva no banco
   │   └── Registra log
   └── Redireciona para home com mensagem de sucesso
```

**Rate Limiting:**
- Máximo de 10 submissões por minuto por IP

---

### 2. Sistema de Autenticação

#### Tipos de Usuário (Roles)

```php
User Roles:
├── admin   → Acesso total ao sistema
├── parent  → Acesso ao portal dos pais
└── user    → Acesso básico (futuro)
```

#### Fluxo de Login

```
1. Usuário acessa /login
   ↓
2. Insere e-mail e senha
   ↓
3. Laravel valida credenciais
   ↓
4. Se 2FA habilitado:
   ├── Solicita código do app autenticador
   └── Valida código
   ↓
5. Se e-mail não verificado E require_email_verification = true:
   ├── Redireciona para tela de verificação
   └── Envia e-mail com link de verificação
   ↓
6. Login bem-sucedido:
   └── Redireciona para /dashboard
       ↓
       Dashboard verifica role:
       ├── admin → /admin/dashboard
       ├── parent → /parent/dashboard
       └── user → /dashboard (padrão)
```

#### Segurança de Autenticação

- **CSRF Protection:** Todos os formulários incluem token CSRF
- **Rate Limiting:** Limita tentativas de login
- **Password Hashing:** Bcrypt automático
- **Session Security:** HTTP-only cookies, SameSite protection
- **Two-Factor Authentication:** Opcional, configurável por usuário
- **Email Verification:** Configurável individualmente por admin

---

### 3. Área Administrativa

#### Controle de Acesso

```
Middleware: EnsureUserIsAdmin
├── Verifica se usuário está autenticado
├── Verifica se e-mail foi verificado (se required)
└── Verifica se role = 'admin'
    ↓
    Se qualquer condição falhar:
    └── Retorna erro 403 (Forbidden)
```

#### Dashboard Administrativo (/admin/dashboard)

```
Carrega estatísticas:
├── Total de usuários
├── Matrículas pendentes (status = pending)
├── Contatos novos (status = new)
├── Notícias publicadas
└── Cursos ativos

Carrega atividades recentes:
├── Últimas 5 matrículas (com curso relacionado)
└── Últimos 5 contatos
```

#### Gestão de Conteúdo (CRUDs)

Todos os módulos seguem o padrão RESTful Resource Controller:

```
Routes Pattern:
GET    /admin/resource          → index()   (listar)
GET    /admin/resource/create   → create()  (formulário novo)
POST   /admin/resource          → store()   (salvar novo)
GET    /admin/resource/{id}     → show()    (visualizar)
GET    /admin/resource/{id}/edit → edit()   (formulário edição)
PUT    /admin/resource/{id}     → update()  (salvar edição)
DELETE /admin/resource/{id}     → destroy() (deletar)
```

**Módulos disponíveis:**
1. Hero Banners (`/admin/hero-banners`)
2. Diferenciais (`/admin/differentials`)
3. Notícias (`/admin/news`)
4. Cursos (`/admin/courses`)
5. Álbuns de Fotos (`/admin/albums`)
6. Parceiros (`/admin/partners`)
7. Vídeos (`/admin/videos`)

#### Gestão de Matrículas

```
Fluxo de aprovação:

1. Admin acessa /admin/enrollments
   ├── Lista todas as matrículas
   └── Filtros disponíveis: pending, approved, rejected

2. Admin seleciona matrícula
   ↓
3. Visualiza detalhes:
   ├── Dados do aluno
   ├── Dados do responsável
   ├── Curso escolhido
   └── Status atual

4. Admin pode:
   ├── Aprovar → PATCH /admin/enrollments/{id}/approve
   │   └── EnrollmentService.approve()
   │       ├── status = 'approved'
   │       ├── reviewed_at = now()
   │       ├── reviewed_by = admin.id
   │       └── Log: "Enrollment approved"
   │
   └── Rejeitar → PATCH /admin/enrollments/{id}/reject
       └── EnrollmentService.reject()
           ├── status = 'rejected'
           ├── reviewed_at = now()
           ├── reviewed_by = admin.id
           ├── notes = motivo (opcional)
           └── Log: "Enrollment rejected"
```

#### Gestão de Contatos

```
Workflow:

1. Novo contato chega (status = 'new')
   ↓
2. Admin visualiza no dashboard ou em /admin/contacts
   ↓
3. Admin lê o contato:
   └── PATCH /admin/contacts/{id}/mark-read
       └── ContactService.markAsRead()
           ├── status = 'read'
           └── Log: "Contact marked as read"
   ↓
4. Admin responde (por e-mail externo)
   ↓
5. Admin marca como respondido:
   └── PATCH /admin/contacts/{id}/mark-replied
       └── ContactService.markAsReplied()
           ├── status = 'replied'
           ├── notes = observações (opcional)
           └── Log: "Contact marked as replied"
```

#### Gestão de Usuários

```
Admin pode:

1. Listar todos os usuários
   └── GET /admin/users

2. Criar novo usuário
   ├── GET /admin/users/create
   └── POST /admin/users
       Campos:
       ├── name
       ├── email
       ├── password
       ├── role (admin/parent/user)
       ├── phone
       └── require_email_verification (true/false)

3. Editar usuário existente
   └── PUT /admin/users/{id}

4. Alternar verificação de e-mail
   └── PATCH /admin/users/{id}/toggle-email-verification
       └── Inverte o valor de require_email_verification
```

---

### 4. Portal dos Pais

```
Acesso: /parent/dashboard

Funcionalidades:
├── Visualizar dados dos filhos matriculados
├── Acompanhar progresso acadêmico
├── Ver comunicações da escola
└── Visualizar notas e relatórios

Relações no banco:
parents → parent_student_relations → enrollments
                                    ├→ student_progress
                                    └→ parent_communications
```

---

## Camada de Serviços (Service Layer)

### Por que usar Services?

1. **Separação de responsabilidades:**
   - Controllers: apenas HTTP (request → response)
   - Services: lógica de negócio

2. **Reutilização:**
   - Mesma lógica pode ser usada em controllers, commands, jobs

3. **Testabilidade:**
   - Fácil criar testes unitários para services

4. **Logging centralizado:**
   - Todas as operações críticas são logadas

### EnrollmentService

```php
Métodos:

create(array $data): Enrollment
├── Define status = pending
├── Define submitted_at = now()
├── Cria matrícula no banco
└── Log: "New enrollment created"

approve(Enrollment $enrollment, User $reviewer): Enrollment
├── Atualiza status = approved
├── Define reviewed_at e reviewed_by
├── Log: "Enrollment approved"
└── TODO: Enviar notificação para responsável

reject(Enrollment $enrollment, User $reviewer, ?string $notes): Enrollment
├── Atualiza status = rejected
├── Define reviewed_at, reviewed_by e notes
├── Log: "Enrollment rejected"
└── TODO: Enviar notificação para responsável

getPendingCount(): int
└── Retorna contagem de matrículas pendentes

getStatistics(): array
└── Retorna array com totais por status
```

### ContactService

```php
Métodos:

create(array $data): Contact
├── Define status = new
├── Define submitted_at = now()
├── Cria contato no banco
└── Log: "New contact message received"

markAsRead(Contact $contact): Contact
├── Atualiza status = read
└── Log: "Contact marked as read"

markAsReplied(Contact $contact, ?string $notes): Contact
├── Atualiza status = replied
├── Atualiza notes se fornecido
└── Log: "Contact marked as replied"

getNewCount(): int
└── Retorna contagem de contatos novos

getStatistics(): array
└── Retorna array com totais por status
```

---

## Enums e Type Safety

### O que são Enums?

Enums (enumerações) são tipos de dados que representam um conjunto fixo de valores. No PHP 8.1+, enums substituem "magic strings" e fornecem type safety.

### Enums Implementados

#### 1. EnrollmentStatus

```php
enum EnrollmentStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    // Métodos auxiliares
    public function label(): string;      // Pendente / Aprovado / Rejeitado
    public function badgeClass(): string; // Classes CSS para badges
    public static function values(): array; // ['pending', 'approved', 'rejected']
}

Uso:
$enrollment->status = EnrollmentStatus::PENDING;
if ($enrollment->status === EnrollmentStatus::APPROVED) { ... }
```

#### 2. ContactStatus

```php
enum ContactStatus: string
{
    case NEW = 'new';
    case READ = 'read';
    case REPLIED = 'replied';

    // Métodos similares
}
```

#### 3. NewsCategory

```php
enum NewsCategory: string
{
    case ANNOUNCEMENT = 'announcement';
    case EVENT = 'event';
    case ACHIEVEMENT = 'achievement';
    case GENERAL = 'general';

    public function icon(): string; // Retorna nome do ícone Lucide
}
```

#### 4. EducationLevel

```php
enum EducationLevel: string
{
    case INFANTIL = 'infantil';
    case FUNDAMENTAL1 = 'fundamental1';
    case FUNDAMENTAL2 = 'fundamental2';
    case MEDIO = 'medio';

    public function ageRange(): string; // 0-5 anos / 6-10 anos / etc
}
```

---

## Banco de Dados

### Estrutura Principal

```
users (Usuários do sistema)
├── id
├── name
├── email
├── password (hashed)
├── role (admin/parent/user)
├── phone
├── require_email_verification
├── email_verified_at
├── two_factor_secret
└── two_factor_recovery_codes

enrollments (Matrículas)
├── id
├── student_name
├── birth_date
├── parent_name
├── parent_email
├── parent_phone
├── address
├── course_id (FK courses)
├── level (infantil/fundamental1/fundamental2/medio)
├── status (pending/approved/rejected)
├── notes
├── submitted_at
├── reviewed_at
└── reviewed_by (FK users)

contacts (Contatos)
├── id
├── name
├── email
├── phone
├── subject
├── message
├── status (new/read/replied)
├── notes
└── submitted_at

news (Notícias)
├── id
├── title
├── slug
├── excerpt
├── content
├── cover_image_url
├── category (announcement/event/achievement/general)
├── published (boolean)
├── published_at
└── author_id (FK users)

courses (Cursos)
├── id
├── name
├── slug
├── description
├── level
├── age_range
├── curriculum (JSON)
├── image_url
├── active (boolean)
└── order

hero_banners (Banners da homepage)
├── id
├── title
├── subtitle
├── image_url
├── cta_text
├── cta_link
├── order
└── active (boolean)

differentials (Diferenciais da escola)
├── id
├── title
├── description
├── icon (nome do ícone Lucide)
├── order
└── active (boolean)

albums (Álbuns de fotos)
├── id
├── title
├── description
├── event_date
├── cover_image_url
└── published (boolean)

photos (Fotos dos álbuns)
├── id
├── album_id (FK albums)
├── image_url
├── caption
└── order

partners (Parceiros)
├── id
├── name
├── logo_url
├── website
├── order
└── active (boolean)

videos (Vídeos)
├── id
├── title
├── description
├── video_url
├── thumbnail_url
├── category
├── active (boolean)
└── order
```

### Relacionamentos

```
User (1) ─── (N) News (como author)
User (1) ─── (N) Enrollments (como reviewer)

Course (1) ─── (N) Enrollments

Album (1) ─── (N) Photos

Enrollment (1) ─── (N) ParentStudentRelations
Enrollment (1) ─── (N) StudentProgress
Enrollment (1) ─── (N) ParentCommunications

Parent (1) ─── (N) ParentStudentRelations
```

---

## Segurança

### Medidas Implementadas

1. **Autenticação:**
   - Laravel Breeze (login/registro)
   - Laravel Fortify (2FA, verificação de e-mail)
   - Passwords hasheados com bcrypt
   - Session security (HTTP-only, SameSite)

2. **Autorização:**
   - Role-based access control (RBAC)
   - Middleware `EnsureUserIsAdmin` para rotas admin
   - Verificação de e-mail configurável

3. **Proteção contra ataques:**
   - CSRF protection automático
   - SQL Injection prevention (Eloquent ORM)
   - XSS protection (Blade escaping automático)
   - Rate limiting em formulários públicos

4. **Logging e Auditoria:**
   - Todas operações críticas são logadas
   - Logs incluem: ID da operação, usuário, timestamp

5. **Validação de entrada:**
   - Form Request classes com regras robustas
   - Validação com enums (type-safe)
   - Mensagens de erro em português

---

## Performance

### Otimizações Implementadas

1. **Eager Loading:**
   ```php
   // Evita N+1 queries
   News::with('author')->published()->get();
   Enrollment::with('course')->latest()->get();
   ```

2. **Database Indexing:**
   - Foreign keys indexadas automaticamente
   - Campos de busca frequente devem ter índices

3. **Query Optimization:**
   - Uso de scopes para queries comuns
   - Paginação para grandes datasets

4. **Caching (preparado):**
   - Cache de banners, diferenciais, parceiros
   - Invalidação automática ao editar

---

## Logging e Monitoramento

### Eventos Logados

```php
INFO:
├── "New enrollment created" (enrollment_id, student_name, parent_email)
├── "Enrollment approved" (enrollment_id, reviewer_id)
├── "Enrollment rejected" (enrollment_id, reviewer_id)
├── "New contact message received" (contact_id, name, email, subject)
├── "Contact marked as read" (contact_id)
└── "Contact marked as replied" (contact_id)

ERROR:
└── Erros de validação, exceções, falhas de autenticação
```

### Localização dos Logs

```
storage/logs/laravel.log
```

---

## Próximas Implementações (TODOs)

### Curto Prazo
- [ ] Sistema de notificações por e-mail
- [ ] Upload de imagens (AWS S3 ou local)
- [ ] Implementar views dos CRUDs administrativos
- [ ] Caching de dados frequentes

### Médio Prazo
- [ ] API RESTful para mobile app
- [ ] Sistema de relatórios em PDF
- [ ] Integração com WhatsApp API
- [ ] Dashboard analytics avançado

### Longo Prazo
- [ ] Sistema de pagamentos
- [ ] Portal do aluno
- [ ] Sistema de notas e boletins
- [ ] Agenda escolar online

---

## Conclusão

O Sistema Escola Parque foi desenvolvido seguindo as melhores práticas do Laravel:
- ✅ Arquitetura limpa e organizada
- ✅ Type safety com PHP 8.1+ Enums
- ✅ Service Layer para lógica de negócio
- ✅ Segurança robusta
- ✅ Performance otimizada
- ✅ Código testável e manutenível
- ✅ Documentação completa

O sistema está preparado para crescer e escalar conforme as necessidades da escola.

---

**Última atualização:** Janeiro 2026  
**Versão:** 1.0  
**Documentação técnica completa**
