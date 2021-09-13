<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('hak-users')) return $next($request);
            abort(403);
        });
    }


    public function index(Request $request)
    {
        $filter = $request->get('keyword'); //keyword pengguna
        $data['users'] = User::paginate(5); //menganmbil data 5/pages
        if ($filter) {
            $data['users'] = User::where('name', 'LIKE', "%$filter%")
                ->paginate(5);
        }
        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ //mengecek validasi tiap data
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'name' => 'required|max:255',
            'fungsi' => 'required',
            'kelamin' => 'required',
            'nomer' => 'required|digits_between:10,12',
            'alamat' => 'required|max:255',
            'picture' => 'required|image|mimes:jpeg,jpg,png|max:2048'

        ]); //menyimpan hasil validasi inputan user

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); //jika salah/kosong ada error
        }

        //untuk bagian upload gambar
        $input = $request->all();
        if ($request->file('picture')->isValid()) { //jika gbr benar maka
            $pictureFIle = $request->file('picture'); //input berupa gmbr
            $extention = $pictureFIle->getClientOriginalExtension(); //menampilkan sesuai extention gmbr
            $fileName = "user-picture/" . date('YmdHis') . "." . $extention; //format name gmbr
            $uploadPath = env('UPLOAD_PATH') . "/user-picture"; //tempat simpan gmbr
            $request->file('picture')->move($uploadPath, $fileName); //pindah sesuai tmpt n nama
            $input['picture'] = $fileName; //gmbr sesuai nama
        }

        //bagian passwor input
        $input['password'] = \Hash::make($request->get('password')); //memberikan kode hash unik ke inputan
        User::create($input);
        return redirect()->route('users.index')->with('status', 'User Berhasil di tambahkan'); //sukses kembali k index
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['users'] = User::findOrFail($id); //menangkap data model user sesuai id yg dipilih
        return view('users.edit', $data); //tmpil form edit sesuai data yg ada
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
        $dataUser = User::findOrFail($id); //menangkap data model user sesuai id yg dipilih
        $validator = Validator::make($request->all(), [ //mengecek validasi tiap data
            'name' => 'required|max:255',
            'fungsi' => 'required',
            'kelamin' => 'required',
            'nomer' => 'required|digits_between:10,12',
            'alamat' => 'required|max:255',
            'picture' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'

        ]); //menyimpan hasil validasi inputan user

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator); //jika salah/kosong ada error
        }

        $input = $request->all(); //menangkap seluruh input
        if ($request->hasFile('picture')) //cek foto diupdate apa tdk
        {
            if ($request->file('picture')->isValid()) { //jika valid maka akan diganti pda storage n di apus
                Storage::disk('upload')->delete($dataUser->picture);
                $pictureFile = $request->file('picture');
                $extention = $pictureFile->getClientOriginalExtension();
                $fileName = "user-picture/" . date('YmdHis') . "." . $extention;
                $uploadPath = env('UPLOAD_PATH') . "/user-picture";
                $request->file('picture')->move($uploadPath, $fileName);
                $input['picture'] = $fileName;
            }
        }
        if ($request->input('picture')) {

            $input['password'] = \Hash::make($input('password'));
        } else {
            $input = Arr::except($input, ['password']);
        }
        $dataUser->update($input);
        return redirect()->route('users.index')->with('status', 'User Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function destroy($id)
    {
        $dataUser = User::findOrFail($id);
        $dataUser->delete();
        Storage::disk('upload')->delete($dataUser->picture);
        return redirect()->back()->with('status', 'User Berhasil di Delete');
    }
}
