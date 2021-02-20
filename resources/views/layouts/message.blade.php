<div>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert" style="text-align: center">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            {{ Session::get('success') }}
        </div>
    @endif


    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert" style="text-align: center">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            {{ Session::get('error') }}
        </div>
    @endif


</div>
