# AgroForward — корпоративный сайт мясного поставщика

Полнофункциональный корпоративный сайт компании «Агрофорвард» — федерального поставщика мясосырья. Включает клиентскую часть с анимациями и адаптивной вёрсткой, серверную часть с REST API для контактной формы, и полную Docker-инфраструктуру.

## Технологии

### Frontend
- **Vue 3** + **TypeScript** (Composition API, strict mode)
- **Vite** — сборщик
- **Vue Router** — маршрутизация с lazy-loading страниц
- **Pinia** — стейт-менеджер
- **Axios** — HTTP-клиент
- Кастомные CSS-анимации (scroll-reveal, page transitions, glass-morphism)

### Backend
- **Laravel 13** + **PHP 8.4**
- **PostgreSQL 16** — основная база данных
- **Redis 7** — очередь задач (email)
- REST API с валидацией, rate limiting, CORS

### Инфраструктура
- **Docker Compose** — 6 сервисов (nginx, php, postgres, redis, queue worker, frontend)
- Готов к деплою на **Render** (Dockerfile для production)

## Структура проекта

```
AgroForward/
├── frontend/          # Vue 3 SPA
│   ├── src/
│   │   ├── pages/     # 4 страницы (Home, About, Investors, Contacts)
│   │   ├── api/       # Axios-клиент и API-модули
│   │   └── assets/    # CSS, шрифты
│   └── ...
├── backend/           # Laravel REST API
│   ├── app/
│   │   ├── Http/      # Контроллеры, Form Requests
│   │   ├── Mail/      # Mailable-классы
│   │   └── Models/    # Eloquent-модели
│   ├── routes/api.php # API-маршруты
│   └── Dockerfile     # Production-образ
├── docker/            # Конфиги Docker (nginx, php)
└── docker-compose.yml # Локальный стек разработки
```

## Страницы

| Страница | URL | Описание |
|----------|-----|----------|
| Главная | `/` | Hero-секция, преимущества, KPI-счётчики |
| О компании | `/about` | 6 вкладок: история, миссия, команда, сертификаты, география, партнёры |
| Инвесторам | `/investors` | 7 вкладок: финансы, отчёты, стратегия, корпоративное управление |
| Контакты | `/contacts` | 4 вкладки: информация, реквизиты, форма обратной связи, карта |

## API-эндпоинты

| Метод | URL | Описание |
|-------|-----|----------|
| GET | `/api/health` | Health check |
| POST | `/api/contact` | Отправка контактной формы (rate limit: 5/мин) |
| GET | `/api/contact-messages` | Список сообщений (пагинация) |
| GET | `/api/contact-messages/{id}` | Просмотр сообщения |
| DELETE | `/api/contact-messages/{id}` | Удаление сообщения |

## Быстрый старт

### Требования
- Docker и Docker Compose

### Запуск

```bash
# Клонировать репозиторий
git clone https://github.com/<username>/AgroForward.git
cd AgroForward

# Скопировать переменные окружения
cp backend/.env.example backend/.env

# Поднять все сервисы
docker compose up -d

# Первичная настройка (внутри контейнера)
docker compose exec php composer install
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate
```

### Доступ

| Сервис | URL |
|--------|-----|
| Фронтенд | http://localhost:5174 |
| API | http://localhost:8080/api |
| Health check | http://localhost:8080/api/health |

## Особенности

- **Scroll-анимации** — элементы появляются при прокрутке (IntersectionObserver + CSS transitions)
- **Адаптивный дизайн** — брейкпоинты 1000px, 768px, 480px; бургер-меню на мобильных
- **Glass-morphism** стиль интерфейса
- **Валидация форм** — серверная с русскоязычными сообщениями об ошибках
- **Email-уведомления** — через очередь Redis (или синхронно)
- **Rate limiting** — защита от спама на контактной форме
