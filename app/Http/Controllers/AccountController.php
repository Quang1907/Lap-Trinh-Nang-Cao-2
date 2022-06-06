<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.account.index', compact('users'));
    }

    public function recycle()
    {
        $users = User::onlyTrashed()->paginate(5);
        return view('admin.account.recycle', compact('users'));
    }

    public function destroy($id)
    {
        toast('Chuyển người dùng vào thùng rác thành công.', 'success')->autoClose(1200)->timerProgressBar();
        User::find($id)->delete();
        return redirect()->back();
    }

    public function clear($id)
    {
        toast('Đã xoá người dùng', 'success')->autoClose(1200)->timerProgressBar();
        User::withTrashed()->find($id)->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        toast('Đã mở người dùng', 'success')->autoClose(1200)->timerProgressBar();
        User::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
}
