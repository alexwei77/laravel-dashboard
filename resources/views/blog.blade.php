@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
News
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/blog.css') }}">
    <!--end of page level css-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- breadcrumb --}}
@section('top')
    <!--<div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
                    <a href="{{ route('news') }}">News</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> News Item
            </div>
        </div>
    </div>-->
    @stop


{{-- Page content --}}
@section('content')

    <!-- Container Section Strat -->
    <div class="container">
        <h2>News</h2>
        <div class="row">
            <div class="content">
                <div class="col-md-8">
                    @forelse ($blogs as $blog)
                    <!-- BEGIN FEATURED POST -->
                    <div class="featured-post-wide thumbnail">
                        @if($blog->image)
                        <img src="{{ URL::to('/uploads/blog/'.$blog->image)  }}" class="img-responsive" alt="Image">
                        @endif
                        <div class="featured-text relative-left">
                            <h3 class="primary"><a href="{{ URL::to(session('custom_lang') .'/newsitem/'.$blog->slug) }}">{{$blog->title}}</a></h3>
                            <p>
                                <!--{!! $blog->content !!}-->
                            </p>
                           
                            <p class="additional-post-wrap">
                                <!--<span class="additional-post">
                                    <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i> by&nbsp;<a href="#">{{$blog->author->first_name . ' ' . $blog->author->last_name}}</a>
                                </span>-->
                                <span class="additional-post">
                                    <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> {{$blog->created_at->diffForHumans()}}</a>
                                </span>
                                <!--<span class="additional-post">
                                    <i class="livicon" data-name="comment" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> {{$blog->comments->count()}} comments</a>
                                </span>-->
                            </p>
                            <hr>
                            <p class="text-right">
                                <a href="{{ URL::to(session('custom_lang') .'/newsitem/'.$blog->slug) }}" class="btn btn-primary text-white">Read more</a>
                            </p>
                        </div>
                        <!-- /.featured-text -->
                    </div>
                    <!-- /.featured-post-wide -->
                    <!-- END FEATURED POST -->
                    @empty
                        <h3>No News Exist!</h3>
                    @endforelse
                    <ul class="pager">
                        {!! $blogs->render() !!}
                    </ul>
                </div>
                <!-- /.col-md-8 -->
                <div class="col-md-4">
                    <!-- END POPULAR POST -->
                    <!-- Tabbable-Panel Start -->
                    
                    <div class="tabbable-panel">
                        <!-- Tabbablw-line Start -->
                        <div class="tabbable-line">
                            <!-- Nav Nav-tabs Start -->
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                        Popular News </a>
                                </li>
                                <!--<li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                        Recent Posts </a>
                                </li>-->
                            </ul>
                            <!-- //Nav Nav-tabs End -->
                            <!-- Tab-content Start -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    @foreach( $popularBlogs as $popularBlog)
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="{{ URL::to(session('custom_lang') .'/newsitem/'.$popularBlog->slug) }}">
                                                <img class="media-object img-responsive" src="{{ asset('uploads/blog/' .$popularBlog->image) }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">{{ $popularBlog->title }}</h4>
                                    <p>
                                        {{ substr(strip_tags($popularBlog->content), 0, 130) .'...' }}
                                    </p>
                                    <div class="text-right primary"><a href="{{ URL::to(session('custom_lang') .'/newsitem/'.$popularBlog->slug) }}">Read more</a>
                                    </div>
                                    @endforeach
                                </div>
                                <!--<div class="tab-pane" id="tab_default_2">
                                   
                                </div>-->
                            </div>
                            <!-- //Tab-content End -->
                        </div>
                        <!-- //Tabbablw-line End -->
                    </div>
                    <!-- Tabbable_panel End -->
                    
                </div>
                <!-- /.col-md-4 -->
            </div>
        </div>
    </div>
    
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
