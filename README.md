# Ecomerce-Site

An online shopping platform built with PHP, MySQL, HTML, CSS, JavaScript, and
Bootstrap. It includes product browsing, authentication, cart functionality,
order tracking, and an admin dashboard.

## Run locally with Docker

From the project directory:

```sh
docker compose up --build -d
```

Open [http://localhost:8081](http://localhost:8081). The database is initialized
from `swiftbuy.sql` on its first start, and its data is kept in the
`swiftbuy_data` Docker volume.

Stop the containers with:

```sh
docker compose down
```

The Compose database passwords are development defaults. Set `DB_PASSWORD` and
`DB_ROOT_PASSWORD` in your environment before starting the stack to override
them.

## Deploy to Railway

GitHub Pages only serves static files and cannot run this PHP/MySQL app. To
deploy it on Railway:

1. Push this repository to GitHub and create a Railway project from that
   repository, using the `main` branch. Railway will detect the root
   `Dockerfile`; enable automatic deployments for pushes to `main`.
2. Add a Railway **MySQL** service to the same project.
3. In the PHP service's variables, add these references to the MySQL service
   (name the database service `MySQL`, or change the reference prefix to match
   its service name):

   ```text
   DB_HOST=${{MySQL.MYSQLHOST}}
   DB_USER=${{MySQL.MYSQLUSER}}
   DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
   DB_NAME=${{MySQL.MYSQLDATABASE}}
   ```

   These are Railway variable references, not literal credentials. Do not
   commit database passwords to the repository.
4. Import the starter schema and sample data once, after the database is ready:

   ```sh
   railway link
   railway connect MySQL < swiftbuy.sql
   ```

   This requires the Railway CLI and a local MySQL-compatible command-line
   client. Choose the linked Railway project and environment when prompted.
   The dump includes sample product data but no user accounts, orders, or
   personal information. Create an account through the app after deployment.
5. In the PHP service's Railway settings, enable a public domain. The container
   listens on Railway's assigned `PORT`.

The GitHub Actions workflow checks PHP syntax. It does not deploy the site;
Railway deploys new commits after its GitHub integration is connected.
