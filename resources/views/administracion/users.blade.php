@extends('layouts.adm')

@section('tituloAdm', '- Usuarios')

@section('contenidoAdm')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">Lista de Usuarios</h2>

    <!-- Tabla de usuarios -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Apellido</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Celular</th>
                    <th scope="col" class="px-6 py-3">Compras</th>
                    <th scope="col" class="px-6 py-3">Fecha de Registro</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->apellido }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->celular }}</td>
                    <td class="px-6 py-4">{{ $user->compras ?? '0' }}</td>
                    <td class="px-6 py-4">{{ $user->registro }}</td>
                    <td class="px-6 py-4">
                        <!-- Acciones como editar o eliminar el usuario -->
                        {{-- <a href="{{ route('admin.user.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a> |
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
