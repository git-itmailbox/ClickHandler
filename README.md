# ClickHandler
Tracker of links (test task)

1. Clone project
2. Open terminal, go to directory PROJECT/docker and  run `docker-compose up`, it will start and all logs will show in current terminal. Server will start on `localhost:8000`
3. Open one more terminal and go to same directory (PROJECT/docker). Run `docker-compose exec app_ch composer install`
4. Copy `.env.example` as `.env`
5. Run migration in terminal from  PROJECT/docker - run: `docker-composer exec app_ch php artisan migrate`
