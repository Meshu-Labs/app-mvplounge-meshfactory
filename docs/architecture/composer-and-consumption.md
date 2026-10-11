# Composer and Consumption

## Install

composer require mvplounge/meshfactory

## Autoload

require __DIR__ . '/vendor/autoload.php';

## Package Validation

composer validate

## Packaging Policy

Agent and local workflow documents are excluded from package archive artifacts.

See:

- .gitattributes export-ignore entries
- composer.json archive.exclude entries
