<?php


namespace DissanayakeG\pack\Tests;


use DissanayajeG\pack\BlogPackageServiceProvider;
use DissanayajeG\pack\Database\Migrations\CreatePostsTable;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            BlogPackageServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // import the CreatePostsTable class from the migration
        include_once __DIR__ . '/../database/migrations/create_posts_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_users_table.php.stub';

        // run the up() method of that migration class
        (new \CreatePostsTable)->up();
        (new \CreateUsersTable)->up();
    }
}