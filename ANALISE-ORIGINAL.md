# Análise do Projeto Escola Parque (TypeScript)

## Resumo Executivo

O projeto **Escola Parque** é uma aplicação web completa para gestão escolar desenvolvida com stack moderno TypeScript, incluindo:

- **Frontend**: React 19 + TypeScript + Vite + Tailwind CSS
- **Backend**: Express + tRPC + Drizzle ORM
- **Banco de Dados**: MySQL
- **Autenticação**: OAuth (Google, Apple, Microsoft, Manus)
- **Upload de Arquivos**: AWS S3

## Estrutura do Banco de Dados

### Tabelas Principais

1. **users** - Usuários administrativos
   - Campos: id, openId, name, email, loginMethod, role (user/admin), timestamps
   - Autenticação via OAuth

2. **parents** - Pais/Responsáveis
   - Campos: id, email, name, phone, provider, providerId, profilePicture, timestamps
   - Providers: google, apple, microsoft, manus

3. **heroBanners** - Banners do carrossel da homepage
   - Campos: title, subtitle, imageUrl, imageKey, ctaText, ctaLink, order, active

4. **differentials** - Diferenciais da escola
   - Campos: title, description, icon (lucide), order, active

5. **news** - Notícias e anúncios
   - Campos: title, slug, excerpt, content, coverImage, category, published, publishedAt, authorId
   - Categorias: announcement, event, achievement, general

6. **courses** - Cursos e currículos
   - Campos: name, slug, description, level, ageRange, curriculum (JSON), imageUrl, active, order
   - Níveis: infantil, fundamental1, fundamental2, medio

7. **albums** - Álbuns de fotos
   - Campos: title, description, eventDate, coverImage, published

8. **photos** - Fotos dos álbuns
   - Campos: albumId, imageUrl, imageKey, caption, order

9. **enrollments** - Matrículas de alunos
   - Campos: studentName, birthDate, parentName, parentEmail, parentPhone, address, courseId, level, status, notes
   - Status: pending, approved, rejected

10. **contacts** - Formulário de contato
    - Campos: name, email, phone, subject, message, status, notes
    - Status: new, read, replied

11. **partners** - Parceiros/patrocinadores
    - Campos: name, logoUrl, logoKey, website, order, active

12. **videos** - Vídeos institucionais
    - Campos: title, description, videoUrl, thumbnailUrl, category, active, order
    - Categorias: institutional, tour, event, testimonial

13. **parentStudentRelations** - Relação pais-alunos
    - Campos: parentId, enrollmentId, relationship
    - Relationships: mother, father, guardian, other

14. **studentProgress** - Progresso dos alunos
    - Campos: enrollmentId, subject, grade, attendance, behavior, notes, reportedAt

15. **parentCommunications** - Comunicações personalizadas para pais
    - Campos: enrollmentId, title, content, type, priority, read, readAt
    - Types: announcement, alert, achievement, event, report
    - Priority: low, normal, high

## Funcionalidades Principais

### Área Pública
- Homepage com carrossel de banners
- Listagem de diferenciais da escola
- Notícias e anúncios
- Galeria de fotos (álbuns)
- Cursos oferecidos
- Formulário de contato
- Formulário de matrícula
- Vídeos institucionais
- Parceiros/patrocinadores

### Área dos Pais (Parent Dashboard)
- Login via OAuth (Google, Apple, Microsoft, Manus)
- Visualização de progresso dos filhos
- Comunicações personalizadas
- Relatórios e notas

### Área Administrativa
- Dashboard com estatísticas
- Gestão de conteúdo:
  - Hero Banners
  - Diferenciais
  - Notícias
  - Cursos
  - Galeria de fotos
  - Vídeos
  - Parceiros
- Gestão de matrículas (aprovar/rejeitar)
- Gestão de contatos
- Relatórios
- Upload de imagens (S3)
- Editor de texto rico (TipTap)

## Componentes UI

O projeto utiliza **shadcn/ui** com Radix UI, incluindo:
- Accordion, Alert Dialog, Avatar, Badge, Button, Calendar, Card, Carousel
- Chart, Checkbox, Command, Context Menu, Dialog, Dropdown Menu
- Form, Input, Label, Navigation Menu, Popover, Progress, Radio Group
- Select, Separator, Slider, Switch, Tabs, Textarea, Toast, Tooltip

## Integrações

1. **AWS S3** - Upload e armazenamento de imagens
2. **WhatsApp API** - Envio de confirmações de matrícula e respostas de contato
3. **Google Maps** - Mapa de localização
4. **OAuth Providers** - Autenticação social

## Páginas Identificadas

### Públicas
- `/` - Home
- `/noticias` - Listagem de notícias
- `/noticias/:slug` - Detalhes da notícia
- `/cursos` - Cursos oferecidos
- `/galeria` - Galeria de fotos
- `/matricula` - Formulário de matrícula
- `/contato` - Formulário de contato

### Pais
- `/parent/login` - Login dos pais
- `/parent/dashboard` - Dashboard dos pais

### Admin
- `/admin/dashboard` - Dashboard administrativo
- `/admin/content` - Gestão de conteúdo
- `/admin/news` - Gestão de notícias
- `/admin/enrollments` - Gestão de matrículas
- `/admin/contacts` - Gestão de contatos
- `/admin/reports` - Relatórios

## Tecnologias e Bibliotecas Principais

- **React 19** com TypeScript
- **Vite** para build
- **Tailwind CSS 4** para estilização
- **Express** para servidor
- **tRPC** para API type-safe
- **Drizzle ORM** para banco de dados
- **Zod** para validação
- **TanStack Query** para gerenciamento de estado
- **Wouter** para roteamento
- **TipTap** para editor de texto rico
- **Lucide React** para ícones
- **Framer Motion** para animações
- **Recharts** para gráficos

## Requisitos para Conversão Laravel

### Funcionalidades a Implementar

1. **Autenticação Laravel**
   - Sistema de login/registro tradicional
   - Recuperação de senha via e-mail
   - Autenticação de dois fatores (2FA)
   - Confirmação de e-mail obrigatória (configurável no admin)
   - Roles: admin, parent, user

2. **Dashboard Admin**
   - Opção para exigir confirmação de e-mail dos usuários
   - Gestão de usuários
   - Todas as funcionalidades de gestão de conteúdo existentes

3. **Migrações e Models**
   - Converter todas as tabelas do schema Drizzle para migrations Laravel
   - Criar Models Eloquent correspondentes
   - Implementar relacionamentos

4. **Controllers e Rotas**
   - API RESTful para substituir tRPC
   - Controllers para cada recurso
   - Middleware de autenticação e autorização

5. **Views com Blade + Tailwind**
   - Recriar todas as páginas usando Blade
   - Manter o design com Tailwind CSS
   - Componentes reutilizáveis

6. **Upload de Arquivos**
   - Integração com AWS S3 ou filesystem local
   - Validação de imagens

7. **Notificações por E-mail**
   - Confirmação de cadastro
   - Recuperação de senha
   - Código 2FA
   - Notificações de matrícula

## Próximos Passos

1. Criar projeto Laravel 12
2. Configurar Tailwind CSS
3. Criar migrations baseadas no schema
4. Implementar sistema de autenticação completo
5. Desenvolver models e relacionamentos
6. Criar controllers e rotas
7. Desenvolver views com Blade
8. Implementar dashboard admin
9. Configurar e-mails
10. Testar todas as funcionalidades
