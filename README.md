🚀 Teste Full Stack

🛠️ Requisitos

Antes de começar, certifique-se de que seu ambiente atende aos seguintes requisitos:

PHP 8.1 ou superior
Composer (gerenciador de dependências do PHP)
MySQL ou outro banco de dados compatível
Node.js (para gerenciamento de dependências front-end)
Laravel 10.x
Extensão BCMath habilitada
XAMPP ou Docker (opcional, para ambiente local).



git clone https://github.com/Agostinhoneto/teste-Full-Stack

cd teste-Full-Stack


cp .env.example .env


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha


composer install
npm install


php artisan key:generate

php artisan migrate --seed

php artisan serve

🛠️ Comandos Úteis

Comando	Descrição
php artisan migrate	Executa as migrações do banco de dados
php artisan db:seed	Popula o banco de dados com dados iniciais
npm run dev	Compila os assets front-end
php artisan serve	Inicia o servidor local

