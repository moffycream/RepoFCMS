<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# RepoFCMS

Follow the steps below to download the Laravel framework first. Then, using visual studio code, you can run the server on the local host

# Food and Beverage Catering Management System

This project is about creating a web-based system, Food & Beverage Catering Management System, which we will be developing for the FoodEdge Gourmet Catering company.

## Table of Contents

- [About](#about)
- [Getting Started](#getting-started)
- [Frontend Checklist](#frontend-checklist)
   - [Logo](#logo)
   - [Prefix](#prefix)
   - [HMTL Testing](#html-testing)
   - [Font Size](#font-size)
   - [Colour](#colour)
  

## About 

The system would have the following functions:
- Catering Management Module
- Food and Beverage Maintenance Module
- Customer Membership and Profile Module
- Payment Module 
- Business Analytics Module
- Traceability across modules


## Getting Started
1. Before using Laravel, you need to install PHP on your Windows.
    Please follow this video: [How to install PHP](https://www.youtube.com/watch?v=MPRLUd8Pmyo&t=203s)

2. After PHP is installed, you need to install Composer for PHP, which is a manager for PHP, we will use this tool on Visual Studio Code
    Please follow this video: [How to install Composer](https://www.youtube.com/watch?time_continue=238&v=nus8eLPNZF8&embeds_referring_euri=https%3A%2F%2Fwww.bing.com%2F&embeds_referring_origin=https%3A%2F%2Fwww.bing.com&source_ve_path=MTM5MTE3LDEzOTExNywxMzkxMTcsMTM5MTE3LDI4NjY2&feature=emb_logo)

3. Then download the PHP extension for VSC </br>
    Link: [How to install Laravel for Visual Studio Code](https://blog.devsense.com/2019/how-to-install-laravel-for-visual-studio-code#heading-4)

4. You also need to download NPM, 18.18.0 LTS
    Link: [NPM](https://nodejs.org/en)

5. Before running the website on the local host (XAMPP), please run these 2 functions in visual studio code terminal first
   composer update
   php artisan migrate

   Composer updates ensures the latest version of the composers used are installed.
   Migrate allows the databases to be created automatically using the template we have set.

6. Update the .env file (just copy and paste the section into the .env file)
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:XBu3iQCHqcJue54l9HbBg6QxzWesHMIOVRUNAiVNR4c=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fcmsdb
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=fcms20001@gmail.com
MAIL_PASSWORD=pxutcyvhxxpimxfm
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="fcms20001@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

NOCAPTCHA_SECRET=6Lco5_QoAAAAAAZ8ZWUlPvOQlHF8oVuFqCtj6ZgC
NOCAPTCHA_SITEKEY=6Lco5_QoAAAAABhnWLlNi9eyB6gqgfcNpvUh7uZF



## Frontend Checklist

### Logo 
 </br> ![image](https://github.com/moffycream/RepoFCMS/assets/106477441/17ae9c98-0995-47cd-8f2a-ea3b094df104)


### Prefix

JS prefix: Low All classes (or id- used in JavaScript files) begin with js- and are not styled into the CSS files.

```bash
<div id="js-slider" class="my-slider">
<!-- Or -->
<div id="id-used-by-cms" class="js-slider my-slider">
````

class prefix: All parent classes start with container and then begin with col and row for the grid system
```bash
<div class="container">
  <div class="row">
    <div class="col-sm">
      <!-- Let empty at first -->
    </div>
    <div class="col-sm">
      <!-- Let empty at first -->
    </div>
    <div class="col-sm">
      <!-- Let empty at first -->
    </div>
  </div>
</div>
```

### HTML Testing

W3C compliant: High All pages need to be tested with the W3C validator to identify possible issues in the HTML code. </br>
- [W3C Validator](https://validator.w3.org/)

### Font size

Can be changed
   - Normal: 18px
   - Heading 1: 32px
   - Heading 2: 28px
   - Heading 3: 24px

### Colour

   ![image](https://github.com/moffycream/RepoFCMS/assets/106477441/5c63973e-b9c0-4bd3-bdf4-92e458993c10)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
