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
                            <td>Current Status</td>
                            <td>Enable/Disable</td> 
                            <td>Avatar</td> 
                        </tr>
                   </thead>
                   <tbody>
                       @foreach ($users as $user)
                           <tr>
                               <td>{{ $user->name }}</td>
                               <td>{{ $user->email }}</td>
                               <td><?=($user->status=='A') ? 'Enabled':'Disabled';?></td>
                               <td>
                                @if ($user->status == 'A')
                                <form action="{{ route('disable') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <input type="submit" value="Disbale" class="btn btn-danger">
                                </form>
                                    
                                @else
                                <form action="{{ route('enable') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <input type="submit" value="Enable" class="btn btn-success">
                                </form>
                                @endif

                        </td>
                        <td>
                            @if ($user->admin_avatar)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#avatarModal{{ $user->id }}">
                               View Avatar
                              </button>
                              
                               
                            @else
                                Avatar Not Found
                            @endif
                        </td>
                           </tr>

                           <div class="modal fade" id="avatarModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                 
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img class="rounded-circle" src="/storage/avatars/{{ $user->admin_avatar }}" />
                                </div>
                               
                              </div>
                            </div>
                          </div>
                       @endforeach
                   </tbody>
               </table>

           </div>
       </div>

@endsection