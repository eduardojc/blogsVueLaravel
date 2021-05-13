<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Auth;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo','descricao','conteudo','data'];
    protected $dates = ['deleted_at'];

    public function autor() {

        return $this->belongsTo('App\User','user_id');
    }

    public static function listaArtigos($pag) {

        $user = Auth::user();

        if($user->admin == "S") {
            $listaArtigos = DB::table('artigos')
            ->join('users','users.id','artigos.user_id')
            ->select('artigos.id','artigos.titulo','artigos.descricao',
            'artigos.data','users.name')
            ->whereNull('deleted_at')
            ->orderBy('artigos.id','DESC')
            ->paginate($pag);
        } else {     
            $listaArtigos = DB::table('artigos')
                ->join('users','users.id','artigos.user_id')
                ->select('artigos.id','artigos.titulo','artigos.descricao',
                'artigos.data','users.name')
                ->whereNull('deleted_at')
                ->where('artigos.user_id',$user->id)
                ->orderBy('artigos.id','DESC')
                ->paginate($pag);
        }

        return $listaArtigos;
    }

    public static function listaArtigosSite($pag, $busca = null) {

        if($busca) {
            $listaArtigos = DB::table('artigos')
                ->join('users','users.id','artigos.user_id')
                ->select('artigos.id','artigos.titulo','artigos.descricao',
                'artigos.data','users.name as autor')
                ->whereNull('deleted_at')
                ->whereDate('data','<=',date('Y-m-d'))
                ->where(function($query) use ($busca) {
                    $query->orWhere('titulo','like','%'.$busca.'%')
                    ->orWhere('descricao','like','%'.$busca.'%');
                })
                ->orderBy('data','DESC')
                ->paginate($pag);
        } else {

            $listaArtigos = DB::table('artigos')
                ->join('users','users.id','artigos.user_id')
                ->select('artigos.id','artigos.titulo','artigos.descricao',
                'artigos.data','users.name as autor')
                ->whereNull('deleted_at')
                ->whereDate('data','<=',date('Y-m-d'))
                ->orderBy('data','DESC')
                ->paginate($pag);
        }


        return $listaArtigos;
    }

    
}
