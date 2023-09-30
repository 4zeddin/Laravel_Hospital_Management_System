<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class AdminController extends Controller
{
    public function add()
    {
        return view('admin.add_doctor');
    }
    public function upload(Request $request)
    {
        // Validate the form data
        // Handle the uploaded file (e.g., store it in a storage directory)
        $image = $request->file('file');
        $imagename = time() . '.' . $image->getClientoriginalExtension();
        $request->file->move('doctors_img', $imagename);

        // Create a Doctor model instance and save it to the database
        $doctor = new Doctor([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'speciality' => $request->input('speciality'),
            'image' => $imagename, // Store the file name in the database
        ]);

        $doctor->save();

        // Redirect to a success page or perform any other actions as needed
        return redirect()->back();
    }
}
