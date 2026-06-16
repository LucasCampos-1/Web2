@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Autor</h1>

    <form action="{{ route('authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ $author->name }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>

            <input
                type="email"
                name="email"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>

            <input
                type="date"
                name="birth_date"
                class="form-control"
                required
            >
        </div> 

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

        <a href="{{ route('authors.index') }}" class="btn btn-secondary">
            Voltar
        </a>
    </form>
</div>
@endsection