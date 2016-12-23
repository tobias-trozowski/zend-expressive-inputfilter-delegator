# zend-expressive-inputfilter-delegator

[![Latest Stable Version](https://poser.pugx.org/tobias/zend-expressive-inputfilter-delegator/v/stable)](https://packagist.org/packages/tobias/zend-expressive-inputfilter-delegator)
[![Total Downloads](https://poser.pugx.org/tobias/zend-expressive-inputfilter-delegator/downloads)](https://packagist.org/packages/tobias/zend-expressive-inputfilter-delegator)
[![Build Status](https://travis-ci.org/tobias-trozowski/zend-expressive-inputfilter-delegator.svg?branch=master)](https://travis-ci.org/tobias-trozowski/zend-expressive-inputfilter-delegator)
[![Coverage Status](https://coveralls.io/repos/tobias-trozowski/zend-expressive-inputfilter-delegator/badge.svg?branch=master)](https://coveralls.io/r/tobias-trozowski/zend-expressive-inputfilter-delegator?branch=master)
[![License](https://poser.pugx.org/tobias/zend-expressive-inputfilter-delegator/license)](https://packagist.org/packages/tobias/zend-expressive-inputfilter-delegator)

Delegator for Zend [InputFilterPluginManager](https://github.com/zendframework/zend-inputfilter)

This package provides a delegator for the InputFilterPluginManager which configures the PluginManager to use the service configuration from ```input_filters``` from your config.

The package is intended to be used with [Zend Expressive Skeleton](https://github.com/zendframework/zend-expressive-skeleton) or any other [Zend Expressive](https://github.com/zendframework/zend-expressive) application.


## Installation

The easiest way to install this package is through composer:

```bash
$ composer require tobias/zend-expressive-inputfilter-delegator
```

## Configuration

In the general case where you are only using a single connection, it's enough to define the delegator factory for the InputFilterManager:

```php
return [
    'dependencies' => [
        'delegators' => [
            'InputFilterManager' => [
                \Tobias\Expressive\InputFilter\InputFilterManagerDelegatorFactory::class,
            ],
        ],
    ],
];
```

### Using Expressive Config Manager

If you're using the [Expressive Config Manager](https://github.com/mtymek/expressive-config-manager) you can easily add the ConfigProvider class.

```php
$configManager = new ConfigManager(
    [
        \Tobias\Expressive\InputFilter\ConfigProvider::class,
    ]
);
```