@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Автомобілі</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('cars.create') }}" title="Додати авто"> <i class="fas fa-plus-circle"></i>
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
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>

        </tr>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->name }}</td>
                <td>
                    <textarea readonly >
                        {{ $car->description }}
                    </textarea>
                </td>
                <td>
                    @foreach ($car->CarImages as $img)
                        <img src="/storage/files/{{ $img->name }}" width="100px" alt="">
                    @endforeach
                </td>

            </tr>
        @endforeach
    </table>


@endsection
