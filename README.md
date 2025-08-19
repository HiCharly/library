# Library

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)
![Build Status](https://img.shields.io/github/actions/workflow/status/hicharly/library/tests.yml?branch=main&logo=github)

---

## 📚 Presentation
**Library** is a Laravel application designed for managing school libraries.
It allows teachers to take inventory of the various libraries and books available and easily check if a book is already present at the school.

## 📖 Features
- **Library Management**  
  Create and manage multiple libraries to organize your book collections.

- **Book Management**  
  Add the books you own to your libraries, keeping track of your entire collection.

- **Google Books API Integration**  
  Automatically fetch detailed information (title, author, cover, etc.) for books using their barcode or ISBN.

- **Widgets**  
  Quickly check if a book is already in your collection with an easy-to-use search and scan widget.

## ⚙️ Installation
See [Configuring a shell alias](https://laravel.com/docs/12.x/sail#configuring-a-shell-alias) to setup the `sail` command.

````bash
composer install
cp .env.example .env
sail up -d
sail artisan key:generate
sail artisan migrate --seed
sail bun install
sail bun run dev
````
