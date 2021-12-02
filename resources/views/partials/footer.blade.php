<!--== Footer Area Start ==-->
{{--<footer id="footer-area">--}}
{{--    <!-- Footer Widget Start -->--}}
{{--    <div class="footer-widget section-padding">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <!-- Single Widget Start -->--}}
{{--                <div class="col-lg-4 col-sm-12">--}}
{{--                    <div class="single-widget-wrap">--}}
{{--                        <div class="widgei-body">--}}
{{--                            <div class="footer-about">--}}
{{--                                <img src="{{ site('logo') }}" alt="{{ site('name') }}" class="img-fluid" />--}}
{{--                                <p>{{ site('description') }}</p>--}}
{{--                                <a href="tel::{{ site('hunting_line') }}">Phone: {{ site('hunting_line') }}</a>--}}
{{--                                 <br>--}}
{{--                                <a href="mailto::{{ site('primary_email') }}">Email: {{ site('primary_email') }}</a>--}}
{{--                                <br>--}}
{{--                                <a href="#">Address: {{ site('address') }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Single Widget End -->--}}

{{--                <!-- Single Widget Start -->--}}
{{--                <div class="col-lg-3 col-sm-12">--}}
{{--                    <div class="single-widget-wrap">--}}
{{--                        <h4 class="widget-title">Usefull Link</h4>--}}
{{--                        <div class="widgei-body">--}}
{{--                            <ul class="double-list footer-list clearfix">--}}
{{--                                <li class="text-white"><a href="{{ route('membership.form') }}"> <i class="far fa-hand-point-right"></i> Be a member</a></li>--}}
{{--                                @foreach($pages as $page)--}}
{{--                                <li><a href="{{ route('view.page',$page->slug) }}"><i class="far fa-hand-point-right"></i> {{ $page->menu_name }}</a></li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Single Widget End -->--}}

{{--                <!-- Single Widget Start -->--}}
{{--                <div class="col-lg-5 col-sm-12">--}}
{{--                    <div class="single-widget-wrap">--}}
{{--                        <h4 class="widget-title">Get In Touch</h4>--}}
{{--                        <div class="widgei-body">--}}
{{--                            <p>We won't spam your inbox.</p>--}}
{{--                            <div class="newsletter-form">--}}
{{--                                <form id="cbx-subscribe-form" role="search">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                                <input type="text" placeholder="Your Name" id="subscribe-name" required>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-5 col-md-5 col-sm-12">--}}
{{--                                                <input type="email" placeholder="Your Email"  id="subscribe-email" required>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-2 col-md-2 col-sm-12">--}}
{{--                                                <button type="submit"><i class="fas fa-paper-plane"></i></button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12" id="message"></div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                            <div class="footer-social-icons">--}}
{{--                                <a href="{{ social('facebook') }}" target="_blank" style="font-size: 3rem; color: #3b5998;"><i class="fab fa-facebook"></i></a>--}}
{{--                                <a href="{{ social('twitter') }}" target="_blank" style="font-size: 3rem; color: #00acee ;"><i class="fab fa-twitter"></i></a>--}}
{{--                                <a href="{{ social('linkedin') }}" target="_blank" style="font-size: 3rem; color: #0072b1  ;"><i class="fab fa-linkedin"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Single Widget End -->--}}




{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Footer Widget End -->--}}

{{--    <!-- Footer Bottom Start -->--}}
{{--    <div class="footer-bottom">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12 text-center">--}}
{{--                    <div class="footer-bottom-text">--}}
{{--                        <p>© {{ date('Y') }} {{ site('name') }}, All Rights Reserved.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Footer Bottom End -->--}}
{{--</footer>--}}
{{--<!--== Footer Area End ==-->--}}
<!-- footer section starts -->
<div class="container-fluid footer">
    <div class="row">
        <div class="col-md-10 col-11 mx-auto">
            <div class="row">
                <div class="col-md-4 col-11 float-start p-3">
                    <span>Our Affilations</span>
                    <div class="underline"></div>
                    <ul>
                        <li>
                            <a href="https://www.issicon.com/" target="_blank">
                                <img src="http://localhost:8000/uploads/logo/issicon.png" class="img-fluid" alt="ISSICON LOGO">
                            </a>
                        </li>

                        <li>
                            <a href="https://bsscon2021.com/" target="_blank">
                                <img src="http://localhost:8000/uploads/logo/bsscon.png" class="img-fluid" alt="BSSCON LOGO">
                            </a>
                        </li>

                        <li>
                            <a href="https://komiss.org/about/?sub_num=5" target="_blank">
                                <img src="http://localhost:8000/uploads/logo/komiss.jpg" class="img-fluid" alt="KOMISS LOGO">
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="col-md-4 col-11 float-start p-3">
                    <span>Quick Links</span>
                    <div class="underline"></div>
                    <ul>
                        <li>
                            <i class="fas fa-play"></i>
                            <a href="" index.php>Home</a>
                        </li>
                        <li>
                            <i class="fas fa-play"></i>
                            <a href="{{route('view.page','about-organization')}}">About Us</a>
                        </li>
                        <li>
                            <i class="fas fa-play"></i>
                            <a target="_blank" href="/Downloads/ASSN-ACADEMIC-CALENDAR.pdf">ASSN YEARLY ACADEMIC
                                CALENDAR</a>
                        </li>
                        <!--<li>-->
                        <!--    <i class="fas fa-play"></i>-->
                        <!--    <a href="meeting.php">Meetings</a>-->
                        <!--</li>                        -->
                        <!--<li>-->
                        <!--    <i class="fas fa-play"></i>-->
                        <!--    <a href="affilates.php">Affilate</a>-->
                        <!--</li>-->
                        <!--<li>-->
                        <!--    <i class="fas fa-play"></i>-->
                        <!--    <a href="gallery.php">Gallery</a>-->
                        <!--</li>-->
                        <li>
                            <i class="fas fa-play"></i>
                            <a href="contact-us.php">Contact </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-11 float-end p-3">
                    <div class="row">
                        <div class="col-12">
                            <span>Contact Address</span>
                            <div class="underline"></div>
                            <ul>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <a href="">{{site ('address')}}</a>
                                </li>
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <a href="">{{site ('contact')}}</a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="">{{site ('primary_email')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 pt-5">
                            <span class="d-inline">Follow Us: </span>
                            <a href="#"><i class="fab fa-facebook-square" href="#"></i></a>
                            <!--<a href="#"><i class="fab fa-twitter-square"></i></a>-->
                            <!--<a href="#"><i class="fab fa-skype"></i></a>-->
                            <!--<a href="#"><i class="fab fa-linkedin"></i></a>-->
{{--                            <div class="underline"></div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center fs-5 text-white">Supported by</p>
                    <a href="https://www.quest.com.np/" target="_blank">
                        <img src="http://localhost:8000/uploads/logo/q-logo.png" alt="" srcset="" class="rounded mx-auto d-block quest" ></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer section ends -->
<!-- lower footer -->
<div class="container-fluid lowerfooter">
    <div class="row">
        <div class="col-md-10 col-11 mx-auto">
            <div class="row">
                <span class="text-center">
                    Copyright © 2021 Association of Spine Surgeons of Nepal, All Rights Reserved.
                </span>
            </div>
        </div>
    </div>
</div>
<!-- lower footer ends -->
<!--== Scroll Top ==-->
<a href="#" class="scroll-top">
    <i class="fa fa-angle-up"></i>
</a>
<!--== Scroll Top ==-->
