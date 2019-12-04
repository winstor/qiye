<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <div class="pull-right">
                <div class="btn-group pull-right" style="margin-right: 10px">
                    <a href="{{$router}}/create" class="btn btn-sm btn-success" title="新增">
                        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;新增</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <td></td>
                    @foreach($columns as $column=>$label)
                        <th>{{$label}}</th>
                    @endforeach
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lists as $item)
                <tr>
                    <td></td>
                    @foreach($columns as $column=>$label)
                        @if(in_array($column,$switches))
                            <td>
                                @if($item[$column])
                                    <input type="checkbox" class="grid-switch-{{$column}}" checked  data-key="{{$item[$keyName]}}"/>
                                @else
                                    <input type="checkbox" class="grid-switch-{{$column}}"   data-key="{{$item[$keyName]}}"/>
                                @endif
                            </td>
                        @else
                            @if($column==$titleName)
                                <td>
                                    @if($item['parent_id']==0)
                                        <img src="/public/uploads/anchor.gif" />&nbsp;
                                    @else
                                        {{str_repeat('&nbsp;&nbsp;',$item['level']*3)}}|-&nbsp;
                                    @endif
                                        {{$item[$column]}}[<a href="/admin/articles?category_id={{$item[$keyName]}}">{{$item->articles()->count()}}</a>]</td>
                            @else
                                <td>{!! $item[$column] !!}</td>
                            @endif

                        @endif
                    @endforeach
                    <td>
                        <a href="{{$router}}/create?parent_id={{$item[$keyName]}}" title="添加下级分类"><i class="fa fa-plus"></i></a>&nbsp;&nbsp;
                        <a href="{{$router}}/{{$item[$keyName]}}/edit" title="编辑"><i class="fa fa-edit"></i></a>
                        &nbsp;&nbsp;<a href="javascript:void(0);" data-id="{{$item[$keyName]}}" class="grid-row-delete" title="删除"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix"></div>
    </div>
</div>
