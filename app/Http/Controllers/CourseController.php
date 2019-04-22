<?php

namespace App\Http\Controllers;
use App\Courses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      // // mengambil data dari table pegawai
      // $pegawai = DB::table('pegawai')->get();
      // $users = DB::table('users')
            // ->join('contacts', 'users.id', '=', 'contacts.user_id')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            // ->select('users.*', 'contacts.phone', 'orders.price')
            // ->get();
      //   // mengirim data pegawai ke view index
      // return view('index',['pegawai' => $pegawai]);
        $courses = Courses::orderBy('id', 'DESC')->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role_id == '1'){
          return redirect()->route('courses.index');
        }
        else{
          return view('courses.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'course_name' => 'required',
            'duration' => 'required',
            'file_upload' => 'required|mimes:docx,doc,pptx,ppt,pdf|max:2000',
        ]);
        $courses = new Courses();
        $courses->course_name = $request['course_name'];
        $courses->duration = $request['duration'];
        $courses->description = $request['description'];
        $courses->user_id = $request['user_id'];

        // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image
        $file       = $request->file('file_upload');
        $fileName   = $file->getClientOriginalName();
        $request->file('file_upload')->move("file_upload/", $fileName);

        $courses->file_upload = $fileName;
        $courses->save();

        // $courses = Courses::create($request->all());

        return redirect()->route('courses.index')->with('message', 'Courses has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courses = Courses::findOrFail($id);
        return view('courses.show', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // // mengambil data pegawai berdasarkan id yang dipilih
      // $pegawai = DB::table('pegawai')->where('pegawai_id',$id)->get();
      // // passing data pegawai yang didapat ke view edit.blade.php
      // return view('edit',['pegawai' => $pegawai]);

        $courses = Courses::findOrFail($id);
        return view('courses.edit', compact('courses'));
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
      // // update data pegawai
      // DB::table('pegawai')->where('pegawai_id',$request->id)->update([
      //   'pegawai_nama' => $request->nama,
      //   'pegawai_jabatan' => $request->jabatan,
      //   'pegawai_umur' => $request->umur,
      //   'pegawai_alamat' => $request->alamat
      // ]);
      // // alihkan halaman ke halaman pegawai
      // return redirect('/pegawai');

        $this->validate($request, [
            'course_name' => 'required',
            'duration' => 'required'
        ]);

        $courses = Courses::findOrFail($id)->update($request->all());

        return redirect()->route('courses.index')->with('message', 'Courses has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // // menghapus data pegawai berdasarkan id yang dipilih
      // DB::table('pegawai')->where('pegawai_id',$id)->delete();
      //
      // // alihkan halaman ke halaman pegawai
      // return redirect('/pegawai');

        $courses = Courses::findOrFail($id)->delete();

        return redirect()->route('courses.index')->with('message', 'Courses has been deleted!');
    }
}
