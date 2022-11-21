@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Landing Template</h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'landingTemplates.store', 'files' => true]) !!}

                    @include('landing_templates.fields', ['mode' => 'create'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
