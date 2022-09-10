@extends('layouts/app-layout')

@section('content')
    <h1 class="text-gray-900 dark:text-white py-4" style="margin:0;">Laravel Todo App</h1>

    <form method="post" action="{{ route('saveItem') }}" accept-charset="utf-8">
      @csrf
      <label class="text-gray-900 dark:text-white" for="listItem">New TodoList Item</label><br />
      <input type="text" name="listItem" /><br />
      <button type="submit">Save</button><br />
    </form>

    <h2 class="text-gray-900 dark:text-white py-4" >Todo Items</h2>
    <ul class="text-gray-900 dark:text-white py-4">
    @foreach ($listItems as $listItem)
      <li class="py-4" style="list-style:none;">
        @if( $listItem->is_complete )
          <span style="color:#00dd00">✓</span>
        @else
          <span style="color:#dd0000">o</span>
        @endif
        {{ $listItem->name }}
        @if( !$listItem->is_complete )
          <form method="post" action="{{ route('markItemAsComplete', $listItem->id) }}" accept-charset="utf-8">
            @csrf
            <button type="submit">Complete list item #{{ $listItem->id }}"</button>
          </form>
        @endif
      </li>
    @endforeach
    </ul>
@endsection
