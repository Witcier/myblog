@extends('adminlte::page')

@section('title','消息通知')

@section('content_header')
    <h1>消息通知</h1>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-11 col-lg-11 col-sm-11">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>消息</th>
                    <th>管理者</th>
                    <th>时间日期</th>
                </tr>
                </thead>
                <tbody id="tag_list">
                @foreach($user->notifications as $notification)
                    @include('notification.'.snake_case(class_basename($notification->type)))
                @endforeach
                </tbody>
            </table>


    </div>

@endsection


