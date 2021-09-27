<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('admin.welcome');
    }

    public function notificationsMarkAsRead(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->where('id', $request->id)
            ->first()
            ->markAsRead();

        return redirect()->back();
    }

    public function notificationsIndex()
    {
        return view('admin.notifications.index');
    }
}
