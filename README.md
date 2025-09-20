# Library

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-blue?logo=php)
![Build Status](https://img.shields.io/github/actions/workflow/status/hicharly/library/tests.yml?branch=main&logo=github)
[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2Fdc4168d8-0af4-4cc4-aa6d-da154978f379%3Fdate%3D1&style=plastic)](https://forge.laravel.com/servers/954062/sites/2831007)

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

- **Library Sharing**  
  Share your libraries with other users and collaborate on book collections. Set different permission levels (viewer, editor) to control access to your libraries.

## ⚙️ Installation
See [Configuring a shell alias](https://laravel.com/docs/12.x/sail#configuring-a-shell-alias) to setup the `sail` command.

````bash
composer install
cp .env.example .env
sail up -d
sail artisan key:generate
sail artisan migrate --seed
sail npm install
sail npm run dev
````
