<?php

namespace FireBender\Laravel\PictureWorks\Services;

use Illuminate\Support\Facades\DB;
use FireBender\Laravel\PictureWorks\Models\User;
use Exception;

class UserService
{
    /**
     * Gets a user by id
     *
     * @var $id The user id
     * @return User The user model
     */
    public function getUserById(int $id) : ?User
    {
        return User::find($id);
    }

    /**
     * Adds a user
     *
     * @var $params ['name', 'comments']
     * @throws Exception If no parameters are passed
     * @throws Exception If name parameter is missing
     * @throws Exception If comments paramter is missing
     * @return User The new user model
     */
    public function addUser(array $params = []) : User
    {
        if (count($params) == 0)
        {
            throw new Exception('Missing parameters name and comments');
        }

        if (!isset($params['name']))
        {
            throw new Exception('Missing parameter name');
        }

        if (!isset($params['comments']))
        {
            throw new Exception('Missing parameter comments');
        }

        $user = new User();
        $user->name = $params['name'];
        $user->comments = $params['comments'];
        $user->save();

        return $user;
    }

    /**
     * Deletes a user
     *
     * @var $id The user id
     * @throws Exception If id is missing
     * @throws Exception If user isn't found
     * @return void
     */
    public function deleteUser(int $id = null) : void
    {
        if ($id === null)
        {
            throw new Exception('Missing parameter id');
        }

        $user = User::find($id);

        if ($user === null)
        {
            $format = 'User with id %d not found';
            $message = sprintf($format, $id);
            throw new Exception($message);
        }

        User::destroy($id);
    }

    /**
     * Modifies a user
     *
     * @var $params ['id', name', 'comments']
     * @throws Exception If parameter id is missing
     * @throws Exception If user not found
     * @throws Exception If both name and comments are missing
     * @return User The modified user model
     */
    public function modifyUser(array $params = []) : User
    {
        if (!isset($params['id']))
        {
            throw new Exception('Missing parameter id');
        }

        $id = $params['id'];

        $user = $this->getUserById($id);

        if ($user === null)
        {
            $format = 'User with id %d not found';
            $message = sprintf($format, $id);
            throw new Exception($message);
        }

        if (!isset($params['name']) && !isset($params['comments']))
        {
            throw new Exception('Parameters must include name and/or comments');
        }

        if (isset($params['name']))
        {
            $user->name = $params['name'];
        }

        if (isset($params['comments']))
        {
            $user->comments = $params['comments'];
        }

        $user->save();

        return $user;
    }

    /**
     * Returns count of users in table
     *
     * @return $count Count of user rows
     */
    public function count() : int
    {
        $table = (new User)->getTable();

        return DB::table($table)->count();
    }

    /**
     * Seeds the user table
     *
     * @return null
     */
    public function seed(int $count) : void
    {
        User::factory()->count($count)->create();
    }

    /**
     * 
     */
    public function getPagedUsers($page = 1, $perPage = 10)
    {
        return User::simplePaginate($perPage, ['*'], 'page', $page);
    }
}