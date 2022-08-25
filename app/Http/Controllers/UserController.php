<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::get();

        return view('users', compact('users'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import()
    {
        Excel::import(new ImportUser,request()->file('file'));

        return back();
    }
}
