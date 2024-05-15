<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaProduk' => 'required|max:255',
            'deskripsi' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,jpg,png',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fail', 'Gagal menambahkan produk baru');
        } else {
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $namaFile = uniqid() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('public/products', $namaFile); // Store the file in the 'public/products' directory
                $fileGambar = $namaFile;
            }


            Product::create([
                'nama_produk' => $request->namaProduk,
                'deskripsi' => $request->deskripsi,
                'gambar' => $fileGambar
            ]);
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
        }


    }

    public function viewIndex()
    {
        $products = Product::all();
        return view('produk.index', compact('products'));
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();


        if (Storage::exists($product->gambar)) {
            Storage::delete($product->gambar);
        }


        $product->delete();


        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
    
    public function viewEdit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('produk.edit', compact('product'));
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namaProduk' => 'required|max:255',
            'deskripsi' => 'required',
            'gambar' => 'file||mimes:jpeg,jpg,png',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fail', 'Gagal mengedit produk');
        } else {
            $product = Product::where('id', $id)->first();


            $fileGambar = null;
            if ($request->hasFile('gambar')) {
                if (Storage::exists($product->gambar)) {
                    Storage::delete($product->gambar);
                }


                $gambar = $request->file('gambar');
                $namaFile = uniqid() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs($namaFile);
                $fileGambar = $namaFile;
            }
            $product->nama_produk = $request->namaProduk;
            $product->deskripsi = $request->deskripsi;
            $product->gambar = $fileGambar;
            $product->update();


            return redirect()->back()->with('success', 'Produk berhasil diubah');
        }
    }



}