<?php

namespace FireBender\Laravel\PictureWorks\Http\Controllers;

use Illuminate\Routing\Controller;
use FireBender\Laravel\PictureWorks\Services\UserService;

class ViewUserController extends Controller
{
    /**
     * Get paged list of users
     *
     * @param FireBender\Laravel\PictureWorks\Services\UserService $service
     * @return \Illuminate\View\View
     */
    public function __invoke(UserService $service, int $id)
    {
        $user = $service->getUserById($id);

        $data = ['id' => $id, 'user' => $user];

        return view('users::view-user', $data);
    }
}