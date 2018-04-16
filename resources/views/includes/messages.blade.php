@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- @if(session()->has('error'))
            <div class="alert alert-danger">
                {!! session()->get('error') !!}
            </div>
@endif --}}

@if(session()->has('error'))
    {{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script>
        swal({
            icon: "error",
            title: "Whoops!",
            text: "{{ session()->get('error') }}",
            button: "Sorry...",
        });
</script>
@endif
    
@if(session()->has('info'))
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
        <script>
            swal({
                icon: "success",
                title: "Hooray!",
                text: "{{ session()->get('info') }}",
                button: "Cool beans",
            });
    </script>
{{--     <div class="alert alert-success">
        {!! session()->get('info') !!}
    </div> --}}
@endif