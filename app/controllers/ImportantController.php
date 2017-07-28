<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 05.06.2017
 * Time: 11:13 ч.
 */

namespace app\controllers;


use app\models\Important;

class ImportantController
{
    private $important;

    public function __construct()
    {
        $this->important = new Important();
    }

    public function index()
    {
        $all_documents = $this->important->getAllDocuments();
        return view('admin/important', compact('all_documents','path'));
    }

    public function newDocument()
    {

       $this->important->newDocument();
    }
}