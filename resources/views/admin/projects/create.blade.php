@extends('layouts.admin')

@section('title')

    | Projects - Create

@endsection

@section('content')

    <div class="container-fluid h-100 overflow-auto">

        <h1 class="mb-3">CREA UN NUOVO PROGETTO</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
             </div>
        @endif

        <!-- Il form punta a store e usa il metodo POST-->
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            <!-- Token per il form, lo vedo nell'inspector nell html -->
            @csrf
            <!-- ogni input deve avere un name che deve corrispondere al campo da salvare nel db-->
            <div class="mb-3">
                <label for="name" class="form-label">Nome progetto</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" placeholder="Inserisci il nome del progetto">
                @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="client_name" class="form-label">Nome cliente</label>
                <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" id="client_name" value="{{old('client_name')}}" placeholder="Inserisci il nome del cliente">
                @error('client_name')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="summary" class="form-label">Descrizione del progetto</label>
                <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" id="summary" placeholder="Inserisci la descrizione del progetto" row="3">{{old('summary')}}</textarea>
                @error('summary')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Immagine</label>
                <input
                onchange="showImage(event)"
                type="file" name="cover_image" class="form-control" id="cover_image">
                @error('cover_image')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror

                <div class="mt-2">
                    <img id="output-image" width="150" src="" alt="">
                </div>

            </div>

            <button type="submit" class="btn btn-outline-success">CREA</button>

        </form>

    </div>

    <script>
        ClassicEditor
                .create( document.querySelector( '#summary' ),{
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                })
                .catch( error => {
                    console.error( error );
                } );

        function showImage(event){
            const tagImage = document.getElementById('output-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }

    </script>

@endsection
