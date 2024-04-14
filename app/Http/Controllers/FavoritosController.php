<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favoritos;

class FavoritosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Favoritos::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $vDados = Favoritos::all();
        $html = "";

        foreach ($vDados as $dados){
            $html .= '<div class="row" id="dados">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <h1 id="nomeN" class="text-center">'.$dados->nome.'</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6" id="pokemon-picture">'.$dados->img.'</div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 id="type">'.$dados->type.'</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 id="weight">'.$dados->weight.'</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 id="height">'.$dados->height.'</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="favorito">
                                            <button type="button" class="btn btn-secondary" onclick="destroyFavaorito('.$dados->id.')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        return $html;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $post = Favoritos::find($_POST['id']);
        $post->delete();
    }
}
