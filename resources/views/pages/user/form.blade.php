@if(isset($model))
{!! Form::model($model, ['route'=>[SharedData::get('route').'.postUpdate', 'code' => $model->{$model->getKeyName()}],'class'=>'form-horizontal needs-validation' , 'files'=>true]) !!}
@else
{!! Form::open(['url' => route(SharedData::get('route').'.postCreate'), 'class' => 'form-horizontal needs-validation', 'files' => true]) !!}
@endif

<div class="modal-header" id="modal-header">
    <h4 class="modal-title" id="modal-title">Master User</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Please fill this input', 'required']) !!}
            </div>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Please fill this input']) !!}
            </div>
        </div>
    </div>

</div>

<div class="modal-footer" id="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="modal-btn-save">Save changes</button>
</div>
{!! Form::close() !!}

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#modal-btn-save').click(function (event) {
    event.preventDefault();

    var form = $('#modal-body form'),
        url = form.attr('action');

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajax({
        url : url,
        method: 'POST',
        dataType  : 'json',
        data : form.serialize(),
        success: function (response) {

            if(response.status){
                form.trigger('reset');
                $('#modal').modal('hide');

                swal({
                    icon : 'success',
                    title : 'Success!',
                    text : 'Data has been saved!',
                    timer: 3000
                }).then(function(){
                    window.location.reload();
                });
            }
            else{
                swal({
                    icon : 'error',
                    title : 'Error!',
                    text : response.data,
                });
            }

        },
        error: function(xhr, status, error) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">*' + value + '</span>');
                });
            }
        }
    })
});

</script>