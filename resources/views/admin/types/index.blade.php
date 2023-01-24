@extends('layouts.admin')

@section('title')
    | Admin - Type
@endsection

@section('content')
<div class="container-fluid h-100 overflow-auto">

    <h1 class="my-5">Gestione Tipologie</h1>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    <div class="w-50"">
        <form  action="{{route('admin.types.store')}}" method="POST">
            @csrf

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Nuova tipologia">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <i class="fa-solid fa-circle-plus"></i>
                    Aggiungi
                </button>
            </div>

        </form>
    </div>

    <table class="table w-50">

        <thead>

            <tr>
                <th scope="col">Tipologia</th>
                <th scope="col">Numero di progetti</th>
            </tr>

        </thead>

        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td class="d-flex align-items-center">
                        <form action="{{route('admin.types.update', $type)}}" method="POST" class="d-flex">
                            @csrf
                            @method('PATCH')
                            <input class="border-0" type="text" name="name" value="{{$type->name}}">
                            <button type="submit" class="btn btn-warning me-3">AGGIORNA</button>
                        </form>

                        @include('admin.partials.form-delete',[
                            'route' => 'types',
                            'message' => "Confermi l'eliminazione della tipologia: $type->name ?",
                            'entity' => $type
                        ])

                    </td>
                    <td class="text-center">
                        <span class="badge text-bg-dark fs-6">{{count($type->projects)}}</span>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

</div>
@endsection
