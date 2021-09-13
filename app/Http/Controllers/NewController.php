<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Validator;
use Storage;
use Illuminate\Support\Facades\Gate;


class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('hak-berita')) return $next($request);
            abort(403);
        });
    }

    public function index(Request $request)
    {
        $filter = $request->get('keyword'); //keyword pengguna
        $filterCategory = $request->get('category_id'); //keyword pengguna
        $data['news'] = News::paginate(5);
        if ($filter) {
            $data['news'] = News::where('title', 'LIKE', "%$filter%")
                ->paginate(5);
        }
        return view('news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::all();
        $data['users'] = User::where('fungsi', 'kolumnis')->get();
        return view('news.create', $data);
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
            'author' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'url' => 'required|max:255',
            'urlToImage' => 'required|max:255',
            'publishedAt' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        News::create($input);

        return redirect()->route('news.index')->with('status', 'Berita berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['news'] = News::findOrFail($id);

        return view('news.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['news'] = News::findOrFail($id);
        $data['category'] = Category::all();
        $data['users'] = User::where('fungsi', 'kolumnis')->get();


        return view('news.edit', $data);
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
        $dataNews = News::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'author' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'url' => 'required|max:255',
            'urlToImage' => 'required|max:255',
            'publishedAt' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();

        $dataNews->update($input);

        return redirect()->route('news.index')->with('status', 'Berita berhasil di Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataNews = News::findOrFail($id);
        $dataNews->delete();
        return redirect()->back()->with('status', 'Berita Berhasil di Delete ke Recycle');
    }

    public function recycle()
    {
        $data['news'] = News::onlyTrashed()->paginate(5); //menampilkan yg sudah dihapus ke onlyTrashed
        return view('news.recycle', $data);
    }

    public function restore($id)
    {
        $news = News::withTrashed()->findOrFail($id); //pick data yg d trash
        if ($news->trashed()) {
            $news->restore();
        } else {
            return redirect()->route('news.index')->with('status', 'Berita tidak ada di dalam recycle');
        }

        return redirect()->route('news.index')->with('status', 'Berita sukses dikembalikan');
    }

    public function delete($id)
    {
        $news = News::withTrashed()->findOrFail($id);
        if (!$news->trashed()) { //cek kategori tidak ada dalam recycle
            return redirect()->route('news.index')->with('status', 'Tidak bisa hapus permanen Berita');
        } else {
            $news->forceDelete();
            return redirect()->route('news.index')->with('status', 'Berita berhasil didelete permanen');
        }
    }
}
