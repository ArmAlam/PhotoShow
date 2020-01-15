@extends('layouts.app')

@section('content')
    <h3>Create Album</h3>
    {!!Form::open([ 'action' => 'AlbumsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{ Form::text('name', '', ['placeholder' => 'Album Name' ])}}
    {{ Form::textarea('description', '', ['placeholder' => 'Album Desctiption' ])}}
    {{ Form::file('cover_image') }}
    {{ Form::submit('Submit') }}
    {!! Form::close() !!}
@endsection