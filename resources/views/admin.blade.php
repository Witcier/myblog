@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>{{ $user->name }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <a href="{{ route('post.index') }}"><span class="info-box-icon bg-red-gradient"><i class="fa fa-file"></i></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">现有文章</span>
                    <span class="info-box-number">{{ $post_num }}篇</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="info-box">
                <a href="{{ route('tags.index') }}"><span class="info-box-icon bg-blue-gradient"><li class="fa fa-tags"></li></span></a>
                <div class="info-box-content">
                    <span class="info-box-text">现有标签</span>
                    <span class="info-box-number">{{ $tag_num }}个</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="info-box">
                <a href="{{ route('users.index') }}"><span class="info-box-icon bg-yellow-gradient"><li class="fa fa-users"></li></span></a>
                <div class="info-box-content">
                    <span class="in-box-text">团队人数</span>
                    <span class="info-box-number">{{ $user_num }}人</span>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12"><br>
            <!-- Bar chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">标签/文章数—统计图</h3>

                </div>
                <div class="box-body">
                    <div id="bar-chart" style="height: 300px;"></div>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
            <br></div>

        <div class="col-sm-8 col-md-8 col-lg-8">
            <h3><label for="hot_post">热门文章</label></h3>
            <table class="table table-striped" id="hot_post">
                <thead>
                    <tr>
                        <th>文章</th>
                        <th>作者</th>
                        <th>浏览量</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hot_post as $each_post)
                        <tr>
                            <th><a href="{{ route('article.show',['id'=>$each_post->id]) }}">{{ $each_post->title }}</a></th>
                            <th><a href="{{ route('users.show',['id'=>$each_post->user->id]) }}">{{ $each_post->user->name }}</a></th>
                            <th><span class="badge">{{ $each_post->view }}</span></th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12"><br>
            <!-- Bar chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">文章/浏览数—统计图</h3>

                </div>
                <div class="box-body">
                    <div id="post-chart" style="height: 300px;"></div>
                </div>
            </div>
            <br></div>
@stop

@section('js')
    <script src="{{asset('flot/jquery.flot.js')}}"></script>
    <script src="{{asset('flot/jquery.flot.categories.js')}}"></script>

    <script type="text/javascript">

        /*制作标签/文章数统计图*/
        $.ajax({
            url:"{{route('chart/tag')}}",
            type:"GET",
            dataType: "json",
            success:function (data) {
                tag_data = data;
                getTagData(tag_data);
            }
        });


      function getTagData(tag_data)
      {
          var bar_data = {
              data: tag_data,
              color: '#3c8dbc',
          }
          $.plot('#bar-chart', [bar_data], {
              grid  : {
                  borderWidth: 1,
                  borderColor: '#f3f3f3',
                  tickColor  : '#f3f3f3'
              },
              series: {
                  bars: {
                      show    : true,
                      barWidth: 0.5,
                      align   : 'center'
                  }
              },
              xaxis : {
                  mode      : 'categories',
                  tickLength: 0
              }
          })
      }

        /*制作文章/观看数统计图*/
        $.ajax({
            url:"{{route('post/tag')}}",
            type:"GET",
            dataType: "json",
            success:function (data) {
                post_data = data;
                getPostData(post_data);
            }
        });

        function getPostData(post_data)
        {
            console.log(post_data);
            var bar_data = {
                data: post_data,
                color: '#3c8dbc',
            }
            $.plot('#post-chart', [bar_data], {
                grid  : {
                    borderWidth: 1,
                    borderColor: '#f3f3f3',
                    tickColor  : '#f3f3f3'
                },
                series: {
                    bars: {
                        show    : true,
                        barWidth: 0.5,
                        align   : 'center'
                    }
                },
                xaxis : {
                    mode      : 'categories',
                    tickLength: 0
                }
            })
        }


    </script>

@endsection
