## Установка приложения

Для установки приложения необходимо запустить следующие команды:

1. `git clone --recurse-submodules https://github.com/KhizhenokPavel/ebus.git`
2. `cd ebus/laradock`
3. Скопировать файл .env:
    - Для Linux: `cp .env.example .env`
    - Для Windows: `copy .env.example .env`
4. Запустить Docker:
    - `docker-compose up -d nginx mysql phpmyadmin redis workspace`
5. Запустить bash-сессию в контейнере workspace:
    - `docker-compose exec workspace /bin/bash`
6. Инициализировать проект с помощью Composer:
    - `composer init-project`

Документация находится в папке docs
