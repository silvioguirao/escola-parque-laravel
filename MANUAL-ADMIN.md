# Manual do Administrador - Escola Parque

## Bem-vindo ao Sistema Escola Parque!

Este manual foi criado para ajudá-lo a gerenciar completamente o sistema da Escola Parque. Como administrador, você tem acesso total a todas as funcionalidades do sistema.

---

## 📋 Índice

1. [Acesso ao Sistema](#1-acesso-ao-sistema)
2. [Dashboard Administrativo](#2-dashboard-administrativo)
3. [Gestão de Conteúdo do Site](#3-gestão-de-conteúdo-do-site)
4. [Gestão de Matrículas](#4-gestão-de-matrículas)
5. [Gestão de Contatos](#5-gestão-de-contatos)
6. [Gestão de Usuários](#6-gestão-de-usuários)
7. [Segurança e Boas Práticas](#7-segurança-e-boas-práticas)
8. [Solução de Problemas](#8-solução-de-problemas)

---

## 1. Acesso ao Sistema

### 1.1 Primeiro Acesso

**URL de acesso:** `https://seu-dominio.com/login`

**Credenciais padrão (após instalação):**
- E-mail: `admin@escolaparque.com.br`
- Senha: `Admin@123`

⚠️ **IMPORTANTE:** Altere a senha após o primeiro acesso!

### 1.2 Login

1. Acesse a página de login
2. Insira seu e-mail e senha
3. Clique em "Entrar"

**Se você habilitou 2FA (Autenticação de Dois Fatores):**
4. Será solicitado um código de 6 dígitos
5. Abra seu aplicativo autenticador (Google Authenticator, Authy, etc.)
6. Insira o código mostrado
7. Clique em "Confirmar"

### 1.3 Recuperar Senha

Se esqueceu sua senha:

1. Clique em "Esqueceu sua senha?" na tela de login
2. Digite seu e-mail cadastrado
3. Clique em "Enviar link de redefinição"
4. Verifique seu e-mail (incluindo spam)
5. Clique no link recebido
6. Crie uma nova senha forte
7. Confirme a nova senha
8. Faça login com a nova senha

**Dicas para senha forte:**
- Mínimo 8 caracteres
- Inclua maiúsculas e minúsculas
- Inclua números
- Inclua caracteres especiais (@, #, $, etc.)

### 1.4 Habilitar Autenticação de Dois Fatores (2FA)

Para maior segurança, recomendamos habilitar o 2FA:

1. Após login, clique no seu nome (canto superior direito)
2. Selecione "Perfil"
3. Role até "Autenticação de Dois Fatores"
4. Clique em "Habilitar"
5. Escaneie o QR Code com seu app autenticador
6. Guarde os códigos de recuperação em local seguro
7. Insira o código mostrado no app para confirmar

---

## 2. Dashboard Administrativo

Após o login, você será redirecionado para o Dashboard Administrativo.

### 2.1 Visão Geral do Dashboard

O dashboard mostra:

**Estatísticas Principais:**
- 📊 **Total de Usuários** - Todos os usuários cadastrados
- 📝 **Matrículas Pendentes** - Aguardando sua aprovação
- 📧 **Contatos Novos** - Mensagens não lidas
- 📰 **Notícias Publicadas** - Notícias ativas no site
- 📚 **Cursos Ativos** - Cursos disponíveis

**Atividades Recentes:**
- Últimas 5 matrículas recebidas
- Últimos 5 contatos recebidos

### 2.2 Menu de Navegação

O menu lateral possui as seguintes opções:

```
🏠 Dashboard
├── 📋 Conteúdo do Site
│   ├── Banners
│   ├── Diferenciais
│   ├── Notícias
│   ├── Cursos
│   ├── Galeria de Fotos
│   ├── Vídeos
│   └── Parceiros
├── 📝 Gestão
│   ├── Matrículas
│   └── Contatos
└── 👥 Usuários
```

---

## 3. Gestão de Conteúdo do Site

### 3.1 Banners da Homepage

Os banners aparecem no carrossel da página inicial.

#### Como Adicionar um Novo Banner:

1. No menu lateral, clique em **"Banners"**
2. Clique no botão **"Novo Banner"**
3. Preencha os campos:
   - **Título:** Título principal do banner (ex: "Bem-vindo à Escola Parque")
   - **Subtítulo:** Texto secundário (ex: "Educação de qualidade desde 1990")
   - **URL da Imagem:** Link da imagem do banner (1920x600px recomendado)
   - **Texto do Botão (CTA):** Texto do botão (ex: "Conheça Mais")
   - **Link do Botão:** Para onde o botão direciona (ex: "/cursos")
   - **Ordem:** Posição no carrossel (1, 2, 3...)
   - **Ativo:** Marque para exibir no site
4. Clique em **"Salvar"**

#### Como Editar um Banner:

1. Na lista de banners, clique no ícone de editar (✏️)
2. Modifique os campos desejados
3. Clique em **"Atualizar"**

#### Como Desativar um Banner:

1. Edite o banner
2. Desmarque a opção **"Ativo"**
3. Salve as alterações

**OU**

1. Na lista, clique no ícone de excluir (🗑️)
2. Confirme a exclusão

**💡 Dicas:**
- Mantenha 3-5 banners ativos
- Use imagens de alta qualidade
- Textos curtos e objetivos funcionam melhor
- Teste em dispositivos móveis

### 3.2 Diferenciais da Escola

Diferenciais são os destaques que aparecem na homepage (ex: "Professores Qualificados", "Infraestrutura Moderna").

#### Como Adicionar um Diferencial:

1. Clique em **"Diferenciais"**
2. Clique em **"Novo Diferencial"**
3. Preencha:
   - **Título:** Nome do diferencial (ex: "Laboratório de Ciências")
   - **Descrição:** Texto explicativo (2-3 linhas)
   - **Ícone:** Nome do ícone Lucide (veja lista abaixo)
   - **Ordem:** Posição de exibição
   - **Ativo:** Marcar para exibir
4. Clique em **"Salvar"**

**Ícones Disponíveis (Lucide Icons):**
- `award` - Troféu/prêmio
- `book-open` - Livro aberto
- `users` - Pessoas/equipe
- `microscope` - Laboratório/ciência
- `music` - Música/artes
- `shield-check` - Segurança
- `heart` - Carinho/cuidado
- `globe` - Mundial/idiomas
- `graduation-cap` - Educação
- `laptop` - Tecnologia

**💡 Dicas:**
- Mantenha 4-6 diferenciais ativos
- Use descrições concisas
- Escolha ícones que representem bem cada item

### 3.3 Notícias

#### Como Publicar uma Notícia:

1. Clique em **"Notícias"**
2. Clique em **"Nova Notícia"**
3. Preencha os campos:
   - **Título:** Título da notícia (ex: "Festa Junina 2026")
   - **Slug:** URL amigável (gerado automaticamente ou customize)
     - Exemplo: `festa-junina-2026`
   - **Resumo:** Texto curto para lista (2-3 linhas)
   - **Conteúdo:** Texto completo da notícia
     - Use o editor rico para formatar
     - Adicione negrito, itálico, listas, etc.
   - **Imagem de Capa:** URL da imagem principal (800x600px recomendado)
   - **Categoria:** Escolha uma:
     - 📢 **Anúncio:** Avisos importantes
     - 📅 **Evento:** Eventos escolares
     - 🏆 **Conquista:** Prêmios, certificações
     - 📝 **Geral:** Outras notícias
   - **Publicado:** Marque para exibir no site
   - **Data de Publicação:** Quando a notícia deve aparecer
4. Clique em **"Salvar"**

#### Agendar Publicação:

Para publicar uma notícia no futuro:
1. Marque **"Publicado"**
2. Defina **"Data de Publicação"** no futuro
3. Salve

A notícia só aparecerá no site após a data definida.

**💡 Dicas:**
- Use títulos chamativos mas informativos
- Imagens atraem mais atenção
- Revise o texto antes de publicar
- Mantenha notícias antigas arquivadas (despublicadas)

### 3.4 Cursos

#### Como Cadastrar um Curso:

1. Clique em **"Cursos"**
2. Clique em **"Novo Curso"**
3. Preencha:
   - **Nome:** Nome do curso (ex: "Educação Infantil")
   - **Slug:** URL amigável (ex: `educacao-infantil`)
   - **Descrição:** Texto completo sobre o curso
   - **Nível:** Escolha:
     - 🍼 **Infantil** (0-5 anos)
     - 📖 **Fundamental I** (6-10 anos)
     - 📚 **Fundamental II** (11-14 anos)
     - 🎓 **Médio** (15-17 anos)
   - **Faixa Etária:** Idade recomendada (ex: "6 a 10 anos")
   - **Currículo:** Disciplinas oferecidas (JSON)
     ```json
     ["Português", "Matemática", "Ciências", "História", "Geografia"]
     ```
   - **Imagem:** URL da imagem do curso
   - **Ativo:** Marcar para exibir
   - **Ordem:** Ordem de exibição
4. Clique em **"Salvar"**

**💡 Dicas:**
- Descreva objetivos e metodologia
- Liste todos os diferenciais do curso
- Atualize o currículo anualmente

### 3.5 Galeria de Fotos

#### Como Criar um Álbum:

1. Clique em **"Galeria de Fotos"**
2. Clique em **"Novo Álbum"**
3. Preencha:
   - **Título:** Nome do evento (ex: "Festa Junina 2026")
   - **Descrição:** Sobre o evento
   - **Data do Evento:** Quando aconteceu
   - **Imagem de Capa:** Foto principal do álbum
   - **Publicado:** Marcar para exibir
4. Clique em **"Salvar"**

#### Como Adicionar Fotos ao Álbum:

1. Após criar o álbum, clique em **"Adicionar Fotos"**
2. Para cada foto:
   - **URL da Imagem:** Link da foto
   - **Legenda:** Descrição opcional
   - **Ordem:** Posição na galeria
3. Clique em **"Adicionar"**

**💡 Dicas:**
- Use fotos de boa qualidade
- Otimize imagens (redimensione antes de upload)
- Adicione legendas descritivas
- Organize fotos por ordem cronológica

### 3.6 Vídeos

#### Como Adicionar um Vídeo:

1. Clique em **"Vídeos"**
2. Clique em **"Novo Vídeo"**
3. Preencha:
   - **Título:** Nome do vídeo
   - **Descrição:** Sobre o que é o vídeo
   - **URL do Vídeo:** Link do YouTube ou Vimeo
     - Exemplo YouTube: `https://www.youtube.com/watch?v=VIDEO_ID`
   - **URL da Thumbnail:** Imagem de capa do vídeo
   - **Categoria:** Escolha:
     - 🏫 **Institucional:** Sobre a escola
     - 🚶 **Tour:** Passeio pelas instalações
     - 🎉 **Evento:** Eventos escolares
     - 💬 **Depoimento:** Relatos de pais/alunos
   - **Ativo:** Marcar para exibir
   - **Ordem:** Ordem de exibição
4. Clique em **"Salvar"**

**💡 Dicas:**
- Vídeos curtos (1-3 minutos) têm mais visualizações
- Use legendas quando possível
- Teste o link antes de salvar

### 3.7 Parceiros/Patrocinadores

#### Como Adicionar um Parceiro:

1. Clique em **"Parceiros"**
2. Clique em **"Novo Parceiro"**
3. Preencha:
   - **Nome:** Nome da empresa/instituição
   - **Logo:** URL do logotipo (400x200px recomendado)
   - **Website:** Site do parceiro (opcional)
   - **Ordem:** Ordem de exibição
   - **Ativo:** Marcar para exibir
4. Clique em **"Salvar"**

**💡 Dicas:**
- Use logos em fundo transparente (PNG)
- Mantenha tamanhos proporcionais
- Organize por relevância

---

## 4. Gestão de Matrículas

### 4.1 Visualizar Matrículas

1. Clique em **"Matrículas"** no menu
2. Veja a lista de todas as matrículas

**Filtros disponíveis:**
- 🟡 **Pendentes:** Aguardando aprovação
- 🟢 **Aprovadas:** Já aceitas
- 🔴 **Rejeitadas:** Recusadas

### 4.2 Analisar uma Matrícula

1. Na lista, clique no ícone de visualizar (👁️)
2. Veja os detalhes:
   - **Dados do Aluno:**
     - Nome completo
     - Data de nascimento
     - Idade (calculada automaticamente)
   - **Dados do Responsável:**
     - Nome
     - E-mail
     - Telefone
     - Endereço
   - **Dados da Matrícula:**
     - Curso escolhido
     - Nível educacional
     - Data de submissão
     - Status atual

### 4.3 Aprovar uma Matrícula

1. Abra os detalhes da matrícula
2. Clique no botão **"Aprovar Matrícula"**
3. Confirme a ação

**O que acontece:**
- Status muda para "Aprovado"
- Data de revisão é registrada
- Seu usuário é registrado como revisor
- Um log é criado no sistema
- 📧 **TODO:** E-mail de confirmação enviado ao responsável

### 4.4 Rejeitar uma Matrícula

1. Abra os detalhes da matrícula
2. Clique no botão **"Rejeitar Matrícula"**
3. Opcionalmente, adicione um motivo nas **"Observações"**
   - Exemplo: "Turma completa", "Documentação incompleta"
4. Confirme a ação

**O que acontece:**
- Status muda para "Rejeitado"
- Data de revisão é registrada
- Seu usuário é registrado como revisor
- Observações são salvas
- Um log é criado no sistema
- 📧 **TODO:** E-mail informando rejeição enviado

**💡 Dicas:**
- Analise matrículas diariamente
- Sempre adicione motivo ao rejeitar
- Mantenha registro das decisões
- Contate responsáveis se precisar de mais informações

### 4.5 Estatísticas de Matrículas

No dashboard, você vê:
- Total de matrículas recebidas
- Quantas estão pendentes
- Taxa de aprovação/rejeição

---

## 5. Gestão de Contatos

### 5.1 Visualizar Contatos

1. Clique em **"Contatos"** no menu
2. Veja todos os contatos recebidos

**Status possíveis:**
- 🔵 **Novo:** Ainda não lido
- ⚪ **Lido:** Visualizado mas não respondido
- 🟢 **Respondido:** Já respondido

### 5.2 Ler um Contato

1. Na lista, clique no ícone de visualizar (👁️)
2. Veja os detalhes:
   - Nome da pessoa
   - E-mail
   - Telefone (se fornecido)
   - Assunto
   - Mensagem completa
   - Data de envio

### 5.3 Marcar como Lido

1. Abra o contato
2. Clique em **"Marcar como Lido"**

**O que acontece:**
- Status muda para "Lido"
- Não aparece mais nos "novos"

### 5.4 Responder um Contato

**Atualmente:**
1. Copie o e-mail do solicitante
2. Use seu cliente de e-mail (Gmail, Outlook, etc.)
3. Envie a resposta
4. Volte ao sistema
5. Abra o contato novamente
6. Clique em **"Marcar como Respondido"**
7. Opcionalmente, adicione observações:
   - Exemplo: "Respondido em 07/01/2026 - Informações enviadas"
8. Confirme

**📧 Futuro:** Sistema enviará e-mails diretamente

**💡 Dicas:**
- Responda em até 24 horas
- Seja cordial e claro
- Mantenha registro das respostas nas observações
- Para perguntas frequentes, crie templates de resposta

### 5.5 Observações e Notas

Use o campo de observações para:
- Registrar o que foi respondido
- Marcar follow-ups necessários
- Anotar informações importantes
- Manter histórico de interações

---

## 6. Gestão de Usuários

### 6.1 Visualizar Usuários

1. Clique em **"Usuários"** no menu
2. Veja todos os usuários cadastrados

**Informações exibidas:**
- Nome
- E-mail
- Perfil (Admin/Parent/User)
- E-mail verificado?
- Data de cadastro

### 6.2 Criar Novo Usuário

1. Clique em **"Novo Usuário"**
2. Preencha:
   - **Nome Completo**
   - **E-mail:** Deve ser único
   - **Senha:** Mínimo 8 caracteres
   - **Confirmar Senha**
   - **Telefone:** Opcional
   - **Perfil:** Escolha:
     - 👨‍💼 **Admin:** Acesso total ao sistema
     - 👨‍👩‍👧 **Parent:** Acesso ao portal dos pais
     - 👤 **User:** Acesso básico (futuro)
   - **Requer Verificação de E-mail:** 
     - ✅ Marcado: Usuário deve verificar e-mail antes de acessar
     - ❌ Desmarcado: Acesso imediato
3. Clique em **"Salvar"**

**O que acontece:**
- Usuário é criado
- Se verificação obrigatória: E-mail de verificação é enviado
- Usuário pode fazer login (após verificar, se obrigatório)

### 6.3 Editar Usuário

1. Na lista, clique no ícone de editar (✏️)
2. Modifique os campos desejados
3. Clique em **"Atualizar"**

**Você pode alterar:**
- Nome
- E-mail
- Telefone
- Perfil (role)
- Exigência de verificação de e-mail

**⚠️ IMPORTANTE:**
- Não é possível alterar a senha por aqui
- Usuário deve usar "Esqueci minha senha" para redefinir

### 6.4 Alternar Verificação de E-mail

Para usuários já cadastrados, você pode:

1. Na lista de usuários, localize o usuário
2. Clique no botão **"Alternar Verificação"**
3. Confirme a ação

**Efeito:**
- Se estava obrigatório: Passa a ser opcional
- Se estava opcional: Passa a ser obrigatório

**Quando usar:**
- Permitir acesso temporário (desabilitar verificação)
- Aumentar segurança (habilitar verificação)

### 6.5 Excluir Usuário

1. Na lista, clique no ícone de excluir (🗑️)
2. Confirme a exclusão

**⚠️ CUIDADO:**
- Esta ação é permanente
- Todos os dados relacionados serão perdidos
- Não é possível excluir seu próprio usuário

**💡 Dicas:**
- Revise privilégios regularmente
- Remova usuários inativos
- Use senhas fortes
- Habilite 2FA para admins

---

## 7. Segurança e Boas Práticas

### 7.1 Segurança da Conta

**Senha Forte:**
- Mínimo 8 caracteres
- Combine maiúsculas, minúsculas, números e símbolos
- Nunca compartilhe sua senha
- Troque a senha periodicamente (a cada 3-6 meses)

**Autenticação de Dois Fatores (2FA):**
- **Sempre habilite** para contas admin
- Guarde os códigos de recuperação em local seguro
- Use apps confiáveis: Google Authenticator, Authy, Microsoft Authenticator

**Boas Práticas:**
- ❌ Não salve senha no navegador de computadores públicos
- ❌ Não acesse de redes Wi-Fi públicas sem VPN
- ✅ Sempre faça logout ao sair
- ✅ Mantenha seu e-mail de recuperação atualizado

### 7.2 Segurança do Conteúdo

**Antes de Publicar:**
- ✅ Revise textos e imagens
- ✅ Verifique links (teste se funcionam)
- ✅ Confira datas e informações
- ✅ Use imagens com direitos de uso

**Não Publique:**
- ❌ Informações pessoais de alunos sem autorização
- ❌ Fotos de menores sem autorização dos pais
- ❌ Conteúdo ofensivo ou inadequado
- ❌ Informações confidenciais da escola

**LGPD (Lei Geral de Proteção de Dados):**
- Respeite a privacidade dos dados pessoais
- Colete apenas dados necessários
- Não compartilhe dados sem autorização
- Mantenha dados seguros

### 7.3 Backup e Recuperação

**Recomendações:**
- Faça backup do banco de dados semanalmente
- Mantenha cópias em locais diferentes
- Teste restauração periodicamente
- Documente procedimentos de backup

**Comando de backup (para técnicos):**
```bash
php artisan backup:run
```

### 7.4 Atualizações

**Mantenha o sistema atualizado:**
- Atualize Laravel e dependências regularmente
- Aplique patches de segurança imediatamente
- Teste atualizações em ambiente de teste primeiro

---

## 8. Solução de Problemas

### 8.1 Problemas de Login

**Problema: Esqueci minha senha**
- Solução: Use "Esqueci minha senha" na tela de login

**Problema: E-mail de redefinição não chega**
- Verifique pasta de spam
- Confirme se o e-mail está correto
- Aguarde alguns minutos
- Contate o suporte técnico

**Problema: Código 2FA não funciona**
- Verifique se o relógio do seu dispositivo está correto
- Use um código de recuperação
- Desabilite e habilite 2FA novamente (se tiver acesso)

### 8.2 Problemas com Conteúdo

**Problema: Imagem não aparece**
- Verifique se a URL está correta
- Confirme se a imagem está hospedada online
- Teste a URL em uma nova aba do navegador
- Use formato compatível (JPG, PNG, GIF)

**Problema: Notícia não aparece no site**
- Verifique se está marcada como "Publicado"
- Confirme se a data de publicação já passou
- Limpe o cache do navegador (Ctrl+F5)

**Problema: Alterações não aparecem**
- Limpe o cache do sistema
- Recarregue a página (F5)
- Aguarde alguns minutos (cache do servidor)

### 8.3 Problemas com Matrículas/Contatos

**Problema: Não consigo aprovar matrícula**
- Verifique sua conexão com internet
- Recarregue a página
- Verifique se tem permissões de admin
- Contate suporte técnico

**Problema: E-mail não enviado**
- **Atualmente:** Funcionalidade ainda não implementada
- Envie e-mails manualmente
- Marque como respondido no sistema

### 8.4 Contatos de Suporte

**Suporte Técnico:**
- E-mail: `suporte.tecnico@escolaparque.com.br`
- Telefone: (11) 1234-5678
- WhatsApp: (11) 91234-5678

**O que informar ao suporte:**
- Descrição detalhada do problema
- Quando começou
- O que você estava fazendo
- Capturas de tela (se possível)
- Navegador e sistema operacional usado

---

## 9. Dicas e Truques

### 9.1 Atalhos de Teclado

- **Ctrl + S:** Salvar formulário
- **Ctrl + F:** Buscar na página
- **F5:** Recarregar página
- **Ctrl + F5:** Recarregar e limpar cache

### 9.2 Organização

**Conteúdo:**
- Mantenha no máximo 5-7 banners ativos
- Publique notícias regularmente (1-2 por semana)
- Revise conteúdo antigo trimestralmente
- Organize fotos por evento/data

**Matrículas:**
- Revise diariamente
- Responda em até 24-48 horas
- Mantenha registro das decisões
- Acompanhe taxa de conversão

**Contatos:**
- Responda no mesmo dia, se possível
- Crie templates para respostas comuns
- Mantenha histórico organizado

### 9.3 Checklist Diário

```
□ Verificar matrículas pendentes
□ Verificar contatos novos
□ Revisar notícias agendadas
□ Verificar estatísticas do dashboard
□ Fazer logout ao terminar
```

### 9.4 Checklist Semanal

```
□ Publicar pelo menos 1 notícia
□ Atualizar eventos futuros
□ Revisar conteúdo desatualizado
□ Verificar links quebrados
□ Fazer backup dos dados
```

### 9.5 Checklist Mensal

```
□ Analisar estatísticas gerais
□ Atualizar cursos e preços
□ Revisar usuários ativos
□ Auditar permissões
□ Atualizar galeria de fotos
```

---

## 10. Glossário

**2FA:** Autenticação de Dois Fatores - Camada extra de segurança  
**Slug:** URL amigável (ex: `minha-noticia`)  
**CTA:** Call to Action - Botão de ação  
**Dashboard:** Painel de controle  
**CRUD:** Create, Read, Update, Delete - Operações básicas  
**Middleware:** Filtro de acesso  
**Role:** Perfil/função do usuário  
**Enum:** Lista fixa de valores possíveis  
**Cache:** Armazenamento temporário para performance  
**Log:** Registro de atividades do sistema  

---

## 11. Recursos Adicionais

### Documentação Relacionada

- **LOGICA-DO-SISTEMA.md:** Documentação técnica completa
- **SECURITY.md:** Boas práticas de segurança
- **CODE_QUALITY.md:** Padrões de código
- **MELHORIAS.md:** Histórico de melhorias

### Tutoriais em Vídeo

*Em desenvolvimento*

### Comunidade

*Fórum de discussão em desenvolvimento*

---

## Conclusão

Parabéns! Você agora tem todo o conhecimento necessário para administrar o Sistema Escola Parque com confiança.

**Lembre-se:**
- Segurança em primeiro lugar
- Mantenha o conteúdo atualizado
- Responda rapidamente a matrículas e contatos
- Faça backups regularmente
- Quando em dúvida, consulte este manual ou contate o suporte

**Bom trabalho! 🎉**

---

**Manual do Administrador v1.0**  
**Última atualização:** Janeiro 2026  
**Sistema Escola Parque - Laravel 12**
