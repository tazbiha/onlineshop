# Ecomerce-Site

An online shopping platform built with PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. It includes product browsing, authentication, cart functionality, order tracking, and an admin dashboard.

## Run locally with Docker

From the project directory:

```sh
docker compose up --build -d
```

Open [http://localhost:8081](http://localhost:8081). The database is initialized from `swiftbuy.sql` on its first start, and its data is kept in the `swiftbuy_data` Docker volume.

Stop the containers with `docker compose down`. The Compose database passwords are development defaults; set `DB_PASSWORD` and `DB_ROOT_PASSWORD` in your environment to override them.

## Deploy to Render

GitHub Pages cannot run this PHP/MySQL app. The included `render.yaml` defines a Docker-based Render web service. Render provides managed PostgreSQL, not MySQL, so you must provide a separate MySQL-compatible database with a network endpoint accessible from Render.

1. Sign in to Render, connect your GitHub account, and create a Blueprint from this repository’s `main` branch. Render reads `render.yaml` and creates the web service.
2. Create or choose a MySQL-compatible database, then set `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASSWORD`, and `DB_NAME` on the Render service using its connection details. Keep credentials in Render environment settings, never in the repository. Database providers may charge for usage.
3. Import the starter schema and sample products once the database is ready (requires a local MySQL-compatible client):

   ```sh
   mysql --host="$DB_HOST" --port="$DB_PORT" --user="$DB_USER" --password "$DB_NAME" < swiftbuy.sql
   ```

   The client prompts for the database password. The dump contains sample products and empty user/order tables. Create an account through the app after deployment.
4. Create a public `onrender.com` domain for the web service. The container listens on Render’s assigned `PORT`.

After connecting Render to GitHub, pushes to `main` can trigger automatic deployments. GitHub Actions only checks PHP syntax; it does not host or deploy the app.
