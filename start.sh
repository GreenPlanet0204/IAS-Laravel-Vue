echo :::::::::::::::: Project Pull :::::::::::::::::
git pull

echo :::::::::::::: Starting Frontend ::::::::::::::
npm install
npm run build

echo :::::::::::::: Starting Backend :::::::::::::::
docker compose build
docker compose up -d
docker compose run app composer install
docker compose run app cp .env.example .env
docker compose run app php artisan key:generate
docker compose run app php artisan migrate
docker compose run app php artisan db:seed
docker compose run app php artisan jwt:secret

echo :::::::::::::: Started server at http://localhost:8008 :::::::::::::::
