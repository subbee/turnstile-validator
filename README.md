# Subbee Turnstile Validator

[![Tests](https://github.com/subbee/turnstile-validator/actions/workflows/tests.yml/badge.svg)](https://github.com/subbee/turnstile-validator/actions)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/subbee/turnstile-validator.svg?style=flat-square)](https://packagist.org/packages/subbee/turnstile-validator)
[![License](https://img.shields.io/packagist/l/subbee/turnstile-validator.svg?style=flat-square)](https://packagist.org/packages/subbee/turnstile-validator)

A simple and flexible Laravel package to integrate [Cloudflare Turnstile](https://www.cloudflare.com/products/turnstile/) CAPTCHA validation into your applications.

---

##  Features

- Easy Turnstile integration
- Validation rule for forms
- Blade directive for widget embedding
- Configurable via `.env`
- Laravel 5.x, 6.x, 7.x, 8.x, 9.x, 10.x compatible

---

##  Installation

```bash
composer require subbee/turnstile-validator
```

Publish configuration (optional):

```bash
php artisan vendor:publish --tag=config --provider="TurnstileValidator\TurnstileServiceProvider"
```

Add .env variables

```php
TURNSTILE_SITEKEY=your-sitekey-here
TURNSTILE_SECRET=your-secret-key-here
```

## Getting Cloudflare Turnstile keys
1.	Go to Cloudflare Turnstile Dashboard.
2.	Log in or create an account.
3.	Navigate to Access > Turnstile.
4.	Click “Add Site”, set the domain and widget mode.
5.	Copy your Site Key and Secret Key into .env.

## Usage

### Validation
```php
$request->validate([
'cf-turnstile-response' => 'required|turnstile',
]);
```

### Blade directive
```php
<form method="POST" action="/submit">
    @csrf
    @turnstile
    <button type="submit">Submit</button>
</form>
```
