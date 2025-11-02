<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Profil Pengguna') }}
        </h2>
    </x-slot>

    <div class="bg-blue-50 min-h-screen py-12">
        <div class="max-w-3xl mx-auto space-y-10 px-6">

            {{-- Update Profil --}}
            <div class="bg-white p-8 shadow-md rounded-2xl border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-6 text-center">
                    Informasi Profil
                </h3>
                <div class="max-w-md mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Ganti Password --}}
            <div class="bg-white p-8 shadow-md rounded-2xl border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-6 text-center">
                    Ubah Password
                </h3>
                <div class="max-w-md mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Hapus Akun --}}
            <div class="bg-white p-8 shadow-md rounded-2xl border border-gray-200 mb-10">
                <h3 class="text-lg font-semibold text-red-600 mb-6 text-center">
                    Hapus Akun
                </h3>
                <div class="max-w-md mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
