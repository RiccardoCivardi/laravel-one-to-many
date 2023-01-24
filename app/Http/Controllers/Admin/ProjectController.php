<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('name','like',"%$search%")->orderBy('id','desc')->paginate(10);
        }else{
            $projects = Project::orderBy('id','desc')->paginate(10);
        }

        // $projects = Project::orderBy('id','desc')->paginate(10);

        $direction = 'desc';

        return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function types_project(){

        $types = Type::all();

        return view('admin.projects.list_type_project', compact('types'));
    }

    public function orderby($column, $direction){
        $direction = $direction === 'desc' ? 'asc' : 'desc';

        $projects = Project::orderBy($column,$direction)->paginate(10);

        $th_active = $column;

        return view('admin.projects.index', compact('projects','direction', 'th_active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        // validazione

        // la request validate la metto nel file ProjectRequest che creo con questo comando
        // php artisan make:request ProjectRequest
        // poi la metto in store(...) e la importo

        $form_data=$request->all();
        $form_data['slug'] = Project::generateSlug($form_data['name']);

        // se è presente il file immagine lo salvo nel filesystem e nel db
        if(array_key_exists('cover_image', $form_data)){
            // salvo il nome originale
            $form_data['cover_image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            // salvo il file sul filesystem e il path in $form_data['cover_image]
            $form_data['cover_image'] = Storage::put('uploads', $form_data['cover_image']);
        }

        // dd($form_data);


        // posso evitare questi 3 passaggi scrivendo
        // $new_project= new Project();
        // $new_project->fill($form_data);
        // $new_project->save();

        $new_project = Project::create($form_data);




        //faccio il redirect a index passando in sessione l'eliminazione per mostrare l'alert
        return redirect()->route('admin.projects.show', $new_project)->with('created', "Il progetto è stato creato correttamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        // dump($comic);
        // dd($form_data);

        // modifico lo slug generandone uno nuovo se e solo se il titolo è stato modifcato
        if($form_data['name'] != $project->name){
            $form_data['slug'] = Project::generateSlug($form_data['name']);
        } else {
            $form_data['slug'] = $project->slug;
        }

        // controllo immagine
        if(array_key_exists('cover_image',$form_data)){

            // se invio una nuova immagine devo eliminare la vecchia dal filesystem
            if($project->cover_image){
                Storage::disk('public')->delete($project->cover_image);
            }
            $form_data['cover_image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image'] = Storage::put('uploads', $form_data['cover_image']);
        }

        $project->update($form_data);

        return redirect()->route('admin.projects.show', $project)->with('updated', "Il progetto è stato modificato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        if($project->cover_image){
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        //faccio il redirect a index passando in sessione l'eliminazione per mostrare l'alert
        return redirect()->route('admin.projects.index')->with('deleted', "Il progetto $project->name è stato eliminato correttamente");
    }
}
