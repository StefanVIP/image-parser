# Image parser app + 🐳 Docker + PHP 8.2 + Nginx

## Description

This app parses the URL entered into the form and shows all the images collected from the page, their total number and total size.

Based on the complete stack for running Symfony 6.2 into Docker containers using docker-compose tool.

It is composed by 2 containers:
- `nginx`, acting as the webserver.
- `php`, the PHP-FPM container with the 8.2 version of PHP.

## Installation

1. 😀 Clone this repo.

2. If you are working with Docker Desktop for Mac, ensure **you have enabled `VirtioFS` for your sharing implementation**. `VirtioFS` brings improved I/O performance for operations on bind mounts. Enabling VirtioFS will automatically enable Virtualization framework.

3. Go inside folder `./docker` and run `docker compose up -d` to start containers.

4. Inside the `php` container, run `composer install` to install dependencies from `/var/www/symfony` folder.

5. Open in browser http://localhost:80

## How to use app

Just enter in form field any link on any page and click "Parse URL".