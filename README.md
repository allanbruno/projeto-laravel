# Sistema de Gerenciamento de Clientes - Laravel

## 📋 Sobre o Projeto
Sistema desenvolvido em Laravel 12 para gerenciamento de clientes, permitindo cadastro, edição, visualização e exclusão de registros com upload de imagens. O projeto utiliza tecnologias modernas como Livewire 3 para interações dinâmicas e Bootstrap 5 para interface responsiva.

## 🚀 Tecnologias Utilizadas

### Back-end
- PHP 8.2
- Laravel 12.0.1
- MySQL
- Laravel Livewire 3
- Storage para gerenciamento de arquivos

### Front-end
- Bootstrap 5.3.3
- FontAwesome 6.7.2
- JavaScript
- Vite 6.0.11

### Pacotes Principais
- GuzzleHTTP 7.9.2 - Cliente HTTP para requisições
- Monolog 3.8.1 - Sistema de logs

## 🔧 Configuração do Ambiente

### Pré-requisitos
- PHP >= 8.2
- Composer
- Node.js e NPM
- MySQL
- Git

### Instalação

1. Clone o repositório
```bash
git clone git@github.com:allanbruno/projeto-laravel.git
cd projeto-laravel
```

2. Instale as dependências do PHP
```bash
composer install
```

3. Instale as dependências do Node.js
```bash
npm install
```

4. Configure o ambiente
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure o banco de dados no arquivo `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco_de_dados
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

6. Execute as migrações
```bash
php artisan migrate
```

7. Crie o link simbólico para o storage
```bash
php artisan storage:link
```

8. Compile os assets
```bash
npm run dev
```

9. Execute o servidor de desenvolvimento
```bash
# Em um terminal
php artisan serve
```

O sistema estará disponível em:
- http://localhost:8000

💡 **Dica**: Mantenha os dois terminais abertos durante o desenvolvimento:
- Um para o servidor PHP (`php artisan serve`)
- Outro para o Vite (`npm run dev`)

## 📊 Estrutura do Projeto

### Principais Diretórios
```bash
├── app                     # Núcleo da aplicação
│   ├── Http               
│   │   ├── Controllers    # Controladores da aplicação
│   │   ├── Middleware     # Middlewares para filtrar requisições HTTP
│   │   └── Requests      # Classes de validação de formulários
│   ├── Models            # Models do Eloquent
│   └── Services         # Camada de serviços
├── config               # Arquivos de configuração
├── database            
│   ├── migrations      # Migrações do banco de dados
│   └── seeders        # Seeders para popular o banco
├── public             # Arquivos públicos
│   ├── css           # CSS compilado
│   └── js            # JavaScript compilado
├── resources         # Recursos não compilados
│   ├── css          # Arquivos SCSS/CSS
│   ├── js           # Arquivos JavaScript
│   └── views        # Views Blade
│       ├── layouts  # Templates base
│       └── livewire # Componentes Livewire
├── routes            # Definição das rotas
│   ├── web.php      # Rotas web
│   └── api.php      # Rotas API
├── storage          # Arquivos gerados pela aplicação
│   └── app         
│       └── public   # Arquivos públicos (uploads)
├── tests           # Diretório de testes
├── vendor         # Dependências do Composer
└── node_modules   # Dependências do NPM
```

### 📁 Descrição dos Diretórios Principais

#### `app/`
- Contém a lógica principal da aplicação
- Models, Controllers, Middleware e outros componentes core
- Organizado seguindo o padrão MVC do Laravel

#### `resources/`
- Arquivos fonte que precisam ser processados
- Views em Blade
- Arquivos CSS e JavaScript não compilados
- Componentes Livewire

#### `public/`
- Ponto de entrada da aplicação (index.php)
- Assets compilados
- Arquivos acessíveis diretamente pelo navegador

#### `storage/`
- Arquivos gerados pela aplicação
- Uploads de usuários
- Logs e cache

#### `routes/`
- Definição de todas as rotas da aplicação
- Separado em web e API para melhor organização

#### `config/`
- Arquivos de configuração da aplicação
- Configurações de banco de dados, cache, etc.

#### `database/`
- Migrações do banco de dados
- Seeders para dados iniciais
- Factories para testes

Esta estrutura segue as melhores práticas do Laravel e foi organizada para:
- Manter o código limpo e organizado
- Facilitar a manutenção
- Separar responsabilidades
- Permitir escalabilidade do projeto
