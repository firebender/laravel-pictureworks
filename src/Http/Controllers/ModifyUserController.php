<?php

namespace FireBender\Laravel\PictureWorks\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use FireBender\Laravel\PictureWorks\Services\UserService;

class ModifyUserController extends Controller
{
    /**
     * Get paged list of users
     *
     * @param FireBender\Laravel\PictureWorks\Services\UserService $service
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request, UserService $service)
    {
        $validated = $request->validateWithBag('post', [
            'id' => 'required|numeric',
            'name' => 'string|nullable|required_without:comments',
            'comments' => 'string|nullable|max:255|required_without:name'
        ]);

        $user = $service->modifyUser($validated);

        $request->session()->push('success', 'User successfully modified');

        return redirect()->route('view-user', ['id' => $user->id]);
    }
}