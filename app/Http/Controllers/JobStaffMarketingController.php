<?php

namespace App\Http\Controllers;

use App\Models\MarketingTask;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Notifications\NewTaskNotification;

class JobStaffMarketingController extends Controller
{
    //
    public function index()
    {
       $tugas = MarketingTask::all();
       $marketingStaff = Employee::whereHas('position', function ($query) {
        $query->where('name', 'Staff Marketing');
       })->get();
       return view('marketing.jobstaffmarketing', compact('tugas', 'marketingStaff'));
    }


public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'nama_tugas' => 'required',
        'deskripsi' => 'nullable',
        'deadline' => 'required|date',
        'status' => 'required|in:Pending,Proses,Selesai',
    ]);

   
    $task = MarketingTask::create([
        'employee_id' => $request->employee_id,
        'nama_tugas' => $request->nama_tugas,
        'deskripsi' => $request->deskripsi,
        'deadline' => $request->deadline,
        'status' => $request->status,
    ]);

   
    $employee = Employee::find($request->employee_id);

    
    if ($employee) {
        $employee->notify(new NewTaskNotification($task));
    }

    return redirect()->route('master.data.tugas-staff-marketing')->with('success', 'Tugas berhasil ditambahkan.');
}
    public function destroy($id)
    {
        $tugas = MarketingTask::findOrFail($id);
        $tugas->delete();

        return redirect()->route('master.data.tugas-staff-marketing')->with('success', 'Tugas berhasil dihapus.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'nama_tugas' => 'required',
            'deskripsi' => 'nullable',
            'deadline' => 'required|date',
            'status' => 'required|in:Pending,Proses,Selesai',
        ]);

        $tugas = MarketingTask::findOrFail($id);
        $tugas->update([
            'employee_id' => $request->employee_id,
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return redirect()->route('master.data.tugas-staff-marketing')->with('success', 'Tugas berhasil diperbarui.');
    }
  public function progress($id)
{
    $task = MarketingTask::with(['employee', 'guest'])->findOrFail($id);
    return view('marketing.progress', compact('task'));
}
}
