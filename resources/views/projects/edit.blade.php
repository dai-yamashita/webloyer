@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Project</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['route' => ['projects.update', $project->id], 'method' => 'put', 'role' => 'form','class' => 'form-horizontal']) !!}
                        <div class="form-group required">
                            <label for="name" class="col-md-4 control-label">Project Name</label>
                            <div class="col-md-6">
                                {!! Form::text('name', $project->name, ['class' => 'form-control', 'id' => 'name']) !!}
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="recipe_id" class="col-md-4 control-label">Recipe</label>
                            <div class="col-md-6">
                                {!! Form::select('recipe_id[]', $recipes, $projectRecipe, ['class' => 'form-control multi-select', 'id' => 'recipe_id', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="server_id" class="col-md-4 control-label">Server</label>
                            <div class="col-md-6">
                                {!! Form::select('server_id', $servers, $project->server_id, ['class' => 'form-control', 'id' => 'server_id']) !!}
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="repository" class="col-md-4 control-label">Repository URL</label>
                            <div class="col-md-6">
                                {!! Form::text('repository', $project->repository, ['class' => 'form-control', 'id' => 'repository']) !!}
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="stage" class="col-md-4 control-label">Stage</label>
                            <div class="col-md-6">
                                {!! Form::text('stage', $project->stage, ['class' => 'form-control', 'id' => 'stage']) !!}
                            </div>
                        </div>
                        <hr>
                        <h5>Overriding Server Definition</h5>
                        <div class="form-group">
                            <label for="deploy_path" class="col-md-4 control-label">Deploy Path</label>
                            <div class="col-md-6">
                                @if (!is_null ($project->getProjectAttributeByName('deploy_path')))
                                    {!! Form::text('deploy_path', $project->getProjectAttributeByName('deploy_path')->value, ['class' => 'form-control', 'id' => 'deploy_path']) !!}
                                @else
                                    {!! Form::text('deploy_path', null, ['class' => 'form-control', 'id' => 'deploy_path']) !!}
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h5>E-Mail Notification</h5>
                        <div class="form-group">
                            <label for="email_notification_recipient" class="col-md-4 control-label">Recipient</label>
                            <div class="col-md-6">
                                {!! Form::email('email_notification_recipient', $project->email_notification_recipient, ['class' => 'form-control', 'id' => 'email_notification_recipient']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! link_to_route('projects.index', 'Cancel', [], ['class' => 'btn btn-danger']) !!}
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::hidden('recipe_id_order', implode(',', $projectRecipe), ['id' => 'recipe_id_order']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
