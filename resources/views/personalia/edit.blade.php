@extends('layouts.main')


@section('container')
    <h1 class="text-4xl mb-4">Edit Karyawan</h1>

    <form method="post" action="/karyawan/{{ $karyawan->slug }}" class="max-w-xl">
        @method('put')
        @csrf

        <div class="flex flex-col gap-6">
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('name', $karyawan->name) }}">
            </div>

            @error('name')
                {{ $message }}
            @enderror


            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                    number</label>
                <input type="tel" id="phone" name="nomor_handphone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('nomor_handphone', $karyawan->nomor_handphone) }}" required>
            </div>

            @error('nomor_handphone')
                {{ $message }}
            @enderror

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                    address</label>
                <input type="email" id="email" name="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('email', $karyawan->email) }}" required>
            </div>

            @error('email')
                {{ $message }}
            @enderror

            <div>
                <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    Jabatan</label>
                <select id="jabatan" name="jabatan_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($jabatans as $jabatan)
                        @if (old('jabatan_id', $karyawan->jabatan_id == $jabatan->id))
                            <option value="{{ $jabatan->id }}" selected>{{ $jabatan->jabatan }}</option>
                        @else
                            <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}</option>
                        @endif
                    @endforeach

                </select>
            </div>

            @error('jabatan_id')
                {{ $message }}
            @enderror

            <div>
                <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    Gaji</label>
                <select id="jabatan" name="gaji_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($gajis as $gaji)
                        @if (old('gaji_id', $karyawan->gaji_id == $gaji->id))
                            <option value="{{ $gaji->id }}" selected>{{ $gaji->gaji }}</option>
                        @else
                            <option value="{{ $gaji->id }}">{{ $gaji->gaji }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value=""
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        required>
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a
                        href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and
                        conditions</a>.</label>
            </div>

        </div>

        <button type="submit"
            class="text-white my-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>

    </form>

    <a href="/karyawan" class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
        </svg>
        <span>Back</span>
    </a>

    {{-- <script>
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/karyawan/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script> --}}
@endsection
