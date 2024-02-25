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
    - **Kernel.php**
  - *Livewire*
    - **BookForm.php**
    - **BookList.php**
    - **TagForm.php**
  - *Models*
    - **Options.php**
  - *Providers*
    - **GoogleSearchServiceProvider.php**
    - **OptionsServiceProvider**
- *database*
  - *seeders*
    - **all of them**
- *resources*
  - *views*
    - *livewire*
      - **all of them**
- *tests*
  - *Unit*
    - **BookFormTest.php**
    - **TagFormTest.php**

## Setup
- Clone this repository.
- Run composer install.
- Start the Laravel Sail docker environment with vendor/bin/sail up.
- Access the Laravel application at http://localhost.
- Run vendor/bin/sail test to run tests.
