<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ListItem;
use Illuminate\Http\Request;

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
      // get the current user id
      $userId = auth()->user()->id;
      $user = User::find($userId);
      $listItems = [];
      
      if($user) {
        // get all list items of the current user from database table list_items
        $listItems = $user->listItems;
      }

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

      // get the current user id
      $userId = auth()->user()->id;

      // check if list item has been filled out in form
      if($request->listItem !== null) {
        // save new list item in database table
        $listItem = new ListItem();
        $listItem->name = $request->listItem;
        $listItem->is_complete = 0;
        $listItem->user_id = $userId;
        $listItem->save();
      }

      return redirect()->route('root')->with('success', 'Item successfully created!');
    }
}
