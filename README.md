# Laravel Book Storage Project
## Overview
This is a pet project aimed at learning Laravel TALL stack. It's built on Laravel 10.31.0 using PHP 8.1

This project allows users to manage books they've read and categorize them.

## Integrations
- AWS S3
- Google Search API

## Key areas to focus on:
- *app*
    - *Console*
        - [**Kernel.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/app/Console/Kernel.php)
    - *Livewire*
        - [**BookForm.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/app/Livewire/BookForm.php)
        - [**BookList.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/app/Livewire/BookList.php)
        - [**TagForm.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/app/Livewire/TagForm.php)
    - *Models*
        - [**Options.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/app/Models/Options.php)
    - *Providers*
        - [**GoogleSearchServiceProvider.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/app/Providers/GoogleSearchServiceProvider.php)
        - [**OptionsServiceProvider**](https://github.com/kuvinci/laravel-book-storage/blob/master/app/Providers/OptionsServiceProvider.php)
- *database*
    - *seeders*
        - [**all of them**](https://github.com/kuvinci/laravel-book-storage/tree/master/database/seeders)
- *resources*
    - *views*
        - *livewire*
            - [**all of them**](https://github.com/kuvinci/laravel-book-storage/tree/master/resources/views/livewire)
- *tests*
    - *Unit*
        - [**BookFormTest.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/tests/Unit/BookFormTest.php)
        - [**TagFormTest.php**](https://github.com/kuvinci/laravel-book-storage/blob/master/tests/Unit/TagFormTest.php)

## Setup
- Clone this repository.
- Run composer install.
- Start the Laravel Sail docker environment with vendor/bin/sail up.
- Access the Laravel application at http://localhost.
- Run vendor/bin/sail test to run tests.
