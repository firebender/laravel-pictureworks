<?php

namespace FireBender\Laravel\PictureWorks\Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use FireBender\Laravel\PictureWorks\Tests\TestCase;
use FireBender\Laravel\PictureWorks\Models\User;

class UserTest extends TestCase

{
    /**
     * 
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
    
    /**
     * Does our users table exist
     * 
     * @test
     */
    function users_table_exists()
    {
        $this->assertTrue(Schema::hasTable('users'));
    }

    /**
     * Get our John Smith record
     * 
     * @test
     */
    function can_get_john_smith()
    {
        $this->userSeeder();

        $user = User::find(1);

        $name = 'John Smith';
        $this->assertSame($name, $user->name);

        $comments = 'Director';
        $this->assertSame($comments, $user->comments);
    }

    /**
     * Add a user
     * 
     * @test
     */
    function can_add_user()
    {
        $user = new User();
        $user->name = 'Jane Smith';
        $user->comments = 'Directress';
        $user->save();

        $user = User::find(1);

        $name = 'Jane Smith';
        $this->assertSame($name, $user->name);

        $comments = 'Directress';
        $this->assertSame($comments, $user->comments);
    }

    /**
     * Modify a user
     * 
     * @test
     */
    function can_update_john_smith()
    {
        $this->userSeeder();

        $user = User::find(1);
        $user->comments = 'Janitor';
        $user->save();

        $user = User::find(1);

        $name = 'John Smith';
        $this->assertSame($name, $user->name);

        $comments = 'Janitor';
        $this->assertSame($comments, $user->comments);
    }

    /**
     * Delete a user
     * 
     * @test
     */
    function can_delete_john_smith()
    {
        $this->userSeeder();

        User::destroy(1);

        $table = (new User)->getTable();

        $this->assertEquals(0, DB::table($table)->count());
    }
}