<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoryResource;
use App\Models\Article;
use App\Models\Favory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favory = Favory::where('user_id',Auth::user()->id)->get();
        if (sizeof($favory) == 0) {
            return $this->sendError('no found.');
        }
        
        return $this->sendResponse(FavoryResource::collection($favory), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articleExist = Article::find($request->article_id);
        if (is_null($articleExist)) {
            return $this->sendError('article_id not found.');
        }
        if (Auth::check() && Auth::user()->role === "client") {
          $favory=  Favory::create(
                [
                    "user_id"=>Auth::user()->id,
                    "article_id"=>$request->article_id
                ]
                );
        }else{
            return $this->sendError( 'not connected.');
        }
        return $this->sendResponse($favory,'favory is save Successfully.');
        // return $this->sendResponse(FavoryResource::collection($favory), 'favory is save Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favoryExist = Favory::where('id', $id)->exists();
        if ($favoryExist == null) {
            return $this->sendError('Favory is not exist.');
        }
        $favory = Favory::findOrFail($id);
        $favory->delete();
        return $this->sendResponse([], 'Entreprise Deleted Successfully.');
    }

    public function favorite($article){
        $articleExist = Article::find($article);
        if (is_null($articleExist)) {
            return $this->sendError('article_id not found.');
        }
        if (Auth::check() && Auth::user()->role === "client") {
          $favory=  Favory::create(
                [
                    "user_id"=>Auth::user()->id,
                    "article_id"=>$article
                ]
                );
        }else{
            return $this->sendError( 'not connected.');
        }
        return $this->sendResponse($favory,'favory is save Successfully.');
        // return $this->sendResponse(FavoryResource::collection($favory), 'favory is save Successfully.');
    }
}
