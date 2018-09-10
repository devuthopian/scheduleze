@extends('layouts.front')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-align-center"></i></span>
                        <span>Update List Order</span>
                    </h3>
                </div>

                <div class="box-body">

                    <div class="well well-sm well-toolbar" id="nestable-menu">
                        <a href="javascript:window.history.back();" class="btn btn-labeled btn-default">
                            <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Back
                        </a>

                        <button type="button" class="btn btn-labeled btn-default text-primary" data-action="expand-all">
                            <span class="btn-label"><i class="fa fa-fw fa-plus-circle"></i></span>Expand
                            All
                        </button>

                        <button type="button" class="btn btn-labeled btn-default text-primary" data-action="collapse-all">
                            <span class="btn-label"><i class="fa fa-fw fa-minus-circle text-red"></i></span>Collapse
                            All
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="dd" id="dd-navigation" style="max-width: 100%">
                                {!! $itemsHtml !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!--  <script src="{{ URL::asset('js/website.js') }}"></script> -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.nestable.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            initNestableMenu(1, "{{ Request::url() }}");
        });

        function initNestableMenu(maxDepth, path)
        {
            $('#dd-navigation').nestable({
                group: 1,
                maxDepth: maxDepth
            }).on('change', updateList);

            $('#nestable-menu').click(function (e)
            {
                var target = $(e.target), action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            function updateList(e)
            {
                var list = e.length ? e : $(e.target);
                var nestableString = window.JSON.stringify(list.nestable('serialize'));
                $.post(path, {'list': nestableString}, function (data)
                {
                    if (data && data.result == 'success') {
                        notify('Successfully', 'The Order has been updated', null, null, 5000);
                    }
                    else {
                        notifyError();
                    }
                }, "json");
            }
        }
    </script>

@endsection

