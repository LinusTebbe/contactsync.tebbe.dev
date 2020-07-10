<?php

namespace App\Http\Controllers;

use App\Credentials;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @param Request $request
     * @return Renderable
     */
    public function post(Request $request) {
        if($action = $request->post('action')) {
            switch ($action) {
                case 'resetPassword':
                    if($credentials = Auth::user()->credentials()->find($request->post('id'))) {
                        return view('home', [
                            'success' => true,
                            'message' => <<<EOT
                                Set Password for <b>$credentials->id ($credentials->name)</b> to "{$credentials->resetPassword()}"<br>
                                <b>WARNING: Take note of this password, as it won't be shown again</b>
                            EOT
                        ]);
                    } else {
                        return view('home', [
                            'success' => false,
                            'message' => 'The specified credentials couldn\'t be found.'
                        ]);
                    }
                    break;
                case 'delete':
                    if($credentials = Auth::user()->credentials()->find($request->post('id'))) {
                        $credentials->forceDelete();
                        return view('home', [
                            'success' => true,
                            'message' => <<<EOT
                                Successfully deleted <b>$credentials->id ($credentials->name)</b>
                            EOT

                        ]);
                    }
                    break;
                case 'create':
                    $credentials = new Credentials();

                    $credentials->name = $request->post('name');
                    $credentials->user()->associate(Auth::user());

                    return view('home', [
                        'success' => true,
                        'message' => <<<EOT
                            Created new credentials <b>$credentials->id ($credentials->name)</b> with password "{$credentials->resetPassword()}"<br>
                            <b>WARNING: Take note of this password, as it won't be shown again</b>
                        EOT
                    ]);
                    break;
            }
        }

        return view('home');
    }
}
