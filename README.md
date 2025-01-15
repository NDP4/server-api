# 🚀 Docker API Server Boilerplate

Boilerplate untuk membangun REST API server menggunakan Docker yang mendukung arsitektur AMD64 dan ARM64. Project ini menyediakan konfigurasi Docker yang optimal untuk production environment.

## 🎯 Tujuan Utama

Project ini difokuskan pada:

- Konfigurasi Docker yang optimal untuk production
- Mendukung multi-arsitektur (AMD64 dan ARM64)
- Sistem yang modular dan mudah dikustomisasi
- Performa dan keamanan yang optimal

## 🛠 Tech Stack

- **Docker & Docker Compose** - Kontainerisasi
- **PHP 8.0** - Runtime environment
- **MySQL 8.0** - Database server
- **Nginx** - Web server
- **Adminer** - Tool manajemen database

## ⚡ Keunggulan

- Support multi-architecture (AMD64/ARM64)
- Optimasi performa untuk production
- Konfigurasi keamanan yang teroptimasi
- Auto-restart untuk high availability
- Mudah dikustomisasi

## 📁 Struktur Project

```plaintext
api_server/
├── api/                    # Folder untuk file PHP (dapat disesuaikan)
├── docker/
│   ├── mysql/
│   │   ├── init.sql      # Template inisialisasi database
│   │   └── my.cnf        # Konfigurasi MySQL
│   ├── Dockerfile        # Build PHP image
│   └── php.ini           # Konfigurasi PHP
├── nginx/
│   └── default.conf      # Konfigurasi Nginx
└── docker-compose.yml    # Orchestrasi container
```

## 🚀 Cara Penggunaan

1. **Clone repository:**

   ```bash
   git clone <url-repo-anda>
   cd api_server
   ```

2. **Kustomisasi konfigurasi:**

   - Sesuaikan `docker-compose.yml` dengan kebutuhan
   - Atur kredensial database
   - Sesuaikan konfigurasi PHP dan Nginx

3. **Build dan jalankan:**
   ```bash
   docker-compose up -d --build
   ```

## ⚙️ Environment

### Production Ready

- Optimasi untuk production environment
- Health check untuk setiap service
- Logging yang terstruktur
- Backup strategy

### Development

- Hot-reload untuk development
- Debug tools tersedia
- Environment yang terisolasi

## 📋 Contoh API Endpoint

Project ini menyertakan beberapa contoh endpoint sebagai referensi implementasi:

- `get_posts.php`
- `post_posts.php`
- `put_posts.php`

> **Catatan Penting**: Endpoint di atas hanya sebagai contoh implementasi.
> Anda dapat menggantinya sesuai kebutuhan project Anda.
> Fokus utama project ini adalah konfigurasi Docker yang optimal untuk production.

## 🔧 Kustomisasi

### Yang Dapat Disesuaikan

- Struktur API dan endpoint
- Skema database
- Konfigurasi server
- Environment variables
- Port dan networking
- Volume mounting

## 📦 Kebutuhan Sistem

- Docker Engine 20.10+
- Docker Compose 2.0+
- Minimal RAM: 2GB
- Mendukung arsitektur:
  - AMD64
  - ARM64

## 🛡️ Security Features

- Rate limiting
- Secure headers
- SQL injection protection
- XSS protection
- CORS policy

## 🔍 Monitoring

- Docker health checks
- Resource monitoring
- Error logging
- Performance metrics

## 🔌 Akses Layanan

Setelah menjalankan docker-compose, layanan dapat diakses melalui:

### API Endpoints
- URL: `http://localhost:1111`
- Contoh endpoint:
  - GET: `http://localhost:1111/get_posts.php`
  - POST: `http://localhost:1111/post_posts.php`
  - PUT: `http://localhost:1111/put_posts.php`

### Database Management (Adminer)
- URL: `http://localhost:1112`
- Kredensial default:
  - Server: `db`
  - Username: `your-username`
  - Password: `your-password`
  - Database: `your-database`

> **Penting**: Ganti kredensial default dengan kredensial Anda sendiri di file:
> - `docker-compose.yml` (environment variables)
> - `api/koneksi.php` (database connection)
> - `docker/mysql/init.sql` (database initialization)

### MySQL
- Host: `localhost`
- Port: `3307`
- Koneksi eksternal: `localhost:3307`

### Docker Ports
- API Server (Nginx): `1111`
- Adminer: `1112`
- MySQL: `3307`

## 🚫 File yang Diabaikan Git

Beberapa file dan folder yang tidak disertakan dalam repository:
- `mysql_data/` (Volume Docker)
- File environment (*.env)
- File sistem dan IDE
- File log
- File temporary

> **Penting**: Pastikan untuk menyalin dan menyesuaikan kredensial database sesuai kebutuhan Anda.

## 📝 Lisensi

Project ini dilisensikan di bawah Lisensi MIT

## 🤝 Kontribusi

Kontribusi sangat dipersilakan, terutama untuk:

- Optimasi Docker
- Peningkatan keamanan
- Dokumentasi
- Bug fixes
