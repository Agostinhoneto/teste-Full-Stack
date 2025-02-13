🚀 Teste Full Stack

## 🛠️ Requisitos

Antes de começar, certifique-se de que seu ambiente atende aos seguintes requisitos:

- PHP 8.1 ou superior
- Composer (gerenciador de dependências do PHP)
- MySQL ou outro banco de dados compatível
- Node.js (para gerenciamento de dependências front-end)
- Laravel 10.x
- Extensão BCMath habilitada
- XAMPP ou Docker (opcional, para ambiente local)

### Passos para Configuração

1. Clone o repositório:
    ```bash
    git clone https://github.com/Agostinhoneto/teste-Full-Stack
    cd teste-Full-Stack
    cp .env.example .env
    ```

2. Configure o arquivo `.env` com as informações do banco de dados:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha
    ```

3. Instale as dependências do projeto:
    ```bash
    composer install
    npm install
    ```

4. Gere a chave da aplicação e execute as migrações e seeders:
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    php artisan serve
    ```

## 🛠️ Comandos Úteis

| Comando                | Descrição                                      |
|------------------------|------------------------------------------------|
| `php artisan migrate`  | Executa as migrações do banco de dados         |
| `php artisan db:seed`  | Popula o banco de dados com dados iniciais     |
| `npm run dev`          | Compila os assets front-end                    |
| `php artisan serve`    | Inicia o servidor local                        |

## 🛠️ Login do Admin Seeder

Após executar os seeders, você pode usar as seguintes credenciais para acessar a conta de administrador:

- **Email:** admin@admin.com
- **Senha:** password

*Caso queira criar um novo usuário, há a opção na tela de cadastro do próprio ADMIN.*

## 🧪 Testes

Para rodar os testes, o banco de dados precisa estar limpo. Execute os seguintes comandos antes de rodar os testes:

```bash
php artisan migrate:fresh
php artisan db:seed
php artisan test
```