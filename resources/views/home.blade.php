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

        <div class="row" data-step="1" data-intro="This is a list of all the repositories that you have access too." data-position='right'>
            <div class="col-sm-12">
                <div class="row filemanager">

                    @foreach($get_repos as $g)
                        <div class="col-xs-6 col-sm-4 col-md-3 document" data-step="2" data-intro="To navigate to a particular repository click on the name of the repository" data-position='right'>
                            <div class="thmb">
                                <div class="btn-group fm-group" style="display: none;">
                                </div><!-- btn-group -->
                                <div class="thmb-prev">
                                    <img src="{{asset('images/photos/media-doc.png')}}" class="img-responsive" alt="">
                                </div>
                                <h2 class="fm-title text-bold"  data-step="3" data-intro="Click on file name to navigate to repository" data-position='right'><a href="{{route('repository_files' , ['id' => $g->id])}}">{{$g->name}}</a></h2>
                                <small class="text-muted text-center">Added: {{$g->created_at}}</small>
                            </div><!-- thmb -->
                        </div><!-- col-xs-6 -->
                    @endforeach

                </div><!-- row -->
            </div><!-- col-sm-9 -->
        </div>
    </div>

@endsection


@section('custom-scripts')
    <script src="{{asset('intro/intro.min.js')}}"></script>
@endsection





