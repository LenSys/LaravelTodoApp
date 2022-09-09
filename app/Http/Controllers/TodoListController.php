<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;

class TodoListController extends Controller
{
    //
    public function saveItem(Request $request) {

      // check if list item has been filled out in form
      if($request->listItem !== null) {
        // save new list item in database table
        $listItem = new ListItem();
        $listItem->name = $request->listItem;
        $listItem->is_complete = 0;
        $listItem->save();
      }

      return redirect()->route('root')->with('success', 'Item successfully created!');
    }
}
