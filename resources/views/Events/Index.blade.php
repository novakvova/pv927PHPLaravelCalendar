@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('events.create') }}" title="Create a project"> <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Date Created</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($events as $event)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->description }}</td>
                <td>
                    <img src="images/{{ $event->image }}" alt="" width="150">
                    </td>
                <td>{{ date_format($event->created_at, 'jS M Y') }}</td>
                <td>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">

                        <a href="{{ route('events.show', $event->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('events.edit', $event->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $events->links() !!}

@endsection
