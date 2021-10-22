<?php


namespace App\Controllers;


class Product
{
    public function view($id, $name = null)
    {
        echo 'Product class view method with params: id ' . $id . ', name ' . $name;
    }
}