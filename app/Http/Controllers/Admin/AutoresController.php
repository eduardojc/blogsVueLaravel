<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\User;

class AutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $migalhas = json_encode([
            ["titulo"=>"Home","url"=>route('home')],
            ["titulo" =>"Lista de Autores","url"=>""]
        ]);

        $listaModelo = User::select('id','name','email','autor')->where('autor','S')->paginate(15);

        return view('admin.autores.index',compact('migalhas','listaModelo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $validacao = \Validator::make($data,[   
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6",
        ]);
        
        if($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $data['password'] = bcrypt($data['password']);
        
        User::create($data);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if(isset($data['password']) && $data['password'] != "") {
            $validacao = \Validator::make($data,[   
                "name" => "required|string|max:255",
                "email" => ['required','string','email','max:255', 
                Rule::unique('users')->ignore($id)],
                "password" => "required|string|min:6",
            ]);

            $data['password'] = bcrypt($data['password']);
        } else {

            $validacao = \Validator::make($data,[   
                "name" => "required|string|max:255",
                "email" => ['required','string','email','max:255', 
                Rule::unique('users')->ignore($id)],
            ]);

            // não salva a senha caso ela for vazia.
            unset($data['password']);
        }
        
        if($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }
        
        User::find($id)->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->back();
    }
}
