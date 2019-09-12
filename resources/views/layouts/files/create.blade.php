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
        <div class="row"   data-step="1" data-intro="Use this panel to upload your files" data-position='right'>
            <div class="col-md-12" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Upload Files</h4>
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

                    <form method="post" enctype="multipart/form-data" action="{{route('repository_post' , ['id' => $repository->id])}}">
                        @csrf
                        <div class="panel-body">
                            <div class="row row-pad-5"   data-step="2" data-intro="Use text box to capture the policy number of the documents that you intend to upload" data-position='right'>
                                <div class="col-lg-10">
                                    <input type="text" name="policy_id" placeholder="Policy Number " class="form-control" value="{{old('policy_id')}}">
                                </div>
                            </div><!-- row -->

                            <div class="row row-pad-5"   data-step="3" data-intro="Click on the button to select files you wish to upload" data-position='right'>
                                <div class="col-lg-10">
                                    <input type="file" name="documents[]" placeholder="File" class="form-control" multiple>
                                </div>
                            </div><!-- row -->

                        </div><!-- panel-body -->
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary"  data-step="4" data-intro="Once you have selected the files you wish to upload click on button to upload them" data-position='right'>Upload Files <i class="fa fa-cloud-upload"   ></i> </button>
                        </div>
                    </form>
                </div><!-- panel -->
            </div>
        </div>
    </div>
@endsection



@section('custom-scripts')
    <script src="{{asset('intro/intro.min.js')}}"></script>
@endsection




