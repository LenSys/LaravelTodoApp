<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;

class TodoListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the default route "/".
     *
     * @return \Illuminate\View\View The todo list view.
     */
    public function index() {
      // get all list items from database table list_items
      $listItems = ListItem::all();

      // pass the list items to the view and return the rendered view
      return view('todos', ['listItems' => $listItems]);
    }


    /**
     * Marks an list item as complete
     *
     * @param  int    $id The list item id.
     * @return string|null
     */
    public function markItemAsComplete($id) {


      if($id > 0) {
        // use the list item id to mark as complete
        $listItem = ListItem::find($id);
        if($listItem) {
          $listItem->is_complete = 1;
          $listItem->save();
        }
      }

      return redirect()->route('root')->with('success', 'Item successfully completed!');
    }


    /**
     * Save an item passed via request to the save_items table in the database.
     *
     * @param  Request $request The form request
     * @return string|null
     */
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
