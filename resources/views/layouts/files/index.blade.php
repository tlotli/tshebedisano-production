@extends('layouts.app')

@section('main-styles')
    <link href="{{asset('css/jquery.datatables.css')}}" rel="stylesheet">
@endsection

@section('main-section')
    <div class="contentpanel">

        <div class="row">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div class="col-md-4">
                <form action="{{route('search_files' , ['id' => $repository->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <h4 class="subtitle mb5">Search</h4>
                        <input type="text" value="" name="policy_number" placeholder="Policy Number" class="form-control">
                        <div class="mb20"></div>
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Search">
                        </div>
                        <br>
                </form>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @can('files.create' , \Illuminate\Support\Facades\Auth::user() )
                            <a href="{{route('repository_upload' , ['id' => $repository->id])}}" class="btn btn-primary btn-block">Upload Files</a>
                        @endcan
                    </div><!-- panel-heading -->
                    <div class="panel-body">
                        <div class="results-list">

                            @foreach($files as $f)
                                <div class="media">
                                    <a href="{{ Storage::disk('local')->url('public/documents/'.$f->location) }}" class="pull-left">
                                        {{--<img alt="" src="{{asset('images/photos/media-doc.png')}}" class="media-object">--}}
                                        <i class="fa fa-file-pdf-o" style="font-size: 30px; color : red"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="filename text-primary"><a href="{{ Storage::disk('local')->url('public/documents/'.$f->location) }}">{{$f->name}}</a></h4>
                                        {{--<small class="text-muted">Type: JPG Image</small><br>--}}
                                        <small class="text-muted">Policy Number: {{$f->policy_number}}</small><br>
                                        <small class="text-muted">Created: {{$f->created_at}}</small><br>
                                        <small class="text-muted">Modified: {{$f->updated_at}}</small>


                                        <form id="delete-document-{{$f->id}}" method="post" action="{{route('remove_file' , ['id' => $f->id])}}" style="display: none">
                                            {{csrf_field()}}
                                        </form>


                                        @can('files.delete' , \Illuminate\Support\Facades\Auth::user() )
                                            <a href="" class="pull-right" style="color:red"
                                               onclick="if(confirm('Are you sure you want to delete document ?')) {
                                                       event.preventDefault(); document.getElementById('delete-document-{{$f->id}}').submit();
                                                       }
                                                       else{event.preventDefault();
                                                       }"
                                            ><i class="fa fa-trash-o"></i>
                                            </a>
                                        @endcan


                                    </div>
                                </div>
                            @endforeach
                        </div><!-- results-list -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div>

        </div><!-- row -->


        <div class="row" style="margin-top: 20px">
            <div class="col-md-4">
                <div class="panel panel-dark panel-alt timeline-post">
                    <form action="{{route('store_notes' , [ 'id' => $repository->id])}}" method="post">
                        @csrf
                        <div class="panel-body">
                            <textarea placeholder="Post Notes...." name="notes" class="form-control"></textarea>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary pull-left">Submit Notes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8">

                @foreach($notes as $n)
                    @if( ($notes_count < 1) )
                        <h3>No notes posted</h3>
                        @else
                            <div class="blog-item blog-quote">
                                <div class="quote quote-primary">
                                    <a href="">
                                        {{$n->notes}}
                                        <small class="quote-author">- {{$n->user->firstname . ' ' . $n->user->lastname}}</small>
                                    </a>
                                </div>
                                <div class="blog-details">
                                    <ul class="blog-meta">
                                        <li>Submitted: <a href="">{{$n->created_at->diffForHumans()}}</a></li>
                                    </ul>
                                </div><!-- blog-details -->
                            </div>
                    @endif
                @endforeach


            </div>
        </div>
    </div>
@endsection





