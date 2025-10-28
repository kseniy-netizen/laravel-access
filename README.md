# Практическая работа №6 — Laravel: доступ и сессии

## Установка проекта

`bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=DemoDataSeeder
php artisan serve



Скриншоты:
1. /admin (403 под user),  ![alt text](image.png)
2. /admin (ok под admin),  ![alt text](image-1.png)
3. /posts под user (видно только «Редактировать» у своего),  ![alt text](image-2.png)
4. попытка редактировать чужой пост (403),   ![alt text](image-3.png)
5. удаление поста под admin (ok).  до ![alt text](image-4.png)   после ![alt text](image-5.png)
