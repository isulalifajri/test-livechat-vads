## About Project

Project ini saya buat menggunakan laravel versi 10, PHP 8.2.12 dan database nya menggunakan database MySQL

sesuaikan port di .env

jalankan: `php artisan migrate` lalu klik `yes` jika database nya masih belum dibuat

untuk table user(service desk) ini menggunakan seeder.

jadi tinggal jalankan perintah ini: `php artisan migrate:fresh --seed` untuk mengisi otomatis tabel tsb.

utk menjalankan project : `php artisan serve`

username dan password untuk login:

```
*agenbot1
username : agenbot1
pwd : 123456

*agenbot2
username : agenbot2
pwd : 123456