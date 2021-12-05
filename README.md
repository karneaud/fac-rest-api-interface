# First Atlantic Commerce API Web Service

A JSON webservice interface for some of FAC's XML services endpoint.

### Overview 
Built from **[Strong Lumen](https://github.com/UnicornGlobal/strong-lumen)**, but with a bunch of security focused features 💪 

#### Version

- Framework build v7.x
- API build version 1.0.0

### Built with

- [Laravel Framework Lumen (7.2.2) (Laravel Components ^7.0)](https://lumen.laravel.com)
- [Lumen Module management](https://github.com/mbf5923/lumen-modules)
- [Omnipay Common Library](https://github.com/thephpleague/omnipay-common)
- [First Atlantic Commerce driver for the Omnipay PHP](https://github.com/karneaud/omnipay-first-atlantic-commerce)
- [Guzzle is a PHP HTTP client library](https://github.com/guzzle/guzzle)

## Installation
### Prerequisites
- Composer
- PHP >= 7.3
-- ext-date
-- ext-dom
-- ext-fileinfo
-- ext-filter 
-- ext-hash
-- ext-json
-- ext-libxml
-- ext-mbstring 
-- ext-openssl
-- ext-pcre
-- ext-pdo
-- ext-phar
-- ext-simplexml
-- ext-spl
-- ext-tokenizer
-- ext-xml
-- ext-xmlwriter
-- lib-pcre
- MySQL >= 5

### Setup/ Configuration

Create an **.env** file and ensure the required variables ar set as per requirements for [lumen/ laravel](https://lumen.laravel.com/docs/8.x/configuration#environment-configuration). Other required ariables include:-
- APP_ID (alpha numeric unique identifier)
- APP_NAME (name of the application)
- APP_VERSION ( version number of application )
- API_URL (url of application)
- SYSTEM_USER_ID (numberic unique identifier)
- SYSTEM_USER_EMAIL (email address of system)
- ADMIN_USER_ID (numberic unique identifier)
- FAC_MERCHANT_ID (merchant id as issued by FAC)
- FAC_MERCHANT_PASSWD (merchant password as issued by FAC)
- FAC_TEST_MODE (indicates if the application processing mode uses FAC's test environment or not)

### Instructions

1. Upload/ Extract contents to folder and run `composer install` (if vendor folder not present)
2. Run `artisan migrate install`
3. Run `artisan module install` to install FAC module
4. Run `artisan user:register` to register a user and get api credentials

## Usage

- All endpoints reside at /fac/api/*v#/endpoint* where *#* is the current api version number.
- All requests require a SHA256 hash signature header to verify request. 
- See API Docs for more on available methods and usage on making requests.

