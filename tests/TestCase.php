<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->getEnvironmentSetUp();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    protected function loadMigrationsFrom($paths): void
    {
        $options = is_array($paths) ? $paths : ['--path' => $paths];

        if (isset($options['--realpath']) && is_string($options['--realpath'])) {
            $options['--path'] = [$options['--realpath']];
        }

        $options['--realpath'] = true;

        Artisan::call('migrate:status', ['--env'=>'testing']);
        $artisan_output = Artisan::output();
        if (preg_match('/^\| N|^No migrations|^Migration table not found/is', $artisan_output) > 0) {
            fwrite(STDERR, ' ⌚ Migrating and seeding...' . PHP_EOL);

            Artisan::call('migrate');
            Artisan::call('db:seed', ['--env'=>'testing']);

            fwrite(STDERR, ' ✓ Done!' . PHP_EOL);
        } elseif ($artisan_output === '') {
            throw new \Exception(
                'Unexpected response calling migrate:status on loadMigrationsFrom() function: "'. $artisan_output .'"'
            );
        }
    }

    protected function getEnvironmentSetUp(): void
    {
        $filename = '/tmp/database-larastan-example.sqlite';
        if (!file_exists($filename)) {
            file_put_contents($filename, '');
        }
    }
}
