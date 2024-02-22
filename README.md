
<p  align="center"><a  href="https://laravel.com"  target="_blank"><img  src="https://ik.polines.ac.id/wp-content/uploads/2023/11/logo-web.png"  width="360"  alt="Laravel Logo"></a></p>  

## PBL Template D3 Teknik Informatika & S.Tr. Teknologi Rekayasa Komputer

Repository ini digunakan sebagai template aplikasi dasar yang akan digunakan untuk pelaksanaan Project-Based Learning pada kedua prodi di atas di Jurusan Teknik Elektro, Politeknik Negeri Semarang.
Dengan menggunakan satu template yang sama, diharapkan proyek-proyek yang dihasilkan akan lebih mudah untuk dikelola.

PBL template ini membutuhkan <i>minimum requirements</i>:
- PHP 8.2
- Laravel 10
- MySQL 8.0

Cara menggunakan template ini adalah sebagai berikut:
- Kloning template ini menggunakan perintah:
``
git clone https://gitlab.com/sukotyasp/pbl-laravel-template.git {project-directory}
``
- Masuk ke``{project-directory}``, hapus folder tersembunyi bernama `` .git``.
- Install dependency menggunakan composer dengan perintah
``composer install``
- Salin file ``.env.example`` menjadi ``.env``
- Buat database sesuai yang anda butuhkan, kemudian sesuaikan entry berikut pada file ``.env``:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```
- Jalankan perintah berikut:
```
php artisan migrate
php artisan db:seed
```
- Jalankan aplikasi menggunakan perintah
```
php artisan serve
```
<hr>

Terima Kasih kepada:
- Kaprodi D3 Teknik Informatika
- Kaprodi S.Tr. Teknologi Rekayasa Komputer
- Ketua Jurusan Teknik Elektro, Politeknik Negeri Semarang
- Task Force PBL D3 Teknik Informatika & S.Tr. Teknologi Rekayasa Komputer
<hr>
credit: https://github.com/mjumain/RBAC-LARAVEL-9
<p align="center">
<a  href="https://laravel.com"  target="_blank"><img  src="https://ik.polines.ac.id/wp-content/uploads/2024/02/laravel-logo.jpg"  width="400"  alt="Laravel Logo"></a>
</p>

# tes commit