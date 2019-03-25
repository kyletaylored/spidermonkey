# Spidermonkey

## A Hubspot API crawler.

For now, it just scrapes the Page API for Hubspot.

### Installation

Install packages with composer.

```php
composer install
```

Add your Hubspot API key to .env

```bash
cp .env.example .env
```

### Usage

Currently, can run from CLI, passing in an optional value as an offset.

```bash
php index.php [number or null]
```
