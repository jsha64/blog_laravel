@extends('layouts.app')

@section('content')
    <h1>Administración de Usuarios</h1>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_active ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.toggle') }}">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <button type="submit">
                            {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection