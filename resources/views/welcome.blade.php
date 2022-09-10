@extends('layouts/app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Welcome') }}</div>

        <div class="card-body text-center">
          <form method="post" action="{{ route('saveItem') }}" accept-charset="utf-8">
            @csrf
            <label class="text-gray-900 dark:text-white" for="listItem">New TodoList Item</label><br />
            <input type="text" name="listItem" />
            <button type="submit" class="btn btn-primary">Save</button><br />
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
                  <button type="submit" class="btn btn-success">Complete list item #{{ $listItem->id }}"</button>
                </form>
              @endif
            </li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
