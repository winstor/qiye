<div class="box">
    <!-- /.box-header -->
    <!-- form start -->
    {!! $form->open(['class' => "form-horizontal"]) !!}

    @if(!$tabObj->isEmpty())
        @include('admin::form.tab', compact('tabObj'))
    @else
        <div class="fields-group">

            @if($form->hasRows())
                @foreach($form->getRows() as $row)
                    {!! $row->render() !!}
                @endforeach
            @else
                @foreach($form->fields() as $field)
                    {!! $field->render() !!}
                @endforeach
            @endif


        </div>
    @endif
    <!-- /.box-body -->

    {!! $form->renderFooter() !!}

    @foreach($form->getHiddenFields() as $field)
        {!! $field->render() !!}
    @endforeach
<!-- /.box-footer -->
    {!! $form->close() !!}
</div>

