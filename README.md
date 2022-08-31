# Taskato

A simple Laravel application to allow users to create group or list and add task for doing and self scheduling.

## Contents

- [Requirements](#requirements)
- [Getting Started](#getting-started)
  - [Installation](#installation)
  - [Configuration](#configuration)
  - [Assets](#assets)
  - [Run the Project](#run)
  - [All Commands](#all-commands)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [Built With](#built-with)
- [License](#license)

## Requirements

- [PHP](https://www.php.net/downloads) 8.1 or higher
- Database (eg: MySQL, PostgreSQL, SQLite)
- Web Server (eg: Apache, Nginx, IIS or use [Laragon](https://laragon.org/download/index.html))
- [Composer](https://getcomposer.org/download)
- [Node.js](http://nodejs.org)
- [Yarn](https://yarnpkg.com/en/docs/install) (optional)

## Getting Started

### Installation

Clone the repository and switch to the repo folder using the following command:

```shell
git clone git@github.com:sadegh19b/taskato.git
cd taskato
```

Install the php dependencies using composer:

```shell
composer install
```

Install the node dependencies:

- *using npm command*
    ```shell
    npm install
    ```

- *using yarn command*
    ```shell
    yarn
    ```

### Configuration

Copy the example environment (`.env.example`) file and configuration your change want in the `.env` file:

```shell
cp .env.example .env
```

Generate a new application key:

```shell
php artisan key:generate
```

Run the database migrations:
- *Before run below command, create a database in mysql and configure the `.env` file mysql settings according to your system.*
- *If you want the database with fake data, add the `--seed` parameter to the end of the command below.*

```shell
php artisan migrate
```

### Assets

Compile assets if you want work in development mode:

- *using npm command*
    ```shell
    npm run dev
    ```

- *using yarn command*
    ```shell
    yarn dev
    ```

Compile assets for production:

- *using npm command*
    ```shell
    npm run build
    ```

- *using yarn command*
    ```shell
    yarn build
    ```

### Run

Run the project in the dev server (the output will give the address):

```shell
php artisan serve
```

### All Commands:

```shell
git clone git@github.com:sadegh19b/taskato.git
cd taskato
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
yarn
yarn build
```

## Roadmap

- [ ] Write tests for logic and browser
- [ ] Add confirm modal component in svelte
- [ ] Add details modal component for show todo
- [ ] Add toast component for show message after save, update, delete or in error case
- [ ] Add pagination for todos, load more after scroll down
- [ ] Add custom scrollbar
- [ ] Responsive design
- [ ] PWA
- [ ] Multi-languages [FA, EN]


## Contributing

1. Clone the repo and create a new branch: `git checkout git@github.com:sadegh19b/taskato.git -b name_for_new_branch`
2. Make changes and test
3. Submit Pull Request with comprehensive description of changes

## Built With

This software uses the following open source packages:

- [Laravel](https://laravel.com)
- [Verta](https://hekmatinasser.github.io/verta)
- [Sortable Eloquent](https://github.com/spatie/eloquent-sortable)
- [Ziggy](https://github.com/tighten/ziggy)
- [Inertia.js](https://inertiajs.com)
- [Svelte](https://svelte.dev/)
- [TailwindCSS](https://tailwindcss.com)
- [daisyUI](https://daisyui.com)

## License

Taskato is open source software released under the MIT license. See [LICENSE](LICENSE) for more information.
