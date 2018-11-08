Doctrine Fixtures Extension for Behat
=====================================

The extension increases feature test isolation by reloading ORM data fixtures between scenarios and features.

**Works with `symfony^4` & `doctrine/doctrine-fixtures-bundle^3`.**

# Installation

```sh
composer require "behat-extension/doctrine-data-fixtures-extension"
```

```php
<?php # config/bundles.php
return [
    \BehatExtension\DoctrineDataFixturesExtension\Bundle\BehatDoctrineDataFixturesExtensionBundle::class => ['test' => true],
];
```
**@todo** : flex recipe ?

# Configuration

Activate extension in your **behat.yml** and define any fixtures to be loaded:

```yaml
# behat.yml
default:
  # ...
  extensions:
    BehatExtension\DoctrineDataFixturesExtension\Extension:
      lifetime:    'feature'
```

When **lifetime** is set to "feature" (or unspecified), data fixtures are reloaded between feature files.  Alternately,
when **lifetime** is set to "scenario", data fixtures are reloaded between scenarios (i.e., increased
test isolation at the expense of increased run time).

This extension will load every fixtures declared as services and tagged with `doctrine.fixture.orm`.

# Backup System

To speed up the tests, a backup system is available. The whole database will be set in cache and reloaded when needed.
You should periodically clear the cache as it does not detect changes to the data fixture contents because the hash is based on the collection of data fixture class names.

This feature is only available for SQLite, MySQL and PostgreSQL.

* For MySQL, `mysql` and `mysqldump` must be available.
* For PostgreSQL, `pg_restore` and `pg_dump` must be available.

It is enabled by default. To disable it, you just have to set `use_backup: false` in the extension configuration:

```yaml
# behat.yml
default:
  # ...
  extensions:
    BehatExtension\DoctrineDataFixturesExtension\Extension:
      lifetime: 'feature'
      use_backup: false
```

# Source

Github: [https://github.com/BehatExtension/DoctrineDataFixturesExtension](https://github.com/BehatExtension/DoctrineDataFixturesExtension)

Forked from [https://github.com/vipsoft/DoctrineDataFixturesExtension](https://github.com/vipsoft/DoctrineDataFixturesExtension)

# Copyright

* Copyright (c) 2012 Anthon Pang.
* Copyright (c) 2016-2018 Florent Morselli.

See [LICENSE](LICENSE) for details.

# Contributors

* Anthon Pang ([robocoder](http://github.com/robocoder))
* Florent Morselli ([Spomky](http://github.com/Spomky))
* [Others contributors](https://github.com/BehatExtension/DoctrineDataFixturesExtension/graphs/contributors)
