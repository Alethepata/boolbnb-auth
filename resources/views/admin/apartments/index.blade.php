@extends('layouts.admin')

@section('content')
    <div class="index w-100 p-5">
        <a class="btn btn-dark" href="#"><i class="fa-solid fa-plus"></i> ADD NEW
            PROJECT</a>
        <h1><i class="fa-solid fa-diagram-project"></i> Projects List</h1>
        <table class="table w-100">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->id }}</td>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->address }}</td>
                        {{-- <td>
                            <a class="btn btn-dark" href="{{ route('admin.projects.show', $project) }}"><i
                                    class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                            <a class="btn btn-dark" href="{{ route('admin.projects.edit', $project) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form class="d-inline-block" action="{{ route('admin.projects.destroy', $project) }}"
                                method="POST" onsubmit="return confirm ('Are you sure DELETE this Project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
