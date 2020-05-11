<?php
//namespace App\Controllers;

use App\Core\App;

class PagesController
{

    public function home()
    {

        return view('index');

    }

    public function important()
    {

        return view('important');

    }

    public function login()
    {

        return view('login');

    }

    public function signup()
    {

        return view('signup');

    }


    /**
     * @return mixed
     */
    public function departments()
    {
        $departments = App::get('database')->selectAll('departments');

        return view('documents', compact('departments'));

    }

    public function show($id)
    {
        $department = App::get('database')->selectOne('departments', $id);

        return view('documents', compact('department'));

    }

    public function about()
    {

        return view('about');

    }

    public function about_culture()
    {

        return view('about-culture');

    }

    public function contact()
    {
        $company = 'Laracasts';

        return view('contact',compact('company'));

    }

    public function test()
    {

        return view('test');

    }


}