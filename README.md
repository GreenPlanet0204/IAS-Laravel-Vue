# About Laravel+Vuejs+Docker+Docker compose

This project `Laravel + Vue.JS Lifeanalytics` is based on `docker and docker-compose`

# <span style="color:#007bff"> Table of content </span>

-   [Prerequisites](#Prerequisites)
-   [Technologies](#Technologies)
-   [Setup Environment](#Setup-Environment)
-   [Contribute]

## Prerequisites

---

Make sure you have insalled the following prerequisites in your development or production machine.

-   `PHP v8.x` - [Download & install PHP](https://www.php.net/downloads.php) make sure that the PHP 8.x version has been installed on your machine.

-   `Node v14` - [Download & install Node](https://nodejs.org/download/) make sure that the Nodejs 14.15 version has been installed on your machine.

-   `Docker` - [Download & install Docker](https://docs.docker.com/get-docker/) make sure that the latest docker version has been installed on your machine.

### Technologies

---

List of technologies which are used in this project.

-   PHP : Version 8.x
-   Laravel: Version 8.x
-   MySQL: Version 7
-   Node: Version 14.15.0

### Setup Environment for Development:

-   Build `docker-compose build`.
-   Run `docker-compose up -d` for development purpose.
-   Open favourite browser and type `http://localhost`. If you wan to run on different port, you can change the `HTTP_PORT` from `.env` file.

### Setup Environment for Production:

-   Copy `.env.example` to `.env`.
-   Change the necessary staff in `.env` file.
-   Run `docker-compose -f docker-compose.production.yml up` for production.
-   Open favourite browser and type `http://localhost`. If you wan to run on different port, you can change the `HTTP_PORT` from `.env` file.

## Contribute

Contribution are alwasy welcome! Please read the [contribution guidelines](contributing.md) first.

-   Fork this project to your personal account.
-   Create your feature branch `git checkout -b feature/foo`.
-   Commit your changes `git commit -am 'Add some foo`.
-   Push to the branch `git push origin feature/foo`.
-   Create a new Pull Request.

## Azure information

The test server uses Azure.
Uploaded data url: https://la-web-site.azurewebsites.net/

-  Azure ID: daisukekubota@outlook.jp
-  Azure Pass: Kubo@1973

## test server log in Infomation

dealer and customer test log in ID and Pass

- test server url : https://la-web-site.azurewebsites.net/
- ID : daisukekubota@outlook.jp
- Pass : emjoyimaging@lifeanalytics.org

## About design

1) Make it the same design and backend function as the following wordpress website.
2) Create two Ecommerces, an agency and a customer user.
3) Create a billing function to the agency
4) Link the subscription web application with customer data.

-  Ecommerce meterial link: https://drive.google.com/file/d/1WN3JRPdzGehnQn7DCiQP0bGPJz_lC73N/view?usp=sharing
-  Website links that have the same design: https://lifeanalytics.org
-  Websites with the same design are created with wordpress. Link to that wordpress, login ID and Pass:<br>
     wordpress : https://lifeanalytics.org/wp-login.php?redirect_to=https%3A%2F%2Flifeanalytics.org%2Fwp-admin%2F&reauth=1<br>
     ID : daisukekubota@outlook.jp<br>
     Pass : emjoyimaging@lifeanalytics.org
