# LiquibaseBundle
LiquibaseBundle for Symfony

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

```console
$ composer require --dev freesoftde/liquibaseBundle
```

Enable the Bundle:

```php
// config/bundles.php

return [
    // ...
    Freesoftde\LiquibaseBundle\FreesoftdeLiquibaseBundle::class => ['dev' => true, 'test' => true],
];
```