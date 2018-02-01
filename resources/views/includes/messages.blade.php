@if(session()->has('error'))
            <div class="alert alert-danger">
                {!! session()->get('error') !!}
            </div>
@endif
    
@if(session()->has('info'))
    <div class="alert alert-success">
        {!! session()->get('info') !!}
    </div>
@endif