# PESEL validator

PESEL validator for Symfony 4.x, 5.x and 6.x.

## Installation

#### 1. Composer
From the command line run

```
$ composer require pajerdesign/pesel-validator
```

#### 2. Register bundle

Enable the bundle by adding new AJERdesign\PeselValidator\PeselValidator() to the bundles array of the return method in your project's config/bundles.php file:
```php
<?php

    return [
        // ... 
        PAJERdesign\PeselValidator\PeselValidator::class => ['all' => true]
    ];
```

## Example usage

#### via Attributes
```php
use PAJERdesign\PeselValidator\PeselValidator;

// ...

#[PeselValidator]
private ?string $pesel = null;

public function isSuperUser(): bool
{
    return true;
}
```

#### via Annotations

```php
use PAJERdesign\PeselValidator\PeselValidator;

// ...

/**
 * @PeselValidator
 */
public $iban;
```