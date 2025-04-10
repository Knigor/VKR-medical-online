## ИС для медицинских онлайн консультаций

## Иструкция по запуску проекта

## Frontend

Для запуска или установки React Vite + TypeScripte требуется Node.js версии 18+ https://nodejs.org/en/
Если запуск происходит в первый раз, то нужно будет собрать проект, если уже файлы есть, инструкция ниже

1. Заходим в папку frontend `cd frontend`
2. Устанавливаем зависимости с помощью команды `npm install`
3. Запускам проект с помщоью команды `npm run dev`
4. Готово, фронт запущен

## Backend

1. Заходим в папку backend `cd backend`
2. Запускаем docker службу
3. Создаем образ `docker build -t <название образа> .`
4. Запускаем контейнер `docker compose -p <название контейнера> up -d`
5. Сервер запущен
6. Установка Symfony
7. Заходим в контейнер php `docker exec -it php81-container bash`
8. Прописываем команду `composer install`
9. Запускаем сервер: `symfony server:start --port=8080 -d`

## В папке postgres лежит файл дампа базы данных, который нужно выполнить

1. Чтобы зайти внутрь контейнера с базой данных введем команду `docker exec -it <container id> /bin/bash`
2. После попадания внутрь контейнера подключаемся к базе данных `psql -H postgres-db -U user -d obu-hack-2024`
3. Выполняем скрипт с базой данных `\i dump/<название файла.sql>`
4. Готово база данных создана и заполнена!

## заметки

Установка

1. Создаем Symfony проект `composer create-project symfony/skeleton:"7.1.*" .`
2. Создаем Docktrine ORM `composer require symfony/orm-pack`
3. Для того чтобы сгенерировать ключ `php bin/console lexik:jwt:generate-keypair`
