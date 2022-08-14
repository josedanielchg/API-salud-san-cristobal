## How to install in local:

1. Run `git clone https://github.com/josedanielchg/API-salud-san-cristobal.git`
2. Go to project folder `cd API-salud-san-cristobal/`
3. Run `composer install`
4. Copy `.env.example` file to `.env` on the root folder. You can type `copy .env.example .env` if using command prompt Windows or `cp .env.example .env` if using terminal,
5. Open your `.env` file and change the database name `DB_DATABASE` to whatever you have, username `DB_USERNAME` and password `DB_PASSWORD` field correspond to your configuration.
6. Run `php artisan key:generate`.
7. Run `php artisan migrate`.
8. Run `php artisan serve`.
9. Go to `http://localhost:8000/`.
10. Register and get started (No email or spam will be sent to you)