@extends('layouts.client')
@section('content')
    
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Inforation') }}</div>
                <div class="card-body text-center">
                    @if (auth()->user()->avatar)
                    <img class="rounded-circle" src="/storage/avatars/{{ auth()->user()->avatar }}" /><br><br>
                        
                    @endif

                    <h5>Name:  {{ auth()->user()->name }}</h5>                    
                    <h5>Email:  {{ auth()->user()->email }}</h5><br>
                    <div class="form-contaienr">         
                    <h4>Upload Avatar</h4>
                    <form action="{{ route('upload-avatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            <input type="hidden" name="userid" value={{ auth()->user()->id }}>
                            <input type="file" name="avatar" class="form-control"> <br>   
                            <input type="submit" value="Upload" class="btn btn-primary">
                        </div>   
                    </form>    
                </div>       
                </div>
            </div>
        </div>
    </div>
</div>


@endsection