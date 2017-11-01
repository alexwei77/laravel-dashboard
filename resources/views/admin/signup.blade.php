<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- end of global level css -->
    <!-- page level css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login.css') }}" />
    <link href="{{ asset('assets/vendors/iCheck/css/square/blue.css') }}" rel="stylesheet"/>
    <!-- end of page level css -->

</head>

<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <!-- Notifications -->
           

            <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <div id="container_demo">
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <a class="hiddenanchor" id="toforgot"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                             <form action="{{ route('signup') }}" autocomplete="on" method="post" role="form" id="register_here">
                                <h3 class="black_bg">
                                    <img src="{{ asset('assets/img/logodmmx.jpg') }}" alt="josh logo">
                                    <br>Sign Up</h3>
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                    <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                        <label style="margin-bottom:0px;" for="first_name" class="youmail">
                                            <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                            First Name
                                        </label>
                                        <input id="first_name" name="first_name" required type="text" placeholder="John"
                                               value="{!! old('first_name') !!}"/>
                                        <div class="col-sm-12">
                                            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                        <label style="margin-bottom:0px;" for="last_name" class="youmail">
                                            <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                            Last Name
                                        </label>
                                        <input id="last_name" name="last_name" required type="text" placeholder="Doe"
                                               value="{!! old('last_name') !!}"/>
                                        <div class="col-sm-12">
                                            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                        <label style="margin-bottom:0px;" for="email" class="youmail">
                                            <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                            E-mail
                                        </label>
                                        <input id="email" name="email" value="{!! old('email') !!}" required type="email"
                                               placeholder="mysupermail@mail.com"/>
                                        <div class="col-sm-12">
                                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('email_confirm', 'has-error') }}">
                                        <label style="margin-bottom:0px;" for="email" class="youmail">
                                            <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                            Confirm E-mail
                                        </label>
                                        <input id="email_confirm" name="email_confirm" required type="email"
                                               placeholder="mysupermail@mail.com" value="{!! old('email_confirm') !!}"/>
                                        <div class="col-sm-12">
                                            {!! $errors->first('email_confirm', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                        <label style="margin-bottom:0px;" for="password" class="youpasswd">
                                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                            Password
                                        </label>
                                        <input id="password" name="password" required type="password" placeholder="Password" />
                                        <div class="col-sm-12">
                                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                                        <label style="margin-bottom:0px;" for="passwor_confirm" class="youpasswd">
                                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                            Confirm Password
                                        </label>
                                        <input id="password_confirm" name="password_confirm" required type="password" placeholder="Confirm Password" />
                                        <div class="col-sm-12">
                                            {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                <p class="signin button">
                                    <input type="submit" class="btn btn-success" value="Sign Up" />
                                </p>
                                <p class="change_link">
                                    <a href="{{ route('signin') }}" class="to_register">
                                        <button type="button" class="btn btn-responsive botton-alignment btn-warning btn-sm">Back</button>
                                    </a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- global js -->
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('assets/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/js/livicons-1.4.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/login.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
</body>
</html>