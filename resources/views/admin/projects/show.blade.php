@extends('layouts.admin')

@section('title')

    | Projects - Show

@endsection

@section('content')

    @if (session('created'))
        <div class="alert alert-success" role="alert">
            {{session('created')}}
        </div>
    @endif

    @if (session('updated'))
        <div class="alert alert-success" role="alert">
            {{session('updated')}}
        </div>
    @endif

    <div class="container-fluid h-100 overflow-auto">

        <div class="mb-3 d-flex justify-content-center align-items-center">

            <h1 class="d-inline me-3">{{$project->name}}</h1>
            <a class="btn btn-outline-warning btn-sm me-2" href="{{route('admin.projects.edit', $project)}}" title="edit"><i class="fa-solid fa-pen"></i></a>

            @include('admin.partials.form-delete' ,[
                'route' => 'projects',
                'message' => "Confermi l'eliminazione del progetto: $project->name",
                'entity' => $project
            ])

        </div>

        <div class="d-flex justify-content-center">
            <div class="card mb-5" style="width: 40rem;">

                @if($project->cover_image)
                    <img src="{{asset('storage/' . $project->cover_image)}}" class="card-img-top" alt="{{$project->cover_image_original_name}}">
                    <div><i>{{$project->cover_image_original_name}}</i></div>
                @endif

                @php

                    $badges_classes = [
                        '1' => 'text-bg-primary',
                        '2' => 'text-bg-secondary',
                        '3' => 'text-bg-success',
                        '4' => 'text-bg-danger',
                        '5' => 'text-bg-warning',
                        '6' => 'text-bg-info'
                    ];

                    // dd($project->type?->id);


                    if(is_null($project->type?->id)){
                        $badge_class = "";
                    } else {
                        $badge_class = $badges_classes[$project->type->id];
                    }

                @endphp

                <div class="card-body">
                    <h3 class="card-title">{{$project->name}}</h3>
                    <span class="badge {{$badge_class}} mb-2">{{$project->type?->name}}</span>
                    <h6 class="card-title">Data di creazione: {{date_format(date_create($project->created_at), 'd/m/Y H:i')}}</h6>
                    <h6 class="card-title">Data ultima modifica: {{date_format(date_create($project->update_at), 'd/m/Y H:i')}}</h6>
                    <h6 class="card-title">CLIENTE: {{$project->client_name}}</h6>
                    <p class="card-text">DESCRIZIONE PROGETTO: {!!$project->summary!!}</p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a class="btn btn-outline-dark" href="{{route('admin.projects.index')}}">TORNA ALL'ELENCO</a>
        </div>

    </div>

@endsection
