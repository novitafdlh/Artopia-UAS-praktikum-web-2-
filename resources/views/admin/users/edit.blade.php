@extends('components.admin_layout')

@section('title', 'Edit User')

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight">
        {{ __('Edit User') }} - {{ $user->name }}
    </h2>
@endsection

@section('content')
    <div class="py-8 sm:py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8"> 
            <div class="bg-white rounded-lg shadow-xl overflow-hidden p-6 lg:p-8">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.user.update', $user->id) }}"> 
                        @csrf
                        @method('PUT')

                        <div class="mb-4"> 
                            <label for="name" class="block font-semibold text-sm text-zinc-700 mb-1">Nama</label>
                            <input id="name" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p> {{-- Error message style --}}
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-semibold text-sm text-zinc-700 mb-1">Email</label>
                            <input id="email" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                            @error('email')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4"> 
                            <label for="role" class="block font-semibold text-sm text-zinc-700 mb-1">Role</label>
                            @if ($user->role === 'admin')
                                <input id="role" class="block mt-1 w-full px-4 py-3 bg-[#8E8B9B] border border-[#235347] rounded-lg shadow-sm cursor-not-allowed text-[#051F20] font-semibold" type="text" value="Admin" disabled />
                                <input type="hidden" name="role" value="admin">
                                <p class="text-sm text-gray-600 mt-1">Role admin tidak dapat diubah melalui panel ini.</p>
                            @else
                                <select id="role" name="role" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20]" required>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            @endif
                            @error('role')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block font-semibold text-sm text-zinc-700 mb-1">Password Baru (Biarkan kosong jika tidak ingin mengubah)</label>
                            <input id="password" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" type="password" name="password" autocomplete="new-password" />
                            @error('password')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="password_confirmation" class="block font-semibold text-sm text-zinc-700 mb-1">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" type="password" name="password_confirmation" autocomplete="new-password" />
                            @error('password_confirmation')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#163832] to-[#235347] border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:from-[#0B2B26] hover:to-[#163832] focus:outline-none focus:ring-2 focus:ring-[#8E8B9B] focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Perbarui User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection