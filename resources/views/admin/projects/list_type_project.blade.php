@extends('layouts.admin')

@section('title')
    | Type/Project
@endsection

@section('content')
<div class="container-fluid h-100 overflow-auto">

    <h1 class="my-5">Elenco dei progetti per tipo</h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Tipo</th>
            <th scope="col">Progetti</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($types as $type)
            <tr>

                <td>{{$type->name}}</td>

                <td>
                    <ul>
                        @foreach ($type->projects as $project)
                            <li>
                                <a href="{{route('admin.projects.show', $project)}}">{{$project->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </td>

            </tr>
            @endforeach

        </tbody>
      </table>

</div>
@endsection
