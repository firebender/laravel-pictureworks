<?php

namespace FireBender\Laravel\PictureWorks\Tests\Feature;

use Illuminate\Support\Arr;
use FireBender\Laravel\PictureWorks\Tests\TestCase;
use FireBender\Laravel\PictureWorks\Services\UserService;
use FireBender\Laravel\PictureWorks\Models\User;

class UserServiceTest extends TestCase

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
     * Get user by id
     * 
     * @test
     */
    function get_user_by_id()
    {
        $this->userSeeder();

        $service = $this->app->make(UserService::class);

        $user = $service->getUserById(1);

        $name = 'John Smith';
        $this->assertSame($name, $user->name);

        $comments = 'Director';
        $this->assertSame($comments, $user->comments);
    }

    /**
     * Get a user that doesn't exist
     * 
     * @test
     */
    function get_non_existent_user()
    {
        $service = $this->app->make(UserService::class);

        $user = $service->getUserById(1);

        $this->assertNull($user);
    }

    /**
     * Add user
     * 
     * @test
     */
    function can_add_user()
    {
        $service = $this->app->make(UserService::class);

        $params = [
            'name' => 'Jane Smith',
            'comments' => 'Directress'
        ];

        $user = $service->addUser($params);

        $name = 'Jane Smith';
        $this->assertSame($name, $user->name);

        $comments = 'Directress';
        $this->assertSame($comments, $user->comments);
    }

    /**
     * Add user exceptions
     * 
     * @test
     */
    function add_user_throws_exceptions()
    {
        $service = $this->app->make(UserService::class);

        // No parameters

        $message = 'Missing parameters name and comments';
        $this->expectExceptionMessage($message);

        $service->addUser();

        // Missing name

        $params = [
            'comments' => 'Directress'
        ];

        $message = 'Missing parameter name';
        $this->expectExceptionMessage($message);

        // Missing comments

        $params = [
            'name' => 'Jane Smith'
        ];

        $message = 'Missing parameter comments';
        $this->expectExceptionMessage($message);
    }

    /**
     * Delete user exceptions
     * 
     * @test
     */
    function delete_user_throws_exceptions()
    {
        $service = $this->app->make(UserService::class);

        // No parameters

        $message = 'Missing parameter id';
        $this->expectExceptionMessage($message);

        $service->deleteUser();

        // User not found

        $id = 2758;

        $format = 'User with id %d not found';
        $message = sprintf($format, $id);
        $this->expectExceptionMessage($message);

        $service->deleteUser($id);

    }

    /**
     * Delete user
     * 
     * @test
     */
    function can_delete_user()
    {
        $this->userSeeder();

        $service = $this->app->make(UserService::class);

        $service->deleteUser(1);

        $this->assertEquals(0, $service->count());
    }

    /**
     * Get user count
     * 
     * @test
     */
    function can_get_user_count()
    {
        $service = $this->app->make(UserService::class);

        $this->assertEquals(0, $service->count());

        $this->userSeeder();

        $this->assertEquals(1, $service->count());
    }

    /**
     * Delete user exceptions
     * 
     * @test
     */
    function modify_user_throws_exceptions()
    {
        $this->userSeeder();

        $service = $this->app->make(UserService::class);

        // No parameter id

        $message = 'Missing parameter id';
        $this->expectExceptionMessage($message);
        $service->modifyUser();

        // User not found

        $id = 2758;

        $format = 'User with id %d not found';
        $message = sprintf($format, $id);
        $this->expectExceptionMessage($message);

        $params = ['id' => $id];
        $service->modifyUser($params);

        // Parameters with missing name and comments

        $message = 'Parameters must include name and/or comments';
        $this->expectExceptionMessage($message);
        $service->modifyUser();

    }

    /**
     * Modify user name
     * 
     * @test
     */
    function can_modify_user_name()
    {
        $this->userSeeder();

        $service = $this->app->make(UserService::class);

        $id = 1;
        $name = 'Black Panther';

        $params = [
            'id' => $id,
            'name' => $name,
        ];

        $user = $service->modifyUser($params);

        $this->assertEquals($name, $user->name);
    }

    /**
     * Modify user comments
     * 
     * @test
     */
    function can_modify_user_comments()
    {
        $this->userSeeder();

        $service = $this->app->make(UserService::class);

        $id = 1;
        $comments = 'Avenger';

        $params = [
            'id' => $id,
            'comments' => $comments,
        ];

        $user = $service->modifyUser($params);

        $this->assertEquals($comments, $user->comments);
    }

    /**
     * Seed users table
     * 
     * @test
     */
    function can_seed_users()
    {
        $service = $this->app->make(UserService::class);

        $this->assertEquals(0, $service->count());

        $count = 50;

        $service->seed($count);

        $this->assertEquals($count, $service->count());
    }


    /**
     * Get paged users
     * 
     * @test
     */
    function can_get_paged_users()
    {
        $service = $this->app->make(UserService::class);
        $service->seed(20);

        // IDs 1-10

        $expected = [];
        $users = User::where('id', '<=', 10)->get();
        foreach ($users as $user)
        {
            $expected[$user->id] = $user->name;
        }

        $actual = [];
        $users = $service->getPagedUsers()->getCollection();
        foreach ($users as $user)
        {
            $actual[$user->id] = $user->name;
        }

        $this->assertSame($expected, $actual);

        // IDs 11-20
        // 
        $expected = [];
        $users = User::where('id', '>', 10)->get();
        foreach ($users as $user)
        {
            $expected[$user->id] = $user->name;
        }

        $actual = [];
        $users = $service->getPagedUsers(2)->getCollection();
        foreach ($users as $user)
        {
            $actual[$user->id] = $user->name;
        }

        $this->assertSame($expected, $actual);
    }

}