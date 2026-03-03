# 📚 Panduan Instalasi — Web SMK
### Debian / Ubuntu Server

---

## Kebutuhan Sistem

| Komponen | Versi Minimum |
|----------|--------------|
| OS | Debian 11+ / Ubuntu 20.04+ |
| PHP | 8.2 |
| MySQL | 8.0 |
| Node.js | 18+ |
| Composer | 2.x |
| Git | 2.x |

---

## 1. Update Sistem

```bash
sudo apt update && sudo apt upgrade -y
```

---

## 2. Install PHP 8.2 + Ekstensi

```bash
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php   # Ubuntu
# Untuk Debian, gunakan:
# sudo curl -sSL https://packages.sury.org/php/README.txt | sudo bash -s

sudo apt update
sudo apt install -y php8.2 php8.2-cli php8.2-fpm php8.2-mysql \
    php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-curl \
    php8.2-zip php8.2-gd php8.2-tokenizer php8.2-fileinfo

php -v   # verifikasi
```

---

## 3. Install MySQL 8

```bash
sudo apt install -y mysql-server
sudo systemctl start mysql
sudo systemctl enable mysql

# Amankan instalasi
sudo mysql_secure_installation
```

### Buat Database

```bash
sudo mysql -u root -p
```

```sql
CREATE DATABASE websmk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'websmk_user'@'localhost' IDENTIFIED BY 'password_kuat_anda';
GRANT ALL PRIVILEGES ON websmk.* TO 'websmk_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## 4. Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version   # verifikasi
```

---

## 5. Install Node.js 18+

```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
node -v && npm -v   # verifikasi
```

---

## 6. Install Git & Clone Repository

```bash
sudo apt install -y git

# Clone ke direktori web
cd /var/www
sudo git clone https://github.com/kangdaqiq/websmk.git
cd websmk
```

---

## 7. Set Permission

```bash
sudo chown -R www-data:www-data /var/www/websmk
sudo chmod -R 755 /var/www/websmk
sudo chmod -R 775 /var/www/websmk/storage
sudo chmod -R 775 /var/www/websmk/bootstrap/cache
```

---

## 8. Konfigurasi Environment

```bash
cp .env.example .env
nano .env
```

Edit bagian berikut di file `.env`:

```env
APP_NAME="Web SMK"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://domain-anda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=websmk
DB_USERNAME=websmk_user
DB_PASSWORD=password_kuat_anda
```

---

## 9. Install Dependensi & Build

```bash
# Install dependensi PHP
composer install --optimize-autoloader --no-dev

# Generate app key
php artisan key:generate

# Install dependensi Node.js & build aset
npm install
npm run build

# Jalankan migrasi database
php artisan migrate --force

# (Opsional) Jalankan seeder data awal
php artisan db:seed

# Optimasi Laravel untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

---

## 10. Konfigurasi Web Server

Pilih salah satu: **Apache** atau **Nginx**.

---

### ✅ Option A — Apache (Direkomendasikan jika sudah pakai Apache)

```bash
sudo apt install -y apache2 libapache2-mod-php8.2

# Aktifkan modul yang dibutuhkan
sudo a2enmod rewrite headers php8.2
sudo systemctl restart apache2
```

Buat file virtual host:

```bash
sudo nano /etc/apache2/sites-available/websmk.conf
```

Isi konfigurasi berikut:

```apache
<VirtualHost *:80>
    ServerName domain-anda.com
    ServerAlias www.domain-anda.com
    DocumentRoot /var/www/html/website/public

    <Directory /var/www/html/website/public>
        AllowOverride All
        Options -Indexes +FollowSymLinks
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/websmk_error.log
    CustomLog ${APACHE_LOG_DIR}/websmk_access.log combined
</VirtualHost>
```

```bash
# Aktifkan site & nonaktifkan default
sudo a2ensite websmk.conf
sudo a2dissite 000-default.conf

# Tes konfigurasi
sudo apache2ctl configtest

# Restart Apache
sudo systemctl restart apache2
```

> **Penting:** Pastikan file `.htaccess` di folder `public/` ada dan dapat dibaca. Laravel sudah menyertakannya secara default.

---

### Option B — Nginx

```bash
sudo apt install -y nginx php8.2-fpm
sudo systemctl enable php8.2-fpm
sudo nano /etc/nginx/sites-available/websmk
```

Isi konfigurasi berikut:

```nginx
server {
    listen 80;
    server_name domain-anda.com www.domain-anda.com;
    root /var/www/html/website/public;
    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    client_max_body_size 20M;
}
```

```bash
# Aktifkan site
sudo ln -s /etc/nginx/sites-available/websmk /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm
```

---

## 11. (Opsional) SSL dengan Let's Encrypt

Untuk **Apache**:
```bash
sudo apt install -y certbot python3-certbot-apache
sudo certbot --apache -d domain-anda.com -d www.domain-anda.com
```

Untuk **Nginx**:
```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d domain-anda.com -d www.domain-anda.com
```

---

## 12. Verifikasi

Buka browser dan akses `http://domain-anda.com`. Jika berhasil, halaman utama web SMK akan muncul.

---

## Perintah Berguna

| Perintah | Fungsi |
|----------|--------|
| `php artisan migrate:fresh --seed` | Reset & isi ulang database |
| `php artisan config:clear` | Hapus cache konfigurasi |
| `php artisan cache:clear` | Hapus cache aplikasi |
| `php artisan queue:work` | Jalankan queue worker |
| `php artisan storage:link` | Buat symlink storage |

---

## Troubleshooting

### Permission denied pada storage
```bash
sudo chmod -R 775 /var/www/websmk/storage /var/www/websmk/bootstrap/cache
sudo chown -R www-data:www-data /var/www/websmk
```

### Error 500 di browser
```bash
# Cek log error Laravel
tail -f /var/www/websmk/storage/logs/laravel.log

# Pastikan APP_DEBUG=false di production
# atau sementara set ke true untuk debug
```

### Gambar/file tidak muncul
```bash
php artisan storage:link
```

---

> **Catatan:** Ganti `domain-anda.com`, `websmk_user`, dan `password_kuat_anda` dengan nilai yang sesuai untuk server Anda.
