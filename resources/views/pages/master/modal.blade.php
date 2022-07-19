<div class="modal-header" id="modal-header">
    <h4 class="modal-title" id="modal-title">
        @yield('title')
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@yield('form')

<div class="modal-body">

    @yield('container')

</div>

<div class="modal-footer" id="modal-footer">
@yield('action')
</div>

{!! Form::close() !!}

@yield('footer')
@yield('javascript')
