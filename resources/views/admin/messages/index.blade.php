@extends('layouts.admin')
@section('content')
<h1>Messagi</h1>

<table class="table">
    <thead>
      <tr>
        <th scope="col">Email</th>
        <th scope="col">Data</th>
        <th scope="col">In riferimento a</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message)
            <tr>
                <td>{{$message->email}}</td>
                <td>{{$date}}</td>
                <td>{{$message->apartment->title}}</td>
                <td>
                    <a class="btn btn-dark" href="{{route('admin.messages.show', $message)}}"><i
                        class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>



@endsection
