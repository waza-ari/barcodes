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

- QR code
- PDF417
- C39, C93, C11
- S25
- I25
- C128, C128A, C128B, C128C
- EAN-2, EAN-5, EAN-13
- UPC-A, UPC-E
- MSI
- POSTNET, PLANET, IMB
- RMS4CC, KIX
- Codabar
- Pharmacode


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

    echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T");
    echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");
    echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';
    echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T");
    echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';



    echo DNS1D::getBarcodeSVG("4445645656", "C39");
    echo DNS2D::getBarcodeHTML("4445645656", "QRCODE");
    echo DNS2D::getBarcodePNGPath("4445645656", "PDF417");
    echo DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX");
    echo '<img src="data:image/png,' . DNS2D::getBarcodePNG("4", "PDF417") . '" alt="barcode"   />';


## Width and Height example

    echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33);
    echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33);
    echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33) . '" alt="barcode"   />';
    echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33);
    echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+",3,33) . '" alt="barcode"   />';
    
    
## Color


    echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33,"green");
    echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33,"green");
    echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1)) . '" alt="barcode"   />';
    echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33,array(255,255,0));
    echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1)) . '" alt="barcode"   />';


## 2D Barcodes

    echo DNS2D::getBarcodeHTML("4445645656", "QRCODE");
    echo DNS2D::getBarcodePNGPath("4445645656", "PDF417");
    echo DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX");     

## 1D Barcodes

    echo DNS1D::getBarcodeHTML("4445645656", "C39");
    echo DNS1D::getBarcodeHTML("4445645656", "C39+");
    echo DNS1D::getBarcodeHTML("4445645656", "C39E");
    echo DNS1D::getBarcodeHTML("4445645656", "C39E+");
    echo DNS1D::getBarcodeHTML("4445645656", "C93");
    echo DNS1D::getBarcodeHTML("4445645656", "S25");
    echo DNS1D::getBarcodeHTML("4445645656", "S25+");
    echo DNS1D::getBarcodeHTML("4445645656", "I25");
    echo DNS1D::getBarcodeHTML("4445645656", "I25+");
    echo DNS1D::getBarcodeHTML("4445645656", "C128");
    echo DNS1D::getBarcodeHTML("4445645656", "C128A");
    echo DNS1D::getBarcodeHTML("4445645656", "C128B");
    echo DNS1D::getBarcodeHTML("4445645656", "C128C");
    echo DNS1D::getBarcodeHTML("44455656", "EAN2");
    echo DNS1D::getBarcodeHTML("4445656", "EAN5");
    echo DNS1D::getBarcodeHTML("4445", "EAN8");
    echo DNS1D::getBarcodeHTML("4445", "EAN13");
    echo DNS1D::getBarcodeHTML("4445645656", "UPCA");
    echo DNS1D::getBarcodeHTML("4445645656", "UPCE");
    echo DNS1D::getBarcodeHTML("4445645656", "MSI");
    echo DNS1D::getBarcodeHTML("4445645656", "MSI+");
    echo DNS1D::getBarcodeHTML("4445645656", "POSTNET");
    echo DNS1D::getBarcodeHTML("4445645656", "PLANET");
    echo DNS1D::getBarcodeHTML("4445645656", "RMS4CC");
    echo DNS1D::getBarcodeHTML("4445645656", "KIX");
    echo DNS1D::getBarcodeHTML("4445645656", "IMB");
    echo DNS1D::getBarcodeHTML("4445645656", "CODABAR");
    echo DNS1D::getBarcodeHTML("4445645656", "CODE11");
    echo DNS1D::getBarcodeHTML("4445645656", "PHARMA");
    echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");


## TODO:

- Convert snake_case method names to camelCase
- Replace returns from barcode constructors with exception throws
- Write tests
- Write docs
- parent::__construct($code); in all barcodes
- remove unused methods