<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoListController extends Controller
{
    //
    public function saveItem() {
      return redirect()->route('root')->with('success', 'Item successfully created!');
    }
}
