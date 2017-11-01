@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
Compose New Mail
@parent
@stop
{{-- page level styles --}}
@section('header_styles')    
<link href="{{ asset('assets/vendors/summernote/summernote.css') }}" rel="stylesheet" media="screen" />
<link href="{{ asset('assets/css/pages/mail_box.css') }}" rel="stylesheet" type="text/css" />
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
   <h1>Compose</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('admin.dashboard') }}">
         <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
         Dashboard
         </a>
      </li>
      <li>
         <a href="{{ URL::to('admin/inbox') }}">Email</a>
      </li>
      <li class="active">Compose</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row web-mail">
      <div class="col-lg-2 col-md-3 col-sm-4">
         <div class="whitebg">
            <ul>
               <li class="compose">
                  <a href="{{ URL::to('helpcenter/compose') }}">
                  <i class="livicon" data-n="pen" data-s="16" data-c="white"></i>
                  &nbsp; &nbsp;Compose
                  </a>
               </li>
               <li>
                  <a href="{{ URL::to('helpcenter/history') }}">
                  <i class="livicon" data-n="inbox" data-s="16" data-c="gray"></i>
                  &nbsp; &nbsp;History
                  </a>
               </li>
               <!--<li>
                  <a href="{{ URL::to('admin/sent') }}">
                      <i class="livicon" data-n="check-circle" data-s="16" data-c="gray"></i>
                      &nbsp; &nbsp; Sent
                  </a>
                  </li>
                  <li>
                  <a href="{{ URL::to('admin/trash') }}">
                      <i class="livicon" data-n="trash" data-s="16" data-c="gray"></i>
                      &nbsp; &nbsp; Trash
                  </a>
                  </li>
                  <li>
                  <a href="{{ URL::to('admin/spam') }}">
                      <i class="livicon" data-n="eye-close" data-s="16" data-c="gray"></i>
                      &nbsp; &nbsp; Spam
                  </a>
                  </li>
                  <li>
                  <a href="{{ URL::to('admin/draft') }}">
                      <i class="livicon" data-n="unlink" data-s="16" data-c="gray"></i>
                      &nbsp; &nbsp; Draft
                  </a>
                  </li>-->
            </ul>
         </div>
      </div>
      <div class="col-lg-10 col-md-9 col-sm-8">
         <div class="whitebg">
            <table class="table table-striped table-advance">
               <thead>
                  <tr>
                     <td colspan="4">
                        <div class="col-md-8">
                           <h4>
                              <strong>Compose</strong>
                           </h4>
                        </div>
                     </td>
                  </tr>
               </thead>
               <tbody>
                  <form action="{{ route('send-message') }}" method="POST">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                     <tr>
                        <td colspan="4">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="compose row">
                                    <div class="form-group {{ $errors->first('title', 'has-error') }}">
                                       <label for="ratingTitle" class="col-sm-2 control-label">Title *</label>
                                       <div class="col-sm-10">
                                          <input id="title" name="title" placeholder="Title*" type="text"
                                             class="form-control required" value="{!! old('title') !!}"/>
                                          {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                       </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('message', 'has-error') }}">
                                       <label for="message" class="col-sm-2 control-label">Message*</label>
                                       <div class="col-sm-10">
                                          <textarea id="message" placeholder="Message*" name="message" rows="4" class="form-control required"></textarea>
                                          {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td width="100%">
                           <div class="row">
                              <div class="col-md-8">
                                 <div class="col-md-4">
                                    <button type="submit" class="btn btn-warning">
                                    <span class="livicon" data-n="external-link" data-s="12" data-c="white" data-hc="white"></span>
                                    Send
                                    </button>
                                 </div>
                                 <!--<div class="col-md-4">
                                    <a href="{{ URL::to('admin/draft') }}" class="btn btn-sm btn-success">
                                        <span class="livicon" data-n="briefcase" data-s="12" data-c="white" data-hc="white"></span>
                                        Draft
                                    </a>
                                    </div>
                                    <div class="col-md-4">
                                    <a href="{{ URL::to('admin/inbox') }}" class="btn btn-sm btn-warning">
                                        <span class="livicon" data-n="trash" data-s="12" data-c="white" data-hc="white"></span>
                                        Send
                                    </a>
                                    </div>-->
                              </div>
                           </div>
                        </td>
                        <td width="3%"></td>
                        <td width="13%" class="view-message text-right">&nbsp;</td>
                     </tr>
                  </form>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
<!-- content -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script  src="{{ asset('assets/vendors/summernote/summernote.min.js') }}"  type="text/javascript"></script>
<script type="text/javascript">
   $('#summernote').summernote();
   $('#slimscrollside').slimscroll({
       height: '700px',
       size: '3px',
       color: 'black',
       opacity: .3
   });
   
</script>
@stop