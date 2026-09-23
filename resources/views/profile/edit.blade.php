@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6 md:p-10">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">👤 Edit Profil</h2>

    {{-- Notifikasi sukses --}}
    @if (session('status'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <div class="space-y-10">
        {{-- Update Foto + Data --}}
        <div>
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div>
            @include('profile.partials.update-password-form')
        </div>

        {{-- Hapus Akun (opsional, bisa dihapus kalau tidak perlu) --}}
        {{-- <div>
            @include('profile.partials.delete-user-form')
        </div> --}}
    </div>
</div>
@endsection
