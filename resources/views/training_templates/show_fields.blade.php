<?php
use Carbon\Carbon;
?>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('id', 'ID:') !!}</div>
    <div class="col-sm-10">{!! $template->id !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('created_at', 'Created At:') !!}</div>
    <div class="col-sm-10">{!! Carbon::parse($template->created_at)->format('Y-m-d / H:i') !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('updated_at', 'Updated At:') !!}</div>
    <div class="col-sm-10">{!! Carbon::parse($template->updated_at)->format('Y-m-d / H:i') !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('is_public', 'Is Public:') !!}</div>
    <div class="col-sm-10">{!! $template->is_public ? 'Yes' : 'No' !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('name', 'Name:') !!}</div>
    <div class="col-sm-10">{!! $template->name !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('language_id', 'Language:') !!}</div>
    <div class="col-sm-10">{!! $template->language->name !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('company_id', 'Company:') !!}</div>
    <div class="col-sm-10">{!! @$template->company->name !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('module_id', 'Module:') !!}</div>
    <div class="col-sm-10">{!! $template->module->name !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('type_id', 'Notification type:') !!}</div>
    <div class="col-sm-10">{!! $template->type() !!}</div>
</div>
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('subject', 'Subject:') !!}</div>
    <div class="col-sm-10">{!! $template->subject !!}</div>
</div>
{{--
@if(isset($template) && $template->image)
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('image', 'Image:') !!}</div>
    <div class="col-sm-10">
        <img src="{!! $template->image->crop(50, 50, true) !!}" alt="" />
    </div>
</div>
@endif
--}}
<div class="row">
    <div class="col-sm-2 text-right">{!! Form::label('content', 'Content:') !!}</div>
    <div class="col-sm-10"><iframe src="{!! route('traningNotifyTemplates.preview', $template->id) !!}" frameborder="1" sandbox="allow-same-origin" allowfullscreen="" scrolling="auto" width="100%" height="600"></iframe></div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group">
            {!! Form::open(['route' => ['traningNotifyTemplates.destroy', $template->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{!! route('traningNotifyTemplates.index') !!}" class="btn btn-default"><i class="fa fa-caret-left"></i> Back</a>
                <a href="{!! route('traningNotifyTemplates.edit', $template->id) !!}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                <a href="{!! route('traningNotifyTemplates.preview', $template->id) !!}" class="btn btn-info" target="_blank"><i class="fa fa-link"></i> Open in New tab</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

