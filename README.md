# Taskato
A simple Laravel application to allow users to create lists, and add todo for doing and self scheduling.

## Installation
1. Download the latest release (terminal commands)
    - `git clone https://github.com/sadegh19b/taskato.git`
2. Within the new directory run the following
    1. `composer install`
    2. `cp .env.example .env`
    3. `php artisan key:generate`
    4. `php artisan migrate --seed`
    5. `npm install`
    6. `npm run build` or `npm run dev`

Now, you can run application from localhost with `php artisan serve` command. 
