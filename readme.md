[![Latest Stable Version](https://poser.pugx.org/tklovett/barcodes/v/stable.svg)](https://packagist.org/packages/tklovett/barcodes)
[![Total Downloads](https://poser.pugx.org/tklovett/barcodes/downloads.svg)](https://packagist.org/packages/tklovett/barcodes)
[![Build Status](https://travis-ci.org/tklovett/barcodes.svg)](https://travis-ci.org/tklovett/barcodes)
[![Coverage Status](https://coveralls.io/repos/tklovett/barcodes/badge.svg)](https://coveralls.io/r/tklovett/barcodes)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tklovett/barcodes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tklovett/barcodes/?branch=master)

[Read More Wiki](https://github.com/tklovett/barcodes/wiki)

Barcodes
========

*Generating barcodes in PHP since 2015!*

Generates HTML, PNG, or SVG canvas

## Supported Barcode Types

### One Dimensional
- Codabar
- Code 11
- Code 39 (also extended and/or with check-digit) 
- Code 93
- Code 128 (A, B, C, or Auto)
- EAN (2, 5, 13)
- Intelligent Mail
- Interleave 2 of 5
- MSI (also  with check-digit)
- Pharmacode
- POSTNET (or PLANET)
- RMS4CC (or KIX)
- Standard 2 of 5 (also with check-digit)
- UPC (A, E)

### Two Dimensional
- DataMatrix
- PDF417
- QR Code

## Requirements

- Barcodes requires ImageMagick to create PNGs in PHP 5.3.
- Barcodes requires PHP bcmath extension for Intelligent Mail barcodes

## Installation

You can install this package with the Composer CLI:

    composer require tklovett/barcodes

Or manually add the dependency to your project's `composer.json`:

    "require": {
        "tklovett/barcodes": "dev-master"
    }

And tell composer to install it:

    composer install

## Usage

First instantiate a BarcodeGenerator factory:

```php
$generator = new BarcodeGenerator();
```
    
Then tell it to generate the barcode type of your choice for your code:

```php
$barcode = generator.generate(BarcodeType::QR_CODE, "This is what I want encoded");
```
    
Finally, output SVG, HTML, or a PNG:

```php
$svg  = $barcode.toSVG();
$html = $barcode.toHTML();
$png  = $barcode.toPNG();
```

Need a custom height, width, or color for your barcode? No problem:

```php
$width = 20;
$height = 30;
$color = 'blue';
$sizedSVG  = $barcode.toSVG($width, $height, $color);
$sizedHTML = $barcode.toSVG($width, $height, $color);
$sizedPNG  = $barcode.toSVG($width, $height, $color);
```



## TODO:

- Convert snake_case method names to camelCase
- Replace returns from barcode constructors with exception throws
- Write tests
- Write docs
- parent::__construct($code); in all barcodes
- remove unused methods