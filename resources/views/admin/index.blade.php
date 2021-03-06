@extends('layouts.app')
@section('content')
    
        <h2 class="text-center">All Users</h2><hr>
       <div class="container">
           <div class="row">
               <table class="table table-dark">
                   <thead>
                        <tr>
                            <td>Username</td>
                            <td>Email</td>
                            <td>Status</td>
                        </tr>
                   </thead>
                   <tbody>
                       @foreach ($users as $user)
                           <tr>
                               <td>{{ $user->name }}</td>
                               <td>{{ $user->email }}</td>
                               <td>{{ $user->status }}</td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>

           </div>
       </div>

@endsection