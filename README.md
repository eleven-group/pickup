# Pickup project

### Copyright Eleven Group

## Installation :

- Edit environment PROJECT_NAME variables in ./.env && ./Makefile
- If this is your first time on this project you can run the following command :

```make first-init```

- It will copy `.env.dist` into working `.env` and install the project services at the same time.

## Commands :

All these commands preceded by ```make``` will execute the following actions :

- `up` : start all the services
- `down` : stop all the services
- `run` : run all the services
- `php-dev` : create dev env with fixture
- `sh-php` : get inside the php container
- `sh-front` : get inside the front container
- `sh-admin` : get inside the admin container
- `first-init` : init the freshly cloned project
- `copy-env` : copy `.env.dist` into `.env`
- `install` : install every services
- `install-php` : install the php service
- `install-admin` : install the admin service
- `install-front` : install the front service

## Authentification :


If this is the first time you use this project & you want to be able to auth on the api, you need to generate a RSA key to generate JWT tokens.

You need to run these 3 commands :

```sh
docker exec -ti pickup-php sh
cd /home/pickup/api
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

**You need to write your passphrase in api/.env.local**

## Architecture :

We split the architecture of the project in 3 parts :

- The API, provide the data (SF4, api-platform)
- The front, this is the frontoffice of the project, the user will pick products on it (vuejs)
- The admin, this is the backoffice for the adminstrator and the manager, they have access to everything (react, react-admin)

## Links of the apps in dev :

|      Service      | HTTP URL               | HTTPS URL               |
| :---------------: | ---------------------- | ----------------------- |
| Traefik Dashboard | http://localhost:8080  | None                    |
|     Front-end     | http://front.localhost | https://front.localhost |
|        API        | http://api.localhost   | https://api.localhost   |
|  Admin dashboard  | http://admin.localhost | https://admin.localhost |

## Troubleshooting :

If you any issue regarding an unreadle pem key , try to run
```chmod -R 777 config/jwt/``` inside the api container
