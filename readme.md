## About Crawler Products

The purpose of this web app is apply web scrpaing to a determinated url given inside.
This url is https://www.appliancesdelivered.ie/search?sort=price_desc

The functionality of this crawler is get 4 arrays with the information of th url: images src, title, option and prices. This data is shown in the default page like a list that have the 10 products most expensive and below the 10 products most cheapest of the url.

In this package is used Cache vars and can be configurated its time in `ProductController` file
(60*24) = One day is the time established for default

## Wish List

In this section is shown the list of the products added for the logged user and he has the possibility of keep adding all the products if he wants, besides he can delete this products from the list if he wishes.

## Profile

The user of this WebApp can register an account to get in and he can do login. Besides he can too update his profile: name and email data.

## How to install

Download this repository as a zip, and unpack. 
Copy the files to a web server that can run Laravel 5.3 or greater. This are the server requirements: [Laravel Server Requirements](https://laravel.com/docs/5.3#server-requirements)
Open the terminal inside of this repo and run the command `composer install`
After type the command `php artisan key:generate` for generate one key to the app
Establish the values for the database in the `.env` file

## Running migrations

In this package were used 3 tables for the database
Run the migration with the command: `php artisan migrate` executed by the terminal in the root of the application

## Additional information

The icons used were taken from Font Awesome [Font Awesome](http://fontawesome.io/)
In this package were used CSS inline styles instead of CSS Files for not overload it, besides is not considered important for the purpose of its realization.
