git clone https://github.com/FrontMaybeBackend/recruitment-api-symf.git

then in project directory (recruitment-api-symf):
```bash
docker compose exec php bash
```

Inside the container, run the following commands:
```bash
composer install
php bin/console doctrine:migrations:migrate
```

To create an admin user for EasyAdmin, run:
```bash
php bin/console doctrine:fixtures:load
```
then exit container
```bash
exit
```


Access
API: http://localhost:8080/api

EasyAdmin: http://localhost:8080/admin
Admin login credentials:
```
email: admin@admin.com
password: admin
```
