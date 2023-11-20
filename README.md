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


## Getting Started (For Lecturer and Tryers of the website)
1. Before using Laravel, you need to install PHP on your Windows.
    Please follow this video: [How to install PHP](https://www.youtube.com/watch?v=MPRLUd8Pmyo&t=203s)

2. After PHP is installed, you need to install Composer for PHP, which is a manager for PHP, we will use this tool on Visual Studio Code
    Please follow this video: [How to install Composer](https://www.youtube.com/watch?time_continue=238&v=nus8eLPNZF8&embeds_referring_euri=https%3A%2F%2Fwww.bing.com%2F&embeds_referring_origin=https%3A%2F%2Fwww.bing.com&source_ve_path=MTM5MTE3LDEzOTExNywxMzkxMTcsMTM5MTE3LDI4NjY2&feature=emb_logo)

3. Then download the PHP extension for VSC </br>
    Link: [How to install Laravel for Visual Studio Code](https://blog.devsense.com/2019/how-to-install-laravel-for-visual-studio-code#heading-4)

4. You also need to download NPM, 18.18.0 LTS
    Link: [NPM](https://nodejs.org/en)

5. Before running the website on the local host (XAMPP), go to phpmyadmin to create a new database, called fcmsdb
  
7. Run these 2 functions in visual studio code terminal first <br>
   composer update <br>
   php artisan migrate <br>

   Composer updates ensures the latest version of the composers used are installed.
   Migrate allows the insertion of the databases used into fcmsdb to be created automatically using the template we have set.

8. Update the .env file (just copy and paste the code provided in the notepad into the .env file)

9. Addtional notes: <br>
Default admin username: FCMS <br>
Default admin password: admin <br>
Note: to skip 2 factor authentication for this account (because it is registered with a default gmail account), you may go to the database (user_accounts) and change the value of 'isAuthenticated' to 1,    and 'firstTimeLogin' to 0.

## Development Related 
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
