@extends('layouts.app')

@section('main-styles')
    <link href="{{asset('intro/introjs.min.css')}}" rel="stylesheet">
@endsection

@section('help')
    <a href="javascript:void(0);" class="pull-right" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i></a>
@endsection

@section('main-section')
    <div class="panel panel-default"   data-step="1" data-intro="Panel for adding repositories" data-position='right'>
        <div class="panel-heading">
            <h4 class="panel-title">Add New Repository</h4>
        </div>
        <div class="col-md-12 container mt10">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
        <form action="{{route('repositories.store')}}" method="post">
            @csrf
            {{method_field('POST')}}
            <div class="panel-body">
                <div class="row ">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Repository Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control"    data-step="2" data-intro="Type the name of the repository for which you wish to create" data-position='right'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer ">
                <button class="btn btn-primary"     data-step="3" data-intro="Click the button to create your repository" data-position='right'>Create</button>
                <a href="{{route('repositories.index')}}" class="btn btn-warning">Back</a>
            </div>
        </form>
    </div>
@endsection

@section('custom-scripts')
    <script src="{{asset('intro/intro.min.js')}}"></script>
@endsection


