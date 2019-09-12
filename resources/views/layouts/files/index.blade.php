@extends('layouts.app')

@section('main-styles')
    <link href="{{asset('css/jquery.datatables.css')}}" rel="stylesheet">
    <link href="{{asset('intro/introjs.min.css')}}" rel="stylesheet">
@endsection

@section('help')
    <a href="javascript:void(0);" class="pull-right" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i></a>
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

            <div class="col-md-4"  data-step="1" data-intro="The search panel is used to filter for files based on their policy number" data-position='right'>
                <form action="{{route('search_files' , ['id' => $repository->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <h4 class="subtitle mb5">Search</h4>
                        <input type="text"  id="search" name="policy_number" placeholder="Policy Number" class="form-control" data-step="2" data-intro="Use the box to enter the policy number then after click on the search button" data-position='right'>
                        <div class="mb20"></div>
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Search"  data-step="3" data-intro="Once you have typed the policy number on the search box you can click on the search button to be navigated to your search results" data-position='right'>
                        </div>
                        <br>
                </form>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default"   data-step="4" data-intro="The files upload panel is used for upload and managing files" data-position='right'>
                    <div class="panel-heading">
                        @can('files.create' , \Illuminate\Support\Facades\Auth::user() )
                            <a href="{{route('repository_upload' , ['id' => $repository->id])}}" class="btn btn-primary btn-block"    data-step="5" data-intro="The files upload used navigates you to the upload files page" data-position='right'>Upload Files</a>
                        @endcan
                    </div><!-- panel-heading -->
                    <div class="panel-body"    data-step="6" data-intro="This panel lists all the files that have been uploaded to the repository" data-position='right'>
                        <div class="results-list">

                            @foreach($files as $f)
                                <div class="media" >
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

                                               data-step="7" data-intro="The delete button is used to remove files from the repository" data-position='right'

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
            <div class="col-md-4" data-step="8" data-intro="The notes pane is used for capturing all the notes regarding the repository" data-position='right'>
                <div class="panel panel-dark panel-alt timeline-post">
                    <form action="{{route('store_notes' , [ 'id' => $repository->id])}}" method="post">
                        @csrf
                        <div class="panel-body">
                            <textarea placeholder="Post Notes...." name="notes" class="form-control" data-step="9" data-intro="The text area is used to write the notes" data-position='right'></textarea>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary pull-left" data-step="9" data-intro="Once notes have been captured click on the submit notes button to save them" data-position='right'>Submit Notes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8">

                @foreach($notes as $n)
                    @if( ($notes_count < 1) )
                        <h3>No notes posted</h3>
                        @else
                            <div class="blog-item blog-quote" data-step="10" data-intro="Captured notes will show up here" data-position='right'>
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



@section('custom-scripts')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="{{asset('intro/intro.min.js')}}"></script>

    <script type="text/javascript">
        var route = "{{ url('autocomplete') }}";
        $('#search').typeahead({
            source:  function (term, process) {
                return $.get(route, { term: term }, function (data) {
                    return process(data);
                });
            }
        });
    </script>



{{--    <script type="text/javascript">--}}
{{--        var path = "{{ route('autocomplete') }}";--}}
{{--        $('input.typeahead').typeahead({--}}
{{--            source:  function (query, process) {--}}
{{--                return $.get(path, { query: query }, function (data) {--}}
{{--                    return process(data);--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

@endsection


