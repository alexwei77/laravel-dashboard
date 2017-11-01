
<div id="sync2" class="owl-carousel">
  <div id="standard" class="item">Standard</div>
  <div id="business" class="item">Business</div>
  <div id="professional" class="item">Professional</div>
  <div id="enterprise" class="item">Enterprise</div>
  <div id="elite" class="item">Elite</div>
</div>
<div id="sync1" class="owl-carousel">
  <div class="item"><!--<h1>1</h1>-->
       <div class="col-lg-12 col-md-4 col-sm-6 wow flipInY" data-wow-duration="3s" data-wow-delay="1.6s">
               <div id="standard1" class="box">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="text-white">Standard</h3>
                    </div>
                    <div class="panel-body">
                        <div class="box_round_symboll">
                            <?php echo $currencySymbol; ?><?php echo $countryPricesRow->std_price; ?>
                        </div>
                        <h4 class="success">Per Month</h4>
                        <ul style="text-align: justify;">
                            <li class="package-info">
                                Employees: <?php echo $countryPricesRow->std_employees; ?>
                            </li>
                            <li class="package-info">
                                Base: <?php echo $countryPricesRow->std_base; ?>
                            </li>
                            <li class="package-info">
                                Annual Payment Discount: <?php echo $countryPricesRow->std_discount; ?>
                            </li>
                            <li class="package-info">
                                Terms Forms (Active & checks): <?php echo $countryPricesRow->std_terms; ?>
                            </li>
                            <li class="package-info">
                                Cost per employee or check: <?php echo $currencySymbol; ?><?php echo $countryPricesRow->std_cost_employee; ?>
                            </li>
                            <li class="package-info">
                                Support: <?php echo $countryPricesRow->std_support; ?>
                            </li>
                            <li class="package-info">
                                Users(admins): <?php echo $countryPricesRow->std_users; ?>
                            </li>
                        </ul>
                        @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'standard') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'standard') }}"> Subscribe
                        </a>
                        @endif
                    </div>
                </div>
               </div>
       </div>
  </div>
  <div class="item">
      <div class="col-lg-12 col-md-4 col-sm-6 wow flipInY" data-wow-duration="3s" data-wow-delay="1.6s">
      <div id="business1" class="box">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="text-white">Business</h3>
                    </div>
                    <div class="panel-body">
                        <div class="box_round_symboll">
                            <?php echo $currencySymbol; ?><?php echo $countryPricesRow->bn_price; ?>
                        </div>
                        <h4 class="success">Per Month</h4>
                        <ul style="text-align: justify;">
                             <li class="package-info">
                                Employees: <?php echo $countryPricesRow->bn_employees; ?>
                            </li>
                            <li class="package-info">
                                Base: <?php echo $countryPricesRow->bn_base; ?>
                            </li>
                            <li class="package-info">
                                Annual Payment Discount: <?php echo $countryPricesRow->bn_discount; ?>
                            </li>
                            <li class="package-info">
                                Terms Forms (Active & checks): <?php echo $countryPricesRow->bn_terms; ?>
                            </li>
                            <li class="package-info">
                                Cost per employee or check: <?php echo $currencySymbol; ?><?php echo $countryPricesRow->bn_employee_cost; ?>
                            </li>
                            <li class="package-info">
                                Support: <?php echo $countryPricesRow->bn_support; ?>
                            </li>
                            <li class="package-info">
                                Users(admins): <?php echo $countryPricesRow->bn_users; ?>
                            </li>
                        </ul>
                        @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'business') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'business') }}"> Subscribe
                        </a>
                        @endif
                    </div>
                </div>
        </div>
       </div>
  </div>
  <div class="item">

       <div class="col-lg-12 col-md-4 col-sm-6 wow flipInY" data-wow-duration="3s" data-wow-delay="1.6s">
             <div id="professional1" class="box">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="text-white">Professional</h3>
                    </div>
                    <div class="panel-body">
                        <div class="box_round_symboll">
                            <?php echo $currencySymbol; ?><?php echo $countryPricesRow->pro_price; ?>
                        </div>
                        <h4 class="success">Per Month</h4>
                        <ul style="text-align: justify;">
                            <li class="package-info">
                                Employees: <?php echo $countryPricesRow->pro_employees; ?>
                            </li>
                            <li class="package-info">
                                Base: <?php echo $countryPricesRow->pro_base; ?>
                            </li>
                            <li class="package-info">
                                Annual Payment Discount: <?php echo $countryPricesRow->pro_discount; ?>
                            </li>
                            <li class="package-info">
                                Terms Forms (Active & checks): <?php echo $countryPricesRow->pro_terms; ?>
                            </li>
                            <li class="package-info">
                                Cost per employee or check: <?php echo $currencySymbol; ?><?php echo $countryPricesRow->pro_employee_cost; ?>
                            </li>
                            <li class="package-info">
                                Support: <?php echo $countryPricesRow->pro_support; ?>
                            </li>
                            <li class="package-info">
                                Users(admins): <?php echo $countryPricesRow->pro_users; ?>
                            </li>
                        </ul>
                        @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'professional') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'professional') }}"> Subscribe
                        </a>
                        @endif
                    </div>
                </div>
              </div>
       </div>
  </div>
  <div class="item">   
       <div class="col-lg-12 col-md-4 col-sm-6 wow flipInY" data-wow-duration="3s" data-wow-delay="1.6s">
             <div id="enterprise1" class="box">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="text-white">Enterprise</h3>
                    </div>
                    <div class="panel-body">
                        <div class="box_round_symboll">
                            <?php echo $currencySymbol; ?><?php echo $countryPricesRow->ent_price; ?>
                        </div>
                        <h4 class="success">Per Month</h4>
                        <ul style="text-align: justify;">
                           <li class="package-info">
                                Employees: <?php echo $countryPricesRow->ent_employees; ?>
                            </li>
                            <li class="package-info">
                                Base: <?php echo $countryPricesRow->ent_base; ?>
                            </li>
                            <li class="package-info">
                                Annual Payment Discount: <?php echo $countryPricesRow->ent_discount; ?>
                            </li>
                            <li class="package-info">
                                Terms Forms (Active & checks): <?php echo $countryPricesRow->ent_terms; ?>
                            </li>
                            <li class="package-info">
                                Cost per employee or check: <?php echo $currencySymbol; ?><?php echo $countryPricesRow->ent_employee_cost; ?>
                            </li>
                            <li class="package-info">
                                Support: <?php echo $countryPricesRow->ent_support; ?>
                            </li>
                            <li class="package-info">
                                Users(admins): <?php echo $countryPricesRow->ent_users; ?>
                            </li>
                        </ul>
                        @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'enterprise') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'enterprise') }}"> Subscribe
                        </a>
                        @endif
                    </div>
                </div>
              </div>
       </div>
  </div>
  <div class="item">
       <div class="col-lg-12 col-md-4 col-sm-6 wow flipInY" data-wow-duration="3s" data-wow-delay="1.6s">
              <div id="elite1" class="box">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="text-white">Elite</h3>
                    </div>
                    <div class="panel-body">
                        <div class="box_round_symboll">
                            <?php echo $currencySymbol; ?><?php echo $countryPricesRow->el_price; ?>
                        </div>
                        <h4 class="success">Per Month</h4>
                        <ul style="text-align: justify;">
                            <li class="package-info">
                                Employees: <?php echo $countryPricesRow->el_employees; ?>
                            </li>
                            <li class="package-info">
                                Base: <?php echo $countryPricesRow->ent_base; ?>
                            </li>
                            <li class="package-info">
                                Annual Payment Discount: <?php echo $countryPricesRow->el_discount; ?>
                            </li>
                            <li class="package-info">
                                Terms Forms (Active & checks): <?php echo $countryPricesRow->el_terms; ?>
                            </li>
                            <li class="package-info">
                                Support: <?php echo $countryPricesRow->el_support; ?>
                            </li>
                            <li class="package-info">
                                Users(admins): <?php echo $countryPricesRow->el_users; ?>
                            </li>
                        </ul>
                        @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'elite') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'elite') }}"> Subscribe
                        </a>
                        @endif
                    </div>
                </div>
              </div>
       </div>
  </div>
</div>