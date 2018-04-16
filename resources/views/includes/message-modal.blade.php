<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content" id="create">
            <!-- Modal body -->
            <div class="modal-body">
                @include('includes.messages')
                {{-- @if (hasError())  --}}
                @if (session()->has('error')) 
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                @endif
                @if (session()->has('info'))
                  <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                @endif  
            </div>
        </div>
    </div>
</div>