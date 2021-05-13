<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Artigo;
use App\User ;

class AdminController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $migalhas = json_encode([
            ["titulo"=>"Admin","url"=>""]
        ]);

        $qtdArtigo = Artigo::count();
        $qtdUser = User::count();
        $qtdAutor = User::where('autor','S')->count();
        $qtdAdmin = User::where('admin','S')->count();

        return view('admin', compact('migalhas','qtdArtigo','qtdAutor','qtdUser','qtdAdmin'));
    }
}
