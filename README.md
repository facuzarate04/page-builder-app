# Page Builder App

Monolithic page-builder application where users can create their custom landing page and have their own endpoint with their.

### Prerequisites

- PHP
- Composer
- Laravel
- Node.js
- npm

### Installing

- Clone the repository: `git clone https://github.com/facuzarate04/page-builder-app.git`
- Navigate to the project directory: `cd repo`
- Install dependencies:
    - PHP dependencies: `composer install`
    - JavaScript dependencies: `npm install`
- Create a copy of the `.env.example` file and name it `.env`
- Generate an app key: `php artisan key:generate`
- Set up the database:
    - Update the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` values in the `.env` file with your database credentials
    - Run the migrations: `php artisan migrate`
- Compile the JavaScript assets: `npm run dev`
- Serve the application: `php artisan serve`

### Built With

- Laravel
- PHP
- Vue.js
- Inertia JS
- npm
