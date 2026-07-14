@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Usuários com Débito Pendente</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>E-mail</th>
                <th>Débito (R$)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usersWithDebt as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>R$ {{ number_format($user->debit, 2, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('debts.clear', $user) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Confirma que o pagamento de R$ {{ number_format($user->debit, 2, ',', '.') }} foi recebido e deseja zerar o débito?')">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">
                                Zerar Débito
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum usuário com débito pendente.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection