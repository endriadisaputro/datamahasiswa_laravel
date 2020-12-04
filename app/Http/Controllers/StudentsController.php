<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('cari')){
            $students=\App\Student::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        } else{
            $students=\App\Student::all();
        }
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validasi form
        $this->validate($request, [
            'nama_depan' =>'required|min:5',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpg,jpeg,png'
        ]);
        
        // insert ke table User
        $user=new \App\User;
        $user->role='siswa';
        $user->name=$request->nama_depan;
        $user->email=$request->email;
        $user->password=bcrypt('rahasia');
        $user->remember_token=str_random(60);
        $user->save();

        //insert ke table siswa
        $request->request->add(['user_id' => $user->id]);
        $students=\App\Student::create($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $students->avatar=$request->file('avatar')->getClientOriginalName();
            $students->save();
        }
        
        return redirect('students')->with('sukses', 'Data Berhasil Ditambahkan!!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $students=\App\Student::find($id);
        return view('students.edit', ['students' => $students]);
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
        // dd($request->all());
        $students = \App\Student::find($id);
        $students->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $students->avatar=$request->file('avatar')->getClientOriginalName();
            $students->save();
        }
        return redirect('/students')->with('sukses', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students =\App\Student::find($id);
        $students->delete();
        return redirect('/students')->with('sukses', 'Data Berhasil Dihapus!');
    }

    public function profile($id)
    {
        $students =\App\Student::find($id);
        $matakuliah=\App\Makul::all();

        // Menyiapkan data u chart
        $categories=[];
        $data=[];

        foreach($matakuliah as $mk){
            if($students->makul()->wherePivot('makul_id', $mk->id)->first()){
                $categories[]=$mk->nama;
                $data[]=$students->makul()->wherePivot('makul_id',$mk->id)->first()->pivot->nilai;
                
            }
        }

        return view('students.profile', ['students' => $students, 'matakuliah' => $matakuliah, 'categories'=>$categories,'data'=>$data]);
    }

    public function addnilai(Request $request,$idstudent)
    {
        $students = \App\Student::find($idstudent);
        if($students->makul()->where('makul_id', $request->makul)->exists()){
            return redirect ('students/'.$idstudent.'/profile')->with('error', 'Data Sudah Ada!');    
        }
        $students->makul()->attach($request->makul,['nilai' => $request->nilai]);
        return redirect ('students/'.$idstudent.'/profile')->with('sukses', 'Data Berhasil DiTambahkan!');
    }

    public function deletenilai($idstudent, $idmakul)
    {
        $students=\App\Student::find($idstudent);
        $students->makul()->detach($idmakul);
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus!');
    }

    public function exportExcel() 
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function exportPdf()
    {
        $students=Student::all();
        $pdf=PDF::loadView('export.studentsPdf',['students'=>$students]);
        return $pdf->download('students.pdf');
    }
}
