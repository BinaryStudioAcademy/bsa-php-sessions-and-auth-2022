# Сессии и аутентификация. Домашнее задание

## Установка приложения

1. Склонировать текущий репозиторий локально
2. Запустить команду `composer install`
3. Создать файлик `.env`, скопировать в него содержимое файла `.env.example`
4. В файле `.env` обновить конфигурацию подключения к базе данных (ключи `DB_*`)
5. Проверить, что подключение к БД работает. Запустить команду `php artisan migrate`. Если все настроено правильно - 
запустятся миграции которые создадут необходимые таблицы в базе данных
6. Запустить команду `php artisan ui bootstrap`
7. Запустить команду `php artisan key:generate`
8. Запустить команду `npm install`
9. Запустить команду `php artisan serve`
10. Открыть адрес [127.0.0.1:8000](http://127.0.0.1:8000) (если не меняли этот конфиг в файле `.env`)

## oAuth аутентификация

В этой части домашнего задания необходимо добавить к приложению на Laravel возможность аутентафикация с помощью Google

Полезные ссылки:
- https://laravel.com/docs/8.x/socialite
- https://github.com/laravel/socialite

## Доступ к частям приложения основанный на роли пользователя

Данное приложения является простым сайтом для создания контента - статей. Статьи представлены таблицей базы данных
`articles` и содежрат следующие поля: `title`, `body`, `user_id` (автор), `slug` (имя статьи, отображаемое в адресной строке),
`status` (состояние статьи - `draft`, `under_moderation`, `published`, `unpublished`)

Необходимо имплементировать следующее:
- У пользователя может быть 1 из 3х ролей - `admin`, `moderator`, `creator`
  - `creator` - может создавать статьи в статусе `draft`, редактировать **свои** статьи в статусе `draft`, `unpublished`,
  отправлять **свои** статьи на модерацию. Если редактируется и сохраняется статья со статусом `unpublished` то после 
  сохранения ее статус становится `draft` и она может быть отправлена модератору на проверку
  - `moderator` - не может создавать контент, но видит **все** статьи в статусе `under_moderation`. Может опубликовать 
  статью (перевести в статус `published`) либо отправить обратно в `draft` на доработку
  - `admin` - может все, что могут `creator` и `moderator`, но плюс может снимать статьи с публикации (устанавливать 
  статус `unpublished`). Так же `admin` может изменять роль пользоватетей, но не свою (нельзя себя разжаловать в криейторы)
  - Статьи со статусами `draft`, `under_moderation`, `unpublished` не должны быть доступны для просмотра незалогигенным
  пользователям

Для выполнения задания можно изменять код в любой части приложения (кроме папок `vendor` и `node_modules`), 
добавлять/изменять/удалять модели, контроллеры, мидлверы, роуты и тд. Миграции удалять не рекомендуется, если необходимо
внести изменения в структуру базы данных - создайте новую миграцию и изменяйте БД в ней.



