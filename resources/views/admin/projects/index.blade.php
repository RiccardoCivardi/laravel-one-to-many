@extends('layouts.admin')

@section('title')

    | Projects - Index

@endsection

@section('content')

    <div class="container-fluid h-100 overflow-auto">

        <div class="d-flex justify-content-between align-items-center">

            <h1>PROGETTI</h1>

            <a class="btn btn-outline-success btn-sm" href="{{route('admin.projects.create')}}">NUOVO PROGETTO</a>

        </div>

        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                {{session('deleted')}}
            </div>
        @endif

        <table class="table table-dark table-striped">
            <thead>

                <tr>

                    @php

                        $class_active_id = '';
                        $class_active_name = '';
                        $class_active_updated_at = '';

                        $class_active_id = Route::currentRouteName() === 'admin.projects.index' ? 'active-desc' : '';

                        if($class_active = Route::currentRouteName() === 'admin.projects.orderby'){
                            if($th_active == 'id' && $direction == 'desc'){
                                $class_active_id = 'active-desc';
                            }else if($th_active == 'id' && $direction == 'asc'){
                                $class_active_id = 'active-asc';
                            } else if($th_active == 'name' && $direction == 'desc'){
                                $class_active_name = 'active-desc';
                            }else if($th_active == 'name' && $direction == 'asc'){
                                $class_active_name = 'active-asc';
                            } else if($th_active == 'updated_at' && $direction == 'desc'){
                                $class_active_updated_at = 'active-desc';
                            }else if($th_active == 'updated_at' && $direction == 'asc'){
                                $class_active_updated_at = 'active-asc';
                            }
                        }

                        $class_active = Route::currentRouteName() === 'admin.projects.orderby' ? 'active' : '';

                    @endphp

                    <th scope="col">
                        <a class="link-custom {{$class_active_id}}" href="{{route('admin.projects.orderby',['id',$direction])}}">ID</a>
                    </th>
                    <th scope="col">
                        <a class="link-custom {{$class_active_name}}" href="{{route('admin.projects.orderby',['name',$direction])}}">NOME PROGETTO</a>
                    </th>
                    <th scope="col">
                        <a class="link-custom {{$class_active_updated_at}}" href="{{route('admin.projects.orderby',['updated_at',$direction])}}">ULTIMA MODIFICA</a>
                    </th>
                    <th scope="col">AZIONI</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($projects as $project)

                    <tr>

                        <td>{{$project->id}}</td>

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

                        <td>
                            {{$project->name}}
                            <span class="badge {{$badge_class}}">{{$project->type?->name}}</span>
                        </td>

                        <td>{{date_format(date_create($project->update_at), 'd/m/Y')}}</td>

                        <td class="px-0">
                            <a class="btn btn-outline-primary btn-sm" href="{{route('admin.projects.show' , $project)}}" title="show"><i class="fa-solid fa-eye"></i></a>

                            <a class="btn btn-outline-warning btn-sm" href="{{route('admin.projects.edit', $project)}}" title="edit"><i class="fa-solid fa-pen"></i></a>

                            @include('admin.partials.form-delete')

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4">
                            <h3>Nessun risultato trovato</h3>
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

        <!-- pagination -->
        <div class="pagination-container d-flex justify-content-center mt-3">
            {{$projects->links()}}
        </div>

    </div>

@endsection
