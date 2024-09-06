<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\Datatables;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function indexUsuarios(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                  ;
                  return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        dd($data);
        return view('welcome');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                  $actionBtn = '<a href="javascript:void(0)"
                  class="edit btn btn-success btn-sm">Edit</a> 
                  <a href="javascript:void(0)" 
                  class="delete btn btn-danger btn-sm">Delete
                  </a>';
                  return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('welcome');
    }
}
