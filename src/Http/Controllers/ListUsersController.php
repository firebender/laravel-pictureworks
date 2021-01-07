<?php

namespace FireBender\Laravel\PictureWorks\Http\Controllers;

use Illuminate\Routing\Controller;
use FireBender\Laravel\PictureWorks\Services\UserService;

class ListUsersController extends Controller
{
    /**
     * Get paged list of users
     *
     * @param FireBender\Laravel\PictureWorks\Services\UserService $service
     * @return \Illuminate\View\View
     */
    public function __invoke(UserService $service)
    {
        $users = $service->getPagedUsers();

        $data = ['users' => $users];

        return view('users::list-users', $data);
    }
}