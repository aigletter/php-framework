<?php


namespace App\Controllers;


class Page
{
    public function index()
    {
        echo 'Index method Page controller';
    }

    public function create()
    {
        echo 'Create method Page controller';
    }

    public function show($id)
    {
        echo 'Showing page with id ' . $id;
    }
}