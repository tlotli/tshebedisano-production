{{--<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>--}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>--}}
<script src="{{asset('js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/modernizr.min.js')}}"></script>
<script src="{{asset('js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('js/toggles.min.js')}}"></script>
<script src="{{asset('js/retina.min.js')}}"></script>
<script src="{{asset('js/jquery.cookies.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>

@yield('custom-scripts')

<script>
    @if(Session::has('success'))
    toastr.success('{{Session::get('success')}}');
    @endif

    @if(Session::has('info'))
    toastr.info('{{Session::get('info')}}');
    @endif

    @if(Session::has('warning'))
    toastr.warning('{{Session::get('warning')}}');
    @endif

    @if(Session::has('danger'))
    toastr.warning('{{Session::get('danger')}}');
    @endif
</script>