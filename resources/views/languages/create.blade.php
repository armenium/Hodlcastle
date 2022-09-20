@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Landing</h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                {!! Form::open(['route' => 'languages.store']) !!}
                    @include('languages.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
