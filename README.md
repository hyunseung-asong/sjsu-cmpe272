# SJSU CMPE 272

A PHP and MariaDB web app for a (fictional) Snow Equipment
store. The site includes company pages, a product catalog, recently
viewed product tracking, user creation and search, and an admin-only user list.

## Features

- Home, about, news, bio, contacts, and company-user pages
- Product catalog generated from shared product data
- JSON product API for dynamic product-list clients
- Recently viewed products stored in a browser cookie
- User creation with server-side validation and hashed passwords
- User search by name, email, home phone, or cell phone
- Session-based login for the secure admin user list
- MariaDB-backed persistence for users

## Development

This repo includes a Nix development shell with PHP, Terraform, the MariaDB
client, and `just`.

```sh
nix develop
```

Start the local MariaDB container:

```sh
just start
```

Create the application database and tables:

```sh
mysql -h 127.0.0.1 -P 3306 -u root -prootpassword < models.sql
```

Create `src/.env` so the PHP code can connect to the database:

```ini
DB_HOST=127.0.0.1
DB_NAME=cmpe272
DB_USER=root
DB_PASS=rootpassword
```

Run the PHP development server from the repo root:

```sh
php -S 127.0.0.1:8000 -t src
```

Then open <http://127.0.0.1:8000>.

## Just Commands

| Command        | Description                         |
| -------------- | ----------------------------------- |
| `just`         | List available commands             |
| `just start`   | Start MariaDB with Docker Compose   |
| `just stop`    | Stop MariaDB                        |
| `just logs`    | Follow MariaDB logs                 |
| `just connect` | Open a MySQL shell for the database |

## Application Pages

| Path                            | Description              |
| ------------------------------- | ------------------------ |
| `/`                             | Home page                |
| `/products/products.php`        | Product catalog          |
| `/products/recently_viewed.php` | Recently viewed products |
| `/api/products`                 | JSON product catalog API |
| `/user/create.php`              | Create a user            |
| `/user/search.php`              | Search users             |
| `/secure/login.php`             | Admin login              |
| `/secure/users.php`             | Admin-only user list     |

## Database

The schema lives in `models.sql`. It creates the `cmpe272` database and a
`users` table with login, profile, email, address, and phone fields.

Admin access depends on a row in `users` with `is_admin = true`. The create-user
form creates non-admin users, so promote an account from MySQL when needed:

```sql
UPDATE users SET is_admin = true WHERE user_name = 'your_username';
```

## Deployment

The `terraform/` directory provisions a small Ubuntu 22.04 DigitalOcean droplet
and installs Apache, MySQL, PHP, and the PHP MySQL extension.

```sh
cd terraform
terraform init
terraform apply \
  -var 'do_token=...' \
  -var 'pvt_key=/path/to/private/key'
```

The Terraform config prepares the server packages. Application files, database
initialization, and production secrets still need to be copied/configured on the
host.

## Repo Structure

```txt
.
|-- docker-compose.yml # Local MariaDB service
|-- flake.nix          # Nix development environment
|-- justfile           # Common development commands
|-- models.sql         # Database schema
|-- src                # PHP application
|   |-- contacts
|   |-- products
|   |-- secure
|   `-- user
`-- terraform          # DigitalOcean droplet provisioning
```
