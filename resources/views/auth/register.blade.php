@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold mb-6 text-center">{{ __('Registro') }}</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                <input id="name" type="text" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('name') border-red-500 @enderror" 
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Dirección de Email') }}</label>
                <input id="email" type="email" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                <input id="password" type="password" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('password') border-red-500 @enderror" 
                       name="password" required autocomplete="new-password">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirmar Contraseña') }}</label>
                <input id="password-confirm" type="password" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                       name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="flex justify-between mt-4">
    <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
        {{ __('Atrás') }}
    </a>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        {{ __('Registrar') }}
    </button>
</div>

        </form>
    </div>
</div>
@endsection
