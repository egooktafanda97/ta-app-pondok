@echo off
start "Laravel Server" cmd /k "php artisan serve"
start "Yarn Dev" cmd /k "yarn dev"
start "Node Server" cmd /k "cd node && yarn start"
