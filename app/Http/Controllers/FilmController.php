<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Category;
use App\Http\Requests\Film as FilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug=null)
    {
        //On va chercher tous les films avec la méthode all du modèle, on appelle la vue index en lui
        //transmettant les films
        //$films=Film::all();
        //$films=Film::paginate(6);
        //$films=Film::oldest('year')->paginate(6);
        //return view('index', compact('films'));
        $query = $slug ? Category::whereSlug($slug)->firstOrFail()->films() : Film::query();
        $films = $query->withTrashed()->oldest('title')->paginate(5);
        $categories = Category::all();
        return view('index', compact('films', 'categories', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmRequest $filmRequest)
    {
        Film::create($filmRequest->all());
        return redirect()->route('films.index')->with('info', 'Le film a bien été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        $category = $film->category->name;
        return view('show', compact('film', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        return view('edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilmRequest $filmRequest, Film $film)
    {
        $film->update($filmRequest->all());
        return redirect()->route('films.index')->with('info', 'Le film a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return back()->with('info', 'Le film a bien été mis dans la corbeille');
    }

    public function forceDestroy()
    {
        Film::withTrashed()->whereId('$id')->firstOrFail()->forceDelete();
        return back()->with('info', 'Le film a bien été supprimé définitivement de la base de données');
    }

    public function restore($id)
    {
        Film::withTrashed()->whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'Le film a bien été restauré.');
    }
}
