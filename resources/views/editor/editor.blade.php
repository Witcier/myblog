@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/fileinput.min.css ') }}">
@endsection

@section('title', '新建文章')


@section('content_header')
    <h1>创建文章</h1>
@stop

@section('content')
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" method="post"  id="post-form" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group col-md-8 col-lg-8">
                    <label for="title">文章标题</label>
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <input type="text" class="form-control" name="title" id="title" >
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-8 col-lg-8">
                    <label for="tag">文章标签</label>
                    <select class="form-control select2"  name="tag" id="tag" style="width: 100%;">
                        @foreach($tags as $tag)
                            <option selected="selected">{{$tag -> name}}</option>
                        @endforeach>
                    </select>
                </div>
                <div class="form-group col-md-10 col-lg-10">
                    <label for="content">文章内容(markdown语法)</label>
                    <div class="row">
                        <div class="col-md-10 col-lg-10" id="editormd">
                            <textarea class="editormd-markdown-textarea" style="display:none;" id="content" name="content"></textarea>
                            <textarea style="display:none;"  name="html_content" id="html_content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button  type="button" onclick="get_html_ajax()" id="ajax" class="btn-lg btn-success">发布</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(function() {
            editor = editormd("editormd", {
                path:"{{ asset('editormd/lib') }}"+"/",
                height: 800,
                syncScrolling: "single",
                toolbarAutoFixed: false,
                saveHTMLToTextarea: false,
            });
        });
        function get_html_ajax(url){
            var html_content = editor.getPreviewedHTML();
            $("#html_content").val(html_content);
            $.ajax({
                url:"{{ route('article.store') }}",
                data:$("form").serialize(),
                type:"POST",
                dataType:"text",
                success:function (data) {
                    bootbox.alert("文章发布成功",function(){
                        window.location.href=" {{ route('article.index') }}";
                    });
                },
                error:function(e){
                    bootbox.alert("发布失败");
                }
            });
        }
        $("#post-form").bootstrapValidator({
            message: '这个值没有被验证',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields:{
                title:{
                    validators:{
                        notEmpty:{
                            message:"文章题目不能为空"
                        }
                    }
                },
                tag:{
                    validators:{
                        notEmpty:{
                            message:"文章标签不能为空"
                        }
                    }
                }
            }
        });

    </script>
@stop


