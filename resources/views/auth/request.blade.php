@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-4">
                @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

               
            </div>
        </div>
    </div>

     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invitationModal">
        New Invitation
      </button><br>
      <h2 class="text-center">All invitations</h2>
      <hr>

    
    @if ($invitations)
        
    <div class="container">
        <div class="row">
            <table class="table table-dark">
                <thead>
                    <tr>
                    <td>Email</td>   
                    <td>Registered At</td>   
                    <td>Link</td>   
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($invitations as $item)
                        <tr>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->user_registered_at }}</td>
                            <td>{{ urldecode(route('register') . '?invitation_token=' .  $item->invitation_token)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div class="modal fade" id="invitationModal" tabindex="-1" role="dialog" aria-labelledby="invitationModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="invitationModalTitle">Requesting Invitation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card">
                     <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('storeInvitation') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Request An Invitation
                                    </button>

                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        Already Have An Account?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

@endsection