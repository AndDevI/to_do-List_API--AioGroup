# API RESTful - Gerenciador de Tarefas

Este projeto é uma API RESTful desenvolvida com Laravel para gerenciar tarefas, permitindo a criação, leitura, atualização e exclusão (CRUD) de tarefas. A API também fornece a documentação completa utilizando **Swagger** para facilitar o uso e integração.

## Tabela de Conteúdos

- [Funcionalidades](#funcionalidades)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Documentação da API](#documentação-da-api)
- [Endpoints](#endpoints)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Contribuição](#contribuição)
- [Licença](#licença)

---

## Funcionalidades

- **CRUD completo para Tarefas**: Criar, ler, atualizar e deletar tarefas.
- **Validação de dados de entrada**: Garantia de segurança e integridade dos dados através de validações.
- **Documentação da API**: Toda a documentação da API gerada automaticamente com o Swagger.
- **Gerenciamento de Tarefas**: A API permite gerenciar tarefas com campos como título, descrição e status.

## Instalação

1. **Clone o repositório**:
    ```bash
    git clone https://github.com/seu-usuario/nome-do-repositorio.git
    cd nome-do-repositorio
    ```

2. **Instale as dependências do projeto**:
    ```bash
    composer install
    ```

3. **Configure o arquivo `.env`** com as credenciais do banco de dados:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha
    ```

4. **Execute as migrações** para criar as tabelas no banco de dados:
    ```bash
    php artisan migrate
    ```

5. **Inicie o servidor local**:
    ```bash
    php artisan serve
    ```


## Configuração

Para documentar e acessar os endpoints da API com Swagger:

1. Instale o Swagger Lume:
    ```bash
    composer require darkaonline/swagger-lume
    php artisan swagger-lume:publish
    ```

2. Acesse a documentação da API em `http://localhost:8000/api/documentation` após iniciar o servidor.

## Documentação da API

A API oferece suporte aos seguintes endpoints principais para Tarefas. A documentação detalhada pode ser acessada via Swagger.

### Endpoints

#### Tarefas

- **`GET /api/tasks`** - Listar todas as tarefas.
    - Retorna todas as tarefas armazenadas no banco de dados.
  
- **`POST /api/tasks`** - Criar uma nova tarefa.
    - Corpo da requisição:
    ```json
    {
        "title": "Título da tarefa",
        "description": "Descrição da tarefa",
        "status": "Pendente"
    }
    ```

- **`GET /api/tasks/{id}`** - Detalhar uma tarefa específica.
    - Retorna os detalhes da tarefa com o `id` informado.

- **`PUT /api/tasks/{id}`** - Atualizar uma tarefa existente.
    - Corpo da requisição:
    ```json
    {
        "title": "Novo título",
        "description": "Nova descrição",
        "status": "Concluída"
    }
    ```

- **`DELETE /api/tasks/{id}`** - Remover uma tarefa.
    - Deleta a tarefa com o `id` informado.

## Estrutura do Projeto

A estrutura de pastas do projeto segue as convenções do Laravel, com destaque para:

- `app/Http/Controllers` - Controladores da API, como o **TaskController** que gerencia as tarefas.
- `app/Http/Requests` - Validação de dados de entrada, com a classe **TaskRequest**.
- `app/Services` - Lógica de negócios para o gerenciamento das tarefas.
- `routes/api.php` - Definição de rotas para os endpoints da API.

## Tecnologias Utilizadas

- **Laravel** - Framework PHP utilizado para construir a API.
- **MySQL** - Banco de dados utilizado para armazenar as tarefas.
- **Swagger** - Ferramenta para gerar a documentação da API.
- **Composer** - Gerenciador de dependências PHP.
- **Insomnia** - Ferramentas para teste e validação da API.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
