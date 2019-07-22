#Setup for this poor project :)
1. Change permissions for `/var/www/symfony/public/uploads/` or create uploads folder with 777 permissions.
2. Create `.env` file `cp .env-dist .env`
3. run `./start-dev.sh` to build and run docker containers. (docker-compose needed `sudo apt-get install docker-compose`)
4. If built successfully you will be inside `php` container's bash.
5. run `composer install`
6. `yarn install`
7. build assets `yarn run encore dev`
8. Create db schema `sf doctrine:schema:update --force`
9. Seed db `sf doctrine:fixtures:load -n`
10. Should be good to go `127.0.0.1:8080`
11. Login with seeded user -> username: `admin`, password: `pass`
