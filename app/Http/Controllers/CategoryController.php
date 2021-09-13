<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use PhpParser\Node\Stmt\Return_;
use Validator;
use Storage;
use Illuminate\Support\Facades\Gate;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('hak-kategori')) return $next($request);
            abort(403);
        });
    }

    public function index()
    {
        $data['category'] = Category::paginate(5); //menangkap data
        return view('category.index', $data); //view dgn pass data category
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'picture' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]); //menyimpan hasil validasi

        //cek ada yg salah
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        //menangkap sluruh inputan
        $input = $request->all();

        //validasi pict
        if ($request->file('picture')->isValid()) {
            $pictureFile = $request->file('picture');
            $extention = $pictureFile->getClientOriginalExtension();
            $fileName = "category/" . date('YmdHis') . "." . $extention;
            $uploadPath = env('UPLOAD_PATH') . "/category";
            $request->file('picture')->move($uploadPath, $fileName);
            $input['picture'] = $fileName;
        }

        //insert data
        Category::create($input);
        return redirect()->route('category.index')->with('status', 'Kategori berhasil di tambahkan');
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
        $data['category'] = Category::findOrFail($id);
        return view('category.edit', $data);
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
        $dataCategory = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'picture' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]); //menyimpan hasil validasi

        //cek ada yg salah
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all(); //menangkap seluruh input
        if ($request->hasFile('picture')) //cek foto diupdate apa tdk
        {
            if ($request->file('picture')->isValid()) { //jika valid maka akan diganti pda storage n di apus
                Storage::disk('upload')->delete($dataCategory->picture);
                $pictureFile = $request->file('picture');
                $extention = $pictureFile->getClientOriginalExtension();
                $fileName = "category/" . date('YmdHis') . "." . $extention;
                $uploadPath = env('UPLOAD_PATH') . "/category";
                $request->file('picture')->move($uploadPath, $fileName);
                $input['picture'] = $fileName;
            }
        }

        $dataCategory->update($input);
        return redirect()->route('category.index')->with('status', 'Kategori Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataCategory = Category::findOrFail($id);
        $dataCategory->delete();
        return redirect()->back()->with('status', 'Kategori Berhasil di Delete ke Recycle');
    }


    public function recycle()
    {
        $data['category'] = Category::onlyTrashed()->paginate(5); //menampilkan yg sudah dihapus ke onlyTrashed
        return view('category.recycle', $data);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id); //pick data yg d trash
        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route('category.index')->with('status', 'Kategori tidak ada di dalam recycle');
        }

        return redirect()->route('category.index')->with('status', 'Kategori sukses dikembalikan');
    }

    public function delete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if (!$category->trashed()) { //cek kategori tidak ada dalam recycle
            return redirect()->route('category.index')->with('status', 'Tidak bisa hapus permanen kategori');
        } else {
            $category->forceDelete();
            Storage::disk('upload')->delete($category->picture);
            return redirect()->route('category.index')->with('status', 'Kategori berhasil didelete permanen');
        }
    }
}
