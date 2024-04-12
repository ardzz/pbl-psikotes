<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About MMPI-2 PSYCHOLOGICAL TEST
This is a simple web application that allows users to take the MMPI-2 psychological test and get their results. The MMPI-2 is a psychological test that assesses personality traits and psychopathology. The test consists of 567 true/false questions and takes about 60-90 minutes to complete. The test is scored based on the user's responses and provides information about the user's personality traits, emotional functioning, and psychopathology.

## Installation
1. Clone the repository
```bash
git clone -b laravel-11 https://github.com/ardzz/pbl-psikotes
```
2. Install dependencies
```bash
composer install
```
3. Create a copy of your .env file
```bash
cp .reky.env .env
```

4. Run queue worker
```bash
php artisan queue:work
```

5. Serve the application
```bash
php artisan serve
```
