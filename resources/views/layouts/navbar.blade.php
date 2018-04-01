<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right" style=" font-size: 12px; ">
                <!-- <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Home</a>
                  <ul class="dropdown-menu">
                    <li><a href="index_mp_fullscreen_video_background.html">Default</a></li>
                    <li><a href="index_op_fullscreen_gradient_overlay.html">One Page</a></li>
                    <li><a href="index_agency.html">Agency</a></li>
                    <li><a href="index_portfolio.html">Portfolio</a></li>
                    <li><a href="index_restaurant.html">Restaurant</a></li>
                    <li><a href="index_finance.html">Finance</a></li>
                    <li><a href="index_landing.html">Landing Page</a></li>
                    <li><a href="index_photography.html">Photography</a></li>
                    <li><a href="index_shop.html">Shop</a></li>
                    
                  </ul>
                </li> -->

                <li class="dropdown">
                    <a class="" href="/finde_influencer_test" >Find Infulencers</a>
                </li> 
                <li class="dropdown">
                    <a class="" href="#" >Find Campaigns</a>
                </li>
                <li class="dropdown">
                    <a class="" href="/find_job_resource" >Find Jobs</a>
                </li>
                <?php 
                  if(Auth::guest()){
                    if (Auth::guard('jobseeker')->check()) { }else{
                ?>
                      <li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown">Login</a>
                          <ul class="dropdown-menu">
                              <li><a href="{{ route('login') }}">Influencer</a></li>
                              <li><a href="/jobseeker_login">Marketer</a></li>

                          </ul>
                      </li>

                      <li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown">Register</a>
                          <ul class="dropdown-menu">
                              <li><a href="{{ route('register') }}">Influencer</a></li>
                              <li><a href="/jobseeker_register">Marketer</a></li>
                          </ul>
                      </li>
                <?php
                    }
                  }
                ?>
                @if (Auth::guest())
                <?php if (Auth::guard('jobseeker')->check()) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ auth()->guard('jobseeker')->user()->first_name }}<span id="test_marketer_top"></span>
                            <!-- <span class="caret"></span> -->
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/viewprofile_marketer">View Profile</a>
                            </li>
                            <li>
                                <a href="/messages_marketer">Inbox <span id="test_marketer"></span></a>
                            </li>
                            <li>
                                <a href="/job_post_resource">Jobs</a>
                            </li>
                            <li>
                                <a href="{{ url('jobseeker_logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <!-- <li><a href="{{ route('login') }}">Login</a></li> -->
                <?php } ?>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span id="test_influencer_top"></span>
                        <!-- <span class="caret"></span> -->
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="/viewprofile">View Profile</a>
                        </li>
                        <li>
                                <a href="/messages_influencer">Inbox <span id="test_influencer"></span></a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif


                <!-- <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Headers</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Static Image Header</a>
                      <ul class="dropdown-menu">
                        <li><a href="index_mp_fullscreen_static.html">Fulscreen</a></li>
                        <li><a href="index_mp_classic_static.html">Classic</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Flexslider Header</a>
                      <ul class="dropdown-menu">
                        <li><a href="index_mp_fullscreen_flexslider.html">Fulscreen</a></li>
                        <li><a href="index_mp_classic_flexslider.html">Classic</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Video Background Header</a>
                      <ul class="dropdown-menu">
                        <li><a href="index_mp_fullscreen_video_background.html">Fulscreen</a></li>
                        <li><a href="index_mp_classic_video_background.html">Classic</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Text Rotator Header</a>
                      <ul class="dropdown-menu">
                        <li><a href="index_mp_fullscreen_text_rotator.html">Fulscreen</a></li>
                        <li><a href="index_mp_classic_text_rotator.html">Classic</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Gradient Overlay Header</a>
                      <ul class="dropdown-menu">
                        <li><a href="index_mp_fullscreen_gradient_overlay.html">Fulscreen</a></li>
                        <li><a href="index_mp_classic_gradient_overlay.html">Classic</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pages</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">About</a>
                      <ul class="dropdown-menu">
                        <li><a href="about1.html">About 1</a></li>
                        <li><a href="about2.html">About 2</a></li>
                        <li><a href="about3.html">About 3</a></li>
                        <li><a href="about4.html">About 4</a></li>
                        <li><a href="about5.html">About 5</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Services</a>
                      <ul class="dropdown-menu">
                        <li><a href="service1.html">Service 1</a></li>
                        <li><a href="service2.html">Service 2</a></li>
                        <li><a href="service3.html">Service 3</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pricing</a>
                      <ul class="dropdown-menu">
                        <li><a href="pricing1.html">Pricing 1</a></li>
                        <li><a href="pricing2.html">Pricing 2</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Gallery</a>
                      <ul class="dropdown-menu">
                        <li><a href="gallery_col_2.html">2 Columns</a></li>
                        <li><a href="gallery_col_3.html">3 Columns</a></li>
                        <li><a href="gallery_col_4.html">4 Columns</a></li>
                        <li><a href="gallery_col_6.html">6 Columns</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Contact</a>
                      <ul class="dropdown-menu">
                        <li><a href="contact1.html">Contact 1</a></li>
                        <li><a href="contact2.html">Contact 2</a></li>
                        <li><a href="contact3.html">Contact 3</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Restaurant menu</a>
                      <ul class="dropdown-menu">
                        <li><a href="restaurant_menu1.html">Menu 2 Columns</a></li>
                        <li><a href="restaurant_menu2.html">Menu 3 Columns</a></li>
                      </ul>
                    </li>
                    <li><a href="login_register.html">Login / Register</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                    <li><a href="404.html">Page 404</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Portfolio</a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed</a>
                      <ul class="dropdown-menu">
                        <li><a href="portfolio_boxed_col_2.html">2 Columns</a></li>
                        <li><a href="portfolio_boxed_col_3.html">3 Columns</a></li>
                        <li><a href="portfolio_boxed_col_4.html">4 Columns</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed - Gutter</a>
                      <ul class="dropdown-menu">
                        <li><a href="portfolio_boxed_gutter_col_2.html">2 Columns</a></li>
                        <li><a href="portfolio_boxed_gutter_col_3.html">3 Columns</a></li>
                        <li><a href="portfolio_boxed_gutter_col_4.html">4 Columns</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width</a>
                      <ul class="dropdown-menu">
                        <li><a href="portfolio_full_width_col_2.html">2 Columns</a></li>
                        <li><a href="portfolio_full_width_col_3.html">3 Columns</a></li>
                        <li><a href="portfolio_full_width_col_4.html">4 Columns</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width - Gutter</a>
                      <ul class="dropdown-menu">
                        <li><a href="portfolio_full_width_gutter_col_2.html">2 Columns</a></li>
                        <li><a href="portfolio_full_width_gutter_col_3.html">3 Columns</a></li>
                        <li><a href="portfolio_full_width_gutter_col_4.html">4 Columns</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Masonry</a>
                      <ul class="dropdown-menu">
                        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed</a>
                          <ul class="dropdown-menu">
                            <li><a href="portfolio_masonry_boxed_col_2.html">2 Columns</a></li>
                            <li><a href="portfolio_masonry_boxed_col_3.html">3 Columns</a></li>
                            <li><a href="portfolio_masonry_boxed_col_4.html">4 Columns</a></li>
                          </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width</a>
                          <ul class="dropdown-menu">
                            <li><a href="portfolio_masonry_full_width_col_2.html">2 Columns</a></li>
                            <li><a href="portfolio_masonry_full_width_col_3.html">3 Columns</a></li>
                            <li><a href="portfolio_masonry_full_width_col_4.html">4 Columns</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Hover Style</a>
                      <ul class="dropdown-menu">
                        <li><a href="portfolio_hover_black.html">Black</a></li>
                        <li><a href="portfolio_hover_gradient.html">Gradient</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Single</a>
                      <ul class="dropdown-menu">
                        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Image</a>
                          <ul class="dropdown-menu">
                            <li><a href="portfolio_single_featured_image1.html">Style 1</a></li>
                            <li><a href="portfolio_single_featured_image2.html">Style 2</a></li>
                          </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Slider</a>
                          <ul class="dropdown-menu">
                            <li><a href="portfolio_single_featured_slider1.html">Style 1</a></li>
                            <li><a href="portfolio_single_featured_slider2.html">Style 2</a></li>
                          </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Video</a>
                          <ul class="dropdown-menu">
                            <li><a href="portfolio_single_featured_video1.html">Style 1</a></li>
                            <li><a href="portfolio_single_featured_video2.html">Style 2</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Standard</a>
                      <ul class="dropdown-menu">
                        <li><a href="blog_standard_left_sidebar.html">Left Sidebar</a></li>
                        <li><a href="blog_standard_right_sidebar.html">Right Sidebar</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Grid</a>
                      <ul class="dropdown-menu">
                        <li><a href="blog_grid_col_2.html">2 Columns</a></li>
                        <li><a href="blog_grid_col_3.html">3 Columns</a></li>
                        <li><a href="blog_grid_col_4.html">4 Columns</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Masonry</a>
                      <ul class="dropdown-menu">
                        <li><a href="blog_grid_masonry_col_2.html">2 Columns</a></li>
                        <li><a href="blog_grid_masonry_col_3.html">3 Columns</a></li>
                        <li><a href="blog_grid_masonry_col_4.html">4 Columns</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Single</a>
                      <ul class="dropdown-menu">
                        <li><a href="blog_single_left_sidebar.html">Left Sidebar</a></li>
                        <li><a href="blog_single_right_sidebar.html">Right Sidebar</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Features</a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="alerts-and-wells.html"><i class="fa fa-bolt"></i> Alerts and Wells</a></li>
                    <li><a href="buttons.html"><i class="fa fa-link fa-sm"></i> Buttons</a></li>
                    <li><a href="tabs_and_accordions.html"><i class="fa fa-tasks"></i> Tabs &amp; Accordions</a></li>
                    <li><a href="content_box.html"><i class="fa fa-list-alt"></i> Contents Box</a></li>
                    <li><a href="forms.html"><i class="fa fa-check-square-o"></i> Forms</a></li>
                    <li><a href="icons.html"><i class="fa fa-star"></i> Icons</a></li>
                    <li><a href="progress-bars.html"><i class="fa fa-server"></i> Progress Bars</a></li>
                    <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Shop</a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Product</a>
                      <ul class="dropdown-menu">
                        <li><a href="shop_product_col_3.html">3 columns</a></li>
                        <li><a href="shop_product_col_4.html">4 columns</a></li>
                      </ul>
                    </li>
                    <li><a href="shop_single_product.html">Single Product</a></li>
                    <li><a href="shop_checkout.html">Checkout</a></li>
                  </ul>
                </li> -->













                <!--li.dropdown.navbar-cart-->
                <!--    a.dropdown-toggle(href='#', data-toggle='dropdown')-->
                <!--        span.icon-basket-->
                <!--        |-->
                <!--        span.cart-item-number 2-->
                <!--    ul.dropdown-menu.cart-list(role='menu')-->
                <!--        li-->
                <!--            .navbar-cart-item.clearfix-->
                <!--                .navbar-cart-img-->
                <!--                    a(href='#')-->
                <!--                        img(src='assets/images/shop/product-9.jpg', alt='')-->
                <!--                .navbar-cart-title-->
                <!--                    a(href='#') Short striped sweater-->
                <!--                    |-->
                <!--                    span.cart-amount 2 &times; $119.00-->
                <!--                    br-->
                <!--                    |-->
                <!--                    strong.cart-amount $238.00-->
                <!--        li-->
                <!--            .navbar-cart-item.clearfix-->
                <!--                .navbar-cart-img-->
                <!--                    a(href='#')-->
                <!--                        img(src='assets/images/shop/product-10.jpg', alt='')-->
                <!--                .navbar-cart-title-->
                <!--                    a(href='#') Colored jewel rings-->
                <!--                    |-->
                <!--                    span.cart-amount 2 &times; $119.00-->
                <!--                    br-->
                <!--                    |-->
                <!--                    strong.cart-amount $238.00-->
                <!--        li-->
                <!--            .clearfix-->
                <!--                .cart-sub-totle-->
                <!--                    strong Total: $476.00-->
                <!--        li-->
                <!--            .clearfix-->
                <!--                a.btn.btn-block.btn-round.btn-font-w(type='submit') Checkout-->
                <!--li.dropdown-->
                <!--    a.dropdown-toggle(href='#', data-toggle='dropdown') Search-->
                <!--    ul.dropdown-menu(role='menu')-->
                <!--        li-->
                <!--            .dropdown-search-->
                <!--                form(role='form')-->
                <!--                    input.form-control(type='text', placeholder='Search...')-->
                <!--                    |-->
                <!--                    button.search-btn(type='submit')-->
                <!--                        i.fa.fa-search-->











                <!-- <li class="dropdown"><a class="dropdown-toggle" href="documentation.html" data-toggle="dropdown">Documentation</a>
                  <ul class="dropdown-menu">
                    <li><a href="documentation.html#contact">Contact Form</a></li>
                    <li><a href="documentation.html#reservation">Reservation Form</a></li>
                    <li><a href="documentation.html#mailchimp">Mailchimp</a></li>
                    <li><a href="documentation.html#gmap">Google Map</a></li>
                    <li><a href="documentation.html#plugin">Plugins</a></li>
                    <li><a href="documentation.html#changelog">Changelog</a></li>
                  </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>






<!-- 
      <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                        <li><a href="/">Home</a></li>
                        <li><a href="/finde_influencer_test">Find Infulencers</a></li>
                        <li><a href="#">Find Campaigns</a></li>
                    
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
<?php
// $user = auth()->guard('jobseeker')->user()->user_role;
// v($user);
?>
                        @if (Auth::guest())
<?php if (Auth::guard('jobseeker')->check()) { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            {{ auth()->guard('jobseeker')->user()->first_name }}
                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ url('jobseeker_logout') }}">
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
<?php } else { ?>
                                    <li><a href="{{ route('login') }}">Login</a></li>
<?php } ?>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/viewprofile">View Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav> -->


        <script type="text/javascript">
          $( document ).ready(function() {
            $( "#test_influencer,#test_influencer_top" ).load( "/messages_count_influencer" );
            $( "#test_marketer,#test_marketer_top" ).load( "/messages_count_marketer" );
            window.setInterval(function(){
              $( "#test_influencer,#test_influencer_top" ).load( "/messages_count_influencer" );
              $( "#test_marketer,#test_marketer_top" ).load( "/messages_count_marketer" );
            }, 10000);
          });
        </script>