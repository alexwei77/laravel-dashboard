@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
{{$blog->title}}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/blog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <!--end of page level css-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="container">
        <h2 class="primary marl12">{{$blog->title}}</h2>
        <div class="row content">
            <!-- Business Deal Section Start -->
            <div class="col-sm-8 col-md-8">
                <div class=" thumbnail featured-post-wide img">
                    @if($blog->image)
                        <img src="{{ URL::to('/uploads/blog/'.$blog->image)  }}" class="img-responsive" alt="Image">
                    @endif
                    <!-- /.blog-detail-image -->
                    <div class="the-box no-border blog-detail-content">
                        <p class="additional-post-wrap">
                            <span class="additional-post">
                                    <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i> by&nbsp;<a href="#">{{$blog->author->first_name . ' ' . $blog->author->last_name}}</a>
                                </span>
                            <span class="additional-post">
                                    <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> {{$blog->created_at->diffForHumans()}} </a>
                                </span>
                            <span class="additional-post">
                                    <i class="livicon" data-name="comment" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> {{$blog->comments->count()}} comment(s)</a>
                                </span>
                        </p>
                        <p class="text-justify">
                            {!! $blog->content !!}
                        </p>
                        <div class="blog-detail-image">
                            @if(!empty($blog->summernote_image))
                                <img src="{{URL::to('uploads/blog/'.$blog->summernote_image)}}" class="img-responsive summernote_image" alt="Image">
                            @endif
                        </div>
                        
                    </div>
                </div>
                <!-- /the.box .no-border -->
               
            </div>
            <!-- //Business Deal Section End -->
            <!-- /.col-sm-9 -->
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
            <!-- /.col-sm-3 -->
        </div>
    </div>
    <!-- //Conatainer Section End -->
@stop
