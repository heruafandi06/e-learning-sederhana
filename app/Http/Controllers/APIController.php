<?php

namespace App\Http\Controllers;
use App\Courses;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allcourses()
    {
        return Courses::all();
    }
    public function coursesbyid($id)
    {
        return Courses::findOrFail($id);
    }
}
