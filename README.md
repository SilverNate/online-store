<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

#
#
#
# Online-Store

## Solution
1. Bad reviews yang datang dari customer penyebabnya adalah ketidakpuasan pelanggan dan merasa dirugikan karena item yang mereka inginkan pada saat flash sale harus di cancel karena ketidakmampuan system mengolah informasi tentang stock yang tersedia. Pada perspective user item tersebut available namun seminggu setelah dilakukan payment, barang tidak kunjung datang dan customer service menelpon kalau order telah di cancel. ini membuat ketidakpercayaan customer terhadap store online kita.
2. Untuk mencegah kejadian seperti ini terulang kembali, dibutuhkan pengecekan tentang stock yang tersedia setiap pembeli memasukkan item ke cart sampai ke checkout. stock akan berkurang ketika user melakukan order walaupun belum membayar. pada database item stock dibuatkan type data UNSIGNED Big Integer agar data tidak kan minus tetapi, akan membuat value = 0. dengan begitu jika stock = 0 (kosong), pelanggan tidak akan dapat memasukan barang ke cart apalagi ke checkout.
3. Demontrasi Proof of Concepts menggunakan laravel


## Requirement application
- Laravel 8
- Sqlite
- MySQL (Optional)
- Postman


## Answer Proof of Concept
### How to Implementation

- Make sure your machine already installed composer or laravel installer
- After installation run this command :
    ```bash
        cd Online-Store
    ```
- Settings .env file DB_DATABASE dengan membuat file sqlite di folder root/database dan ganti DB_CONNECTION=sqlite
    ```bash
        touch database/db.sqlite
    ```
- Jalankan Migration Command
    ```bash
        php artisan migrate
    ```
- Setelah semua perintah sudah di jalankan, saatnya running program :
    ```bash
        php artisan serve
        Starting Laravel development server: http://127.0.0.1:8000
    ```


### Documentation API
- Link to Postman API : 
- [Postman Documentation]
    (https://documenter.getpostman.com/view/8276896/UV5ZBwPH#b61b28db-651b-46c7-bd36-040b2b114659)


### Functional Testing command
- Jalankan di CLI
    ```bash
        php artisan test
    ```
### Logging ada di file
- Lokasi file logging laravel
    ```bash
        cd storage/log/laravel.blog
    ```
## 🚀 About Me
I'm a full stack developer...


# Hi, I'm Andean! 👋

## 🛠 Skills
Javascript, HTML, CSS, PHP, Python, NodeJs, Golang
