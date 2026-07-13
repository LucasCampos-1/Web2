@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                
                <div class="mb-4">
                <a href="{{ route('books.index') }}" class="btn btn-primary">
                    <i class="bi bi-book"></i> Livros
                </a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('authors.index') }}" class="btn btn-primary">
                        <i class="bi bi-person"></i> Autores
                    </a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('publishers.index') }}" class="btn btn-primary">
                        <i class="bi bi-building"></i> Editoras
                    </a>
                </div>
                <div class="mb-4">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">
                        <i class="bi bi-tags"></i> Categorias
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
