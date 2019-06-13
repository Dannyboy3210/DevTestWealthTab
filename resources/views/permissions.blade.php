@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Permissions</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <label for="pdf[]">Users with Permission:</label><br>
                        @if(isset($users) && count($users) > 0)
                            <ul class="list-group">
                                @if(count($users) > 1)
                                    @foreach($users as $user)
                                        <li class="list-group-item " id="user-{{$user->user}}">
                                            <input type="hidden" name="currentPerms[]" value="{{$user->name}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="pull-left">
                                                        {{$user->name}}
                                                    </div>
                                                    <div class="pull-right">
                                                        {{$user->email}}
                                                    </div>
                                                    <div class="pull-right">
                                                        <form method="POST" action="{{ route('removePerm', ['$userID'=>$user->id, 'pdfID'=>$pdf]) }}" aria-label="{{ __('removePerm') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Remove Permission') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="row">
                                    <div class="col-12">
                                        <div class="pull-left">
                                            {{$users[0]->name}}
                                        </div>
                                        <div class="pull-right">
                                            {{$users[0]->email}}
                                        </div>
                                        <div class="pull-right">
                                        <form method="POST" action="{{ route('removePerm', ['$userID'=>$users[0]->id, 'pdfID'=>$pdf]) }}" aria-label="{{ __('removePerm') }}" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Remove Permission') }}
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                @endif

                            </ul>
                        @else
                            <h3>No Users with permission.</h3>
                        @endif
                </div>

				<div class="card-body">
                    <form method="POST" action="{{ route('managePerm') }}" aria-label="{{ __('managePerm') }}" enctype="multipart/form-data">
                        @csrf
				        <input type="hidden" name="users" value="{{$users}}">
                        <input type="hidden" name="id" value="{{$pdf}}">
						<div class="form-group row">
                            Enter email of user to give permission: <input type="text" name="email">
						</div>
                        
						<div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Permission') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
				
            </div>
        </div>
    </div>
</div>
@endsection
