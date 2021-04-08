<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\Tags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Products::paginate(10);
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $category = Category::all();
        return view('admin.product.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'category_id' => 'required',
            'gambar' => 'required|image|mimes:png,jpg|max:1024',
            'description' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $product = Products::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'gambar' => 'public/uploads/'. $new_gambar,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price,
            'discount' => $request->discount,
            'slug' => Str::slug($request->name),
            'users_id' => Auth::id()
        ]);

        $product->tags()->attach($request->tags);

        $gambar->move('public/uploads/', $new_gambar);
        return redirect()->back()->with('success', 'Produk anda berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $tags = Tags::all();
        $product = Products::findOrFail($id);
        return view('admin.product.edit', compact('product', 'tags', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);    

        $product = Products::findOrFail($id);

        if($request->has('gambar')){
            $gambar = $request->gambar;
            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move('public/uploads/', $new_gambar);

            $product_data =[
                'name' => $request->name,
                'category_id' => $request->category_id,
                'gambar' => 'public/uploads/'. $new_gambar,
                'description' => $request->description,
                'qty' => $request->qty,
                'price' => $request->price,
                'discount' => $request->discount,
                'slug' => Str::slug($request->name),
            ];
        }
        else{
            $product_data =[
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'qty' => $request->qty,
                'price' => $request->price,
                'discount' => $request->discount,
                'slug' => Str::slug($request->name),
            ]; 
        }   

        $product->tags()->sync($request->tags);
        $product->update($product_data);

        return redirect()->route('product.index')->with('success', 'Produk anda berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus (Silahkan cek trashed produk)');
    }

    public function tampil_hapus()
    {
        $product = Products::onlyTrashed()->paginate(10);
        return view('admin.product.hapus', compact('product'));
    }

    public function restore($id)
    {
        $product = Products::withTrashed()->where('id', $id)->first();
        $product->restore();
        return redirect()->back()->with('success', 'Produk berhasil direstore (Silahkan cek list product)');
    }

    public function kill($id)
    {
        $product = Products::withTrashed()->where('id', $id)->first();
        $product->forceDelete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus secara permanent');
    }
}
