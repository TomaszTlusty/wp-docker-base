# WP Docker Template

Lokalny stack WordPress: Nginx + PHP-FPM + MySQL

## Wymagania
- Docker
- Docker Compose

## Uruchomienie

1. Skopiuj plik ze zmiennymi środowiskowymi:
cp .env.example .env

2. Uzupełnij hasła i prefix w `.env`

3. Uruchom:
docker compose up -d

4. Otwórz http://localhost:8080

## Zatrzymanie
docker compose down

## Zatrzymanie + usunięcie bazy
docker compose down -v
