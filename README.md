## Tentang Projek

Ini adalah projek UTS mata kuliah Aplikasi Mobile Lanjutan pada Universitas Global Tangerang

### Cara Instalasi

1. Clone repositori ini

    `git clone https://github.com/AaEzha/perpustakaan-global.git`

2. Masuk ke dalam direktori projek

    `cd perpustakaan-global`

3. Instal _dependency_-nya dahulu menggunakan Composer

    `composer install`

4. Salin file .env.example menjadi .env

    `cp .env.example .env`

5. Ubah keperluan databasenya di dalam file .env tadi

    ```
    DB_DATABASE=uts
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Buat key dahulu

    `php artisan key:generate`

7. Import tabel dan data ke database

    `php artisan migrate --seed`

8. Import data buku contoh (jika perlu)

    `php artisan db:seed BookSeeder`

9. Jalankan ini untuk storage

    `php artisan storage:link`

10. Jalankan secara lokal

    `php artisan serve`

---    

#### Login sbg Mahasiswa

```
email : anggota@nurfachmi.com
password : password
```

#### Login sbg Admin

```
email : admin@nurfachmi.com
password : password
```
