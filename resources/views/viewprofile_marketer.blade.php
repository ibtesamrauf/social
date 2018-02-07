@extends('layouts.app')

@section('content')

<div class="main">
    <section class="module bg-dark-30" data-background="assets/images/section-4.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="module-title font-alt mb-0">Profile</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            @if(Session::has('alert'))
            <div class="alert alert-success">
                {{ Session::get('alert') }}
                @php
                Session::forget('alert');
                @endphp
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12" align="center">
                    <!-- <h3 class="font-alt">Register</h3> -->
                    <!-- <hr class="divider-w mb-10"> -->

                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

                    <hr class="">
                    <div class="">
                        <div class="row">
                            <div class="text-align-left col-sm-10">
                                <h1 class="">{{ Auth::guard('jobseeker')->user()->first_name  }} {{ Auth::guard('jobseeker')->user()->last_name }}
                                </h1>

                                <button type="button" class="btn btn-success">Book me!</button>  <button type="button" class="btn btn-info">Send me a message</button>
                                <br>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="pull-right">
                                    @if (!empty(Auth::guard('jobseeker')->user()->profile_picture)) 
                                    <img title="profile image" class="img-circle img-responsive" src="uploads/{{Auth::guard('jobseeker')->user()->profile_picture }}">
                                    @else
                                    <img title="profile image" class="img-responsive" src="img/default-profile.png">
                                    @endif
                                </a>
                            </div>
                        </div>
                        <br>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <!--left col-->
                                <ul class="list-group">
                                    <li class="list-group-item text-muted" contenteditable="false">Profile</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span>{{ Auth::guard('jobseeker')->user()->created_at }}</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Email</strong></span> {{ Auth::guard('jobseeker')->user()->email }}</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Phone Number</strong></span> {{ Auth::guard('jobseeker')->user()->phone_number }}</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Country</strong></span>{{ Auth::guard('jobseeker')->user()->Country_name->country_name }}</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Role</strong></span> Marketer

                                    </li>
                                </ul>
                                
                            </div>
                            <!--/col-3-->
                            <div class="col-sm-9" style="" contenteditable="false">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> {{ Auth::guard('jobseeker')->user()->name }} Bio</div>
                                    <div class="panel-body"> A long description about me.

                                    </div>
                                </div>

                                <div class="panel panel-default target">
                                    <div class="panel-heading" contenteditable="false">
                                        Agency / Company details
                                    </div>
                                    <div class="panel-body">
                                        <!-- foreach($instagram_page_data as $instagram_item) -->
                                        <div class="">
                                            <div class="">
                                                <a href="instagram_page_resource/$instagram_item->id" class="marketer-company-image pull-right">
                                                    <img alt="300x200" class="marketer-company-image img-thumbnail" src="uploads/{{ Auth::guard('jobseeker')->user()->Maeketer_company->logo }} ">
                                                </a>
                                                <div class="pull-left caption">
                                                    <h3 class="text-align-left"><?php echo strtoupper( Auth::guard('jobseeker')->user()->Maeketer_company->company_name); ?></h3>
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h5 class="text-align-left">Website: </h5>
                                                            </td>
                                                            <td>
                                                                <h6>{{ Auth::guard('jobseeker')->user()->Maeketer_company->website }}</h6>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>
                                                                <h5 class="text-align-left">Description: </h5>
                                                            </td>
                                                            <td>
                                                                <h6>{{ Auth::guard('jobseeker')->user()->Maeketer_company->description }}</h6>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- endforeach -->
                                    </div>
                                </div>
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">Previously Campaign</div>
                                    <div class="panel-body"> 
                                        <?php 
                                            if(Auth::guard('jobseeker')->user()->Maeketer_previously_campaign->isEmpty()){
                                                echo "No previously campaign<";
                                            }else{
                                        ?>
                                        <table class="table">
                                            <th>S.no</th>
                                            <th>Influencer Used</th>
                                            <th>Campaign Link</th>
                                            <th>Description</th>
                                            @foreach(Auth::guard('jobseeker')->user()->Maeketer_previously_campaign as $key => $previously_campaign)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $previously_campaign->influencer_used }}</td>
                                                    <td>{{ $previously_campaign->campaign_link }}</td>
                                                    <td>{{ $previously_campaign->description }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <?php    
                                            } 
                                        ?>
                                    </div>
                                </div>
                                
                            </div>


                            <div id="push"></div>
                        </div>
                        <!--   <footer id="footer">
                              <div class="row-fluid">
                                  <div class="span3">
                                      <p> 
                                          <a href="http://twitter.com/Bootply" rel="nofollow" title="Bootply on Twitter" target="ext">Twitter</a><br>
                                          <a href="https://plus.google.com/+Bootply" rel="publisher">Google+</a><br>
                                          <a href="http://facebook.com/Bootply" rel="nofollow" title="Bootply on Facebook" target="ext">Facebook</a><br>
                                          <a href="https://github.com/iatek/bootply" title="Bootply on GitHub" target="ext">GitHub</a><br>
                                      </p>
                                  </div>
                                  <div class="span3">
                                      <p> 
                                          <a data-toggle="modal" role="button" href="#contactModal">Contact Us</a><br>
                                          <a href="/tags">Tags</a><br>
                                          <a href="/bootstrap-community">Community</a><br>
                                          <a href="/upgrade">Upgrade</a><br>
                                      </p>
                                  </div>
                                  <div class="span3">
                                      <p> 
                                          <a href="http://www.bootbundle.com" target="ext" rel="nofollow">BootBundle</a><br>
                                          <a href="https://bootstrapbay.com/?ref=skelly" target="_ext" rel="nofollow" title="Premium Bootstrap themes">Bootstrap Themes</a><br>
                                          <a href="http://www.bootstrapzero.com" target="_ext" rel="nofollow" title="Free Bootstrap templates">BootstrapZero</a><br>
                                          <a href="http://upgrade-bootstrap.bootply.com/">2.x Upgrade Tool</a><br>
                                      </p>
                                  </div>
                                  <div class="span3">
                                      <span class="pull-right">©Copyright 2013-2014 <a href="/" title="The Bootstrap Playground">Bootply</a> | <a href="/about#privacy">Privacy</a></span>
                                  </div>
                              </div>
                          </footer> -->

                        <!-- <script src="/plugins/bootstrap-select.min.js"></script>
                       // <script src="/codemirror/jquery.codemirror.js"></script>
                       // <script src="/beautifier.js"></script> -->

                        <script>
                            jQuery.fn.shake = function (intShakes, intDistance, intDuration, foreColor) {
                                this.each(function () {
                                    if (foreColor && foreColor != "null") {
                                        $(this).css("color", foreColor);
                                    }
                                    $(this).css("position", "relative");
                                    for (var x = 1; x <= intShakes; x++) {
                                        $(this).animate({left: (intDistance * -1)}, (((intDuration / intShakes) / 4)))
                                                .animate({left: intDistance}, ((intDuration / intShakes) / 2))
                                                .animate({left: 0}, (((intDuration / intShakes) / 4)));
                                        $(this).css("color", "");
                                    }
                                });
                                return this;
                            };
                        </script>
                        <script>
                            $(document).ready(function () {
                                $('.tw-btn').fadeIn(3000);
                                $('.alert').delay(5000).fadeOut(1500);
                            });
                            $.fn.serializeObject = function ()
                            {
                                var o = {};
                                var a = this.serializeArray();
                                $.each(a, function () {
                                    if (o[this.name] !== undefined) {
                                        if (!o[this.name].push) {
                                            o[this.name] = [o[this.name]];
                                        }
                                        o[this.name].push(this.value || '');
                                    } else {
                                        o[this.name] = this.value || '';
                                    }
                                });
                                return o;
                            };
                            var prependAlert = function (appendSelector, msg) {
                                $(appendSelector).after('<div class="alert alert-info alert-block affix" id="msgBox" style="z-index:1300;margin:14px!important;">' + msg + '</div>');
                                $('.alert').delay(3500).fadeOut(1000);
                            }
                        </script>
                        <!-- Quantcast Tag -->
                        <script type="text/javascript">
                            var _qevents = _qevents || [];

                            (function () {
                                var elem = document.createElement('script');
                                elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
                                elem.async = true;
                                elem.type = "text/javascript";
                                var scpt = document.getElementsByTagName('script')[0];
                                scpt.parentNode.insertBefore(elem, scpt);
                            })();

                            _qevents.push({
                                qacct: "p-0cXb7ATGU9nz5"
                            });
                        </script>
                        <noscript>
                        &amp;amp;amp;amp;amp;amp;amp;lt;div style="display:none;"&amp;amp;amp;amp;amp;amp;amp;gt;
                        &amp;amp;amp;amp;amp;amp;amp;lt;img src="//pixel.quantserve.com/pixel/p-0cXb7ATGU9nz5.gif" border="0" height="1" width="1" alt="Quantcast"/&amp;amp;amp;amp;amp;amp;amp;gt;
                        &amp;amp;amp;amp;amp;amp;amp;lt;/div&amp;amp;amp;amp;amp;amp;amp;gt;
                        </noscript>
                        <!-- End Quantcast tag -->
                        <div id="completeLoginModal" class="modal hide">
                            <div class="modal-header">
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                <h3>Do you want to proceed?</h3>
                            </div>
                            <div class="modal-body">
                                <p>This page must be refreshed to complete your login.</p>
                                <p>You will lose any unsaved work once the page is refreshed.</p>
                                <br><br>
                                <p>Click "No" to cancel the login process.</p>
                                <p>Click "Yes" to continue...</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#" id="btnYes" class="btn danger">Yes, complete login</a>
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
                            </div>
                        </div>
                        <div id="forgotPasswordModal" class="modal hide">
                            <div class="modal-header">
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                <h3>Password Lookup</h3>
                            </div>
                            <div class="modal-body">
                                <form class="form form-horizontal" id="formForgotPassword">    
                                    <div class="control-group">
                                        <label class="control-label" for="inputEmail">Email</label>
                                        <div class="controls">
                                            <input name="_csrf" id="token" value="CkMEALL0JBMf5KSrOvu9izzMXCXtFQ/Hs6QUY=" type="hidden">
                                            <input name="email" id="inputEmail" placeholder="you@youremail.com" required="" type="email">
                                            <span class="help-block"><small>Enter the email address you used to sign-up.</small></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer pull-center">
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Cancel</a>  
                                <a href="#" data-dismiss="modal" id="btnForgotPassword" class="btn btn-success">Reset Password</a>
                            </div>

                        </div>
                        <div id="upgradeModal" class="modal hide">
                            <div class="modal-header">
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                <h4>Would you like to upgrade?</h4>
                            </div>
                            <div class="modal-body">
                                <p class="text-center"><strong></strong></p>
                                <h1 class="text-center">$4<small>/mo</small></h1>
                                <p class="text-center"><small>Unlimited plys. Unlimited downloads. No Ads.</small></p>
                                <p class="text-center">
                                    <img src="{{ asset('img/090.png') }}" alt="visa" width="50"> 
                                    <img src="{{ asset('img/090.png') }}" alt="mastercard" width="50"> 
                                    <img src="{{ asset('img/090.png') }}" alt="amex" width="50"> 
                                    <img src="{{ asset('img/090.png') }}" alt="discover" width="50"> 
                                    <img src="{{ asset('img/090.png') }}" alt="paypal" width="50">
                                </p>
                            </div>
                            <div class="modal-footer pull-center">
                                <a href="/upgrade" class="btn btn-block btn-huge btn-success"><strong>Upgrade Now</strong></a>
                                <a href="#" data-dismiss="modal" class="btn btn-block btn-huge">No Thanks, Maybe Later</a>
                            </div>
                        </div>
                        <div id="contactModal" class="modal hide">
                            <div class="modal-header">
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                <h3>Contact Us</h3>
                                <p>suggestions, questions or feedback</p>
                            </div>
                            <div class="modal-body">
                                <form class="form form-horizontal" id="formContact">
                                    <input name="_csrf" id="token" value="CkMEALL0JBMf5KSrOvu9izzMXCXtFQ/Hs6QUY=" type="hidden">
                                    <div class="control-group">
                                        <label class="control-label" for="inputSender">Name</label>
                                        <div class="controls">
                                            <input name="sender" id="inputSender" class="input-large" placeholder="Your name" type="text">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputMessage">Message</label>
                                        <div class="controls">
                                            <textarea name="notes" rows="5" id="inputMessage" class="input-large" placeholder="Type your message here"></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputEmail">Email</label>
                                        <div class="controls">
                                            <input name="email" id="inputEmail" class="input-large" placeholder="you@youremail.com (for reply)" required="" type="text">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer pull-center">
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Cancel</a>     
                                <a href="#" data-dismiss="modal" aria-hidden="true" id="btnContact" role="button" class="btn btn-success">Send</a>
                            </div>
                        </div>




                    <!-- // <script src="/plugins/bootstrap-pager.js"></script> -->
                    </div>

                    <script type="text/javascript">
                        /* pagination */
                        $.fn.pageMe = function (opts) {
                            var $this = this,
                                    defaults = {
                                        perPage: 7,
                                        showPrevNext: false,
                                        numbersPerPage: 1,
                                        hidePageNumbers: false
                                    },
                                    settings = $.extend(defaults, opts);

                            var listElement = $this;
                            var perPage = settings.perPage;
                            var children = listElement.children();
                            var pager = $('.pagination');

                            if (typeof settings.childSelector != "undefined") {
                                children = listElement.find(settings.childSelector);
                            }

                            if (typeof settings.pagerSelector != "undefined") {
                                pager = $(settings.pagerSelector);
                            }

                            var numItems = children.size();
                            var numPages = Math.ceil(numItems / perPage);

                            pager.data("curr", 0);

                            if (settings.showPrevNext) {
                                $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
                            }

                            var curr = 0;
                            while (numPages > curr && (settings.hidePageNumbers == false)) {
                                $('<li><a href="#" class="page_link">' + (curr + 1) + '</a></li>').appendTo(pager);
                                curr++;
                            }

                            if (settings.numbersPerPage > 1) {
                                $('.page_link').hide();
                                $('.page_link').slice(pager.data("curr"), settings.numbersPerPage).show();
                            }

                            if (settings.showPrevNext) {
                                $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
                            }

                            pager.find('.page_link:first').addClass('active');
                            if (numPages <= 1) {
                                pager.find('.next_link').hide();
                            }
                            pager.children().eq(1).addClass("active");

                            children.hide();
                            children.slice(0, perPage).show();

                            pager.find('li .page_link').click(function () {
                                var clickedPage = $(this).html().valueOf() - 1;
                                goTo(clickedPage, perPage);
                                return false;
                            });
                            pager.find('li .prev_link').click(function () {
                                previous();
                                return false;
                            });
                            pager.find('li .next_link').click(function () {
                                next();
                                return false;
                            });

                            function previous() {
                                var goToPage = parseInt(pager.data("curr")) - 1;
                                goTo(goToPage);
                            }

                            function next() {
                                goToPage = parseInt(pager.data("curr")) + 1;
                                goTo(goToPage);
                            }

                            function goTo(page) {
                                var startAt = page * perPage,
                                        endOn = startAt + perPage;

                                children.css('display', 'none').slice(startAt, endOn).show();

                                if (page >= 1) {
                                    pager.find('.prev_link').show();
                                } else {
                                    pager.find('.prev_link').hide();
                                }

                                if (page < (numPages - 1)) {
                                    pager.find('.next_link').show();
                                } else {
                                    pager.find('.next_link').hide();
                                }

                                pager.data("curr", page);

                                if (settings.numbersPerPage > 1) {
                                    $('.page_link').hide();
                                    $('.page_link').slice(page, settings.numbersPerPage + page).show();
                                }

                                pager.children().removeClass("active");
                                pager.children().eq(page + 1).addClass("active");
                            }
                        };

                        $('#items').pageMe({pagerSelector: '#myPager', childSelector: 'tr', showPrevNext: true, hidePageNumbers: false, perPage: 5});
                        /****/
                    </script>


                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
</div>
<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>


@endsection
