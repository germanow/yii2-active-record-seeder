# Yii2 Active Record Seeder

Seeds database with test or default values.

# Features

- Seeds tables with different strategy using filler classes
- Support relations

# Installation

Run command:
```
$ composer require germanow/yii2-active-record-seeder
```

# Usage

Create ActiveRecordSeeder, configure fillers, call `fill` method:

```php
use germanow\yii2ActiveRecordSeeder\ActiveRecordSeeder;
use germanow\yii2ActiveRecordSeeder\AddFiller;
use germanow\yii2ActiveRecordSeeder\OverwriteFiller;

$seeder = new ActiveRecordSeeder([
    'fillers' => [
        // Default filler is EmptyFiller, which fill table if it's empty
        [
            // Specify name of ActiveRecord model class
            'recordClass' => EventType::class,
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Birthday',
                ],
            ],
        ],
        // OverwriteFiller delete all records before filling
        [
            'class' => OverwriteFiller::class,
            'recordClass' => EventType::class,
            'data' => [
                [
                    'id' => 1,
                    'canonicalName' => 'Birthday',
                    'class' => 'lulz',
                    // Fill relations
                    'translations' => [
                        [
                            'name' => 'День рождения',
                            'languageId' => '5',
                        ],
                    ],
                ],
            ],
        ],
        // AddFiller add records if they not exists in table with such id or attributes.
        [
            'class' => AddFiller::class,
            'recordClass' => EventType::class,
            'data' => [
                // check exists by id
                [
                    'id' => 1,
                    'name' => 'Birthday',
                ],
                // check exists by canonicalName
                [
                    'name' => 'Meeting',
                ],
            ],
        ],
    ],
]);
$seeder->fill();
```

# Why

I wrote this package for filling system tables, which must always be filled, such as `EventType`, `EventStatus` and other. Existing solutions, such as [yii2-db-seeder](https://github.com/tebazil/yii2-db-seeder), don't support filling strategy.
