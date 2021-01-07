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

        $success = request()->session()->pull('success', null);
        $message = null;
        if (is_array($success)) $message = $success[0];

        $data = ['id' => $id, 'user' => $user, 'success' => $message];

        // dumper()->dump(request()->session());

        return view('users::view-user', $data);
    }
}