<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MoviesRequest;
use App\Models\Movies;
use App\Models\Genres;
use App\Models\Actors;
use App\Models\ActorsConnection;

class MoviesController extends Controller
{

    public function showAll(Request $request) {

        $movies = DB::table('movies');

        if($request->input('sort')) {
            switch($request->input('sort')) {
                case 'asc':
                     $movies =  $movies->orderBy('movies.name', 'ASC');
                    break;
                case 'desc':
                     $movies =  $movies->orderBy('movies.name', 'DESC');
                    break;
            }
        }

         $movies =  $movies
                    ->leftJoin('genres', 'genres.id', '=', 'movies.id_genres')
                    ->leftJoin('actorsconnection', 'movies.id', '=', 'actorsconnection.id_movie')
                    ->leftJoin('actors', 'actors.id', '=', 'actorsconnection.id_actors')
                    ->select('movies.id AS id', 'movies.name AS name', 'genres.name AS genres')
                    ->selectRaw('GROUP_CONCAT(actors.name) AS actors')
                    ->groupBy('id');

        if($request->input('field_actors')) {
            $movies =  $movies->where('actors.name', 'like', '%'.$request->input('field_actors').'%');
        }

        if($request->input('filter_genr')) {
            $movies =  $movies->where('genres.name', 'like', '%'.$request->input('filter_genr').'%');
        }

        $movies = $movies->get();

        return $movies;
    }

    public function showItem($id) {
        $movie = DB::table('movies')
                    ->leftJoin('genres', 'genres.id', '=', 'movies.id_genres')
                    ->leftJoin('actorsconnection', 'movies.id', '=', 'actorsconnection.id_movie')
                    ->leftJoin('actors', 'actors.id', '=', 'actorsconnection.id_actors')
                    ->select('movies.id AS id', 'movies.name AS name', 'genres.name AS genres')
                    ->selectRaw('GROUP_CONCAT(actors.name) AS actors')
                    ->where('movies.id', $id)
                    ->groupBy('id')
                    ->get();

        if(!count($movie)) {
            return response()->json(['message'=>'not found'], 404);
        }
        return $movie;
    }

    public function createItem(Request $request, MoviesRequest $req) {

        $genres = Genres::firstOrCreate([
            'name' => $request->input('genres')
        ]);

        $movie = Movies::create([
            'name' => $request->input('name'),
            'id_genres' => $genres->id
        ]);

        foreach(explode(',', $request->input('actors')) as $v) {
            $actor = Actors::firstOrCreate([
                'name' =>  $v
            ]);

            ActorsConnection::create([
                'id_movie' => $movie->id,
                'id_actors' => $actor->id
            ]);

        }

        return response()->json(['message'=>'create item'], 201);
    }

    public function updateItem(Request $request, $id) {

        $genres = Genres::firstOrCreate([
            'name' => $request->input('genres')
        ]);


        $movie = Movies::findOrFail($id);
        $movie->update([
            'name' => $request->input('name'),
            'id_genres' => $genres->id
        ]);

        ActorsConnection::where('id_movie', '=', $movie->id)->delete();

        foreach(explode(',', $request->input('actors')) as $v) {
            $actor = Actors::firstOrCreate([
                'name' =>  $v
            ]);

            ActorsConnection::create([
                'id_movie' => $movie->id,
                'id_actors' => $actor->id
            ]);
        }

        return response()->json(['message'=>'update item'], 200);
    }

    public function deleteItem($id) {
        $movie = Movies::findOrFail($id);
        Movies::find($id)->delete();

        ActorsConnection::where('id_movie', '=', $movie->id)->delete();

        return response()->json(null, 204);
    }

}
