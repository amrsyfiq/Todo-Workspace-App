<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requirement
1.    PHP 8
2.    PHP Extension (pdo_mysql, exif, bcmath, gd, zip, pcntl)
3.    Mysql 8 / MariaDB 10.5

## Setup
1.    git clone https://github.com/amrsyfiq/Todo-Workspace-App.git 
2.    change to Todo-Workspace-App folder: cd Todo-Workspace-App 
3.    run composer install 
4.    Duplicate .env.example file. Rename duplicated file to .env
5.    run php artisan key:generate 
6.    open http://127.0.0.1:8000/ in the browser

## Setup If Using Docker
1.    git clone https://github.com/amrsyfiq/Todo-Workspace-App.git
2.    change to Todo-Workspace-App folder: cd Todo-Workspace-App 
3.    run docker-compose up -d 
4.    run docker exec -it Todo-Workspace-App-php sh to enter into container
5.    run composer install 
6.    Duplicate .env.example file. Rename duplicated file to .env
7.    run php artisan key:generate 
8.    open http://127.0.0.1:8000/ in the browser
