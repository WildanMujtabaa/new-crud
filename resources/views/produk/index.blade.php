@extends('layouts.app', ['title' => 'Kelola Produk'])
@section('content')


<div class="mx-32 mt-10">
@if (session()->has('success'))
         <div id="alert-3"
                class="flex items-center p-3 mb-1 text-white rounded-lg bg-green-400 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="text-3xl"><i class="bi bi-check2-circle"></i></span>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-400 text-white rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-800 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @elseif (session()->has('fail'))
            <div id="alert-2" class="flex items-center p-3 mb-1 text-white rounded-lg bg-red-700" role="alert">
                <i class="bi bi-exclamation-triangle-fill text-3xl"></i>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('fail') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-700 text-white rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-800 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif


    <a href="/tambah-produk" class="block w-20 text-center text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Tambah</a>
    <div class="block overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-400">
            <thead class="text-xs uppercas bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3"  style="width: 15%">
                        Nama Produk
                    </th>
                    <th scope="col" class="px-6 py-3" style="width: 40%">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3" style="width: 35%">
                        Gambar
                    </th>
                    <th scope="col" class="px-6 py-3" style="width: 10%">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)  
                <tr class="border-b bg-gray-800 border-gray-700hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                        {{ $product->nama_produk }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->deskripsi }}
                    </td>
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/'. $product->gambar) }}">
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('edit', $product->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('hapus', $product->id) }}"
                            method="POST" class="inline">
                            @method('delete')
                            @csrf
                            <button type="submit"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




@endsection
