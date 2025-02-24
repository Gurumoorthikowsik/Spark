
@include('MainPage.main-style')


<div class="page-wrapper">

    @include('MainPage.header')




    
    <section
    class="section-padding--top section-padding-xl--bottom section-has-bottom-margin background-repeat-no background-size-cover gray-bg about-seven"
    style="background-image: url(public/asset/images/shapes/about-seven-bg-1-1.png);">
    <div class="container">
        <div class="row gutter-y-60">
            <div class="col-lg-5">
                <div class="about-seven__content">
                    <div class="section-title">
                        <p class="section-title__text">HOW CAN HELP YOU</p><!-- /.section-title__text -->
                        <h2 class="section-title__title">Your Trusted <br> IT Solution Partner </h2>
                        <!-- /.section-title__title -->
                    </div><!-- /.section-title -->
                    <div class="about-seven__text"> we provide comprehensive IT solutions designed to transform your business and drive growth. Our expert team leverages the latest technologies to offer custom software development, digital marketing, and cybersecurity services.</div><!-- /.about-seven__text -->
                    <div class="about-seven__btns">
                        <a href="services-1.html" class="thm-btn about-seven__btn"><span>Learn More</span></a>
                        <!-- /.thm-btn about-seven__btn -->
                    </div><!-- /.about-seven__btns -->

                </div><!-- /.about-seven__content -->
            </div><!-- /.col-lg-5 -->
            <div class="col-lg-7">
                <ul class="about-seven__list">
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="000ms">
                        <i class="about-seven__list__icon icon-dashboard"></i>
                        <h3 class="about-seven__list__title">
                            <a href="{{ URL::to('/cybersecurity') }}">cyber <br>
                                Security</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="100ms">
                        <i class="about-seven__list__icon icon-system"></i>
                        <h3 class="about-seven__list__title">
                            <a href="{{ URL::to('/web-development') }}">Web <br>
                                Development</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="200ms">
                        <i class="about-seven__list__icon icon-cloud-data"></i>
                        <h3 class="about-seven__list__title">
                            <a href="{{ URL::to('/software-development') }}">Software <br>
                                Development</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="300ms">
                        <i class="about-seven__list__icon icon-data-visualization"></i>
                        <h3 class="about-seven__list__title">
                            <a href="{{ URL::to('/mobile-app-development') }}">Mobile <br>
                                App Development</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="400ms">
                        <i class="about-seven__list__icon icon-group"></i>
                        <h3 class="about-seven__list__title">
                            <a href="{{ URL::to('/digital-marketing') }}">Digital <br>
                                Marketing</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="500ms">
                        <i class="about-seven__list__icon icon-web-design"></i>
                        <h3 class="about-seven__list__title">
                            <a href="{{ URL::to('/training-course') }}">Course  <br>
                                Training</a>
                        </h3>
                    </li>
                </ul><!-- /.about-seven__list -->
            </div><!-- /.col-lg-7 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>


        <section class="section-padding--bottom about-six">
			<div class="container">
				<div class="row gutter-y-60">
					<div class="col-lg-6">
						<div class="about-six__content">
							<div class="section-title">
								<p class="section-title__text">Welcome to BraveSpark</p><!-- /.section-title__text -->
								<h2 class="section-title__title">Creative Talent, Proven Solutions, Strong IT Backbone</h2><!-- /.section-title__title -->
							</div><!-- /.section-title -->
							<div class="about-six__text">we not only deliver cutting-edge IT solutions but also empower the next generation of professionals. Our team has successfully completed numerous projects, showcasing our expertise in providing high-quality, customized solutions. Additionally, we offer specialized training programs designed to equip students with the latest industry skills, ensuring they are ready to excel in the ever-evolving tech landscape. Both our completed projects and training initiatives stand as a testament to our commitment to excellence and innovation.</div><!-- /.about-six__text -->
							<ul class="about-six__list">
								<li class="about-six__list__item">
									<i class="far fa-check-circle about-six__list__icon"></i>
									<h3 class="about-six__list__title count-box"><span class="count-text"
											data-stop="27" data-speed="1500">00</span><!-- /.count-text -->
									</h3>
									<div class="about-six__list__text">Project Delivered</div>
									<!-- /.about-six__list__text -->
								</li><!-- /.about-six__list__item -->
								<li class="about-six__list__item">
									<i class="far fa-check-circle about-six__list__icon"></i>
									<h3 class="about-six__list__title count-box"><span class="count-text"
											data-stop="73" data-speed="1500">00</span><!-- /.count-text -->
									</h3>
									<div class="about-six__list__text">Students Trained</div>
									<!-- /.about-six__list__text -->
								</li><!-- /.about-six__list__item -->
							</ul><!-- /.about-six__list -->
				
						</div><!-- /.about-six__content -->
					</div><!-- /.col-lg-6 -->
					<div class="col-lg-6">
						<div class="about-six__images wow fadeInUp" data-wow-duration="1500ms">
							<img src="{{ URL::to('/') }}/public/asset/images/resources/about-six-1-1.jpg" alt="">
							<img src="{{ URL::to('/') }}/public/asset/images/resources/about-six-1-2.jpg" alt="">
						</div><!-- /.about-six__images -->
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>


        <section class=" section-padding--top about-three about-three--home-one">
			<div class="about-three__shape wow fadeInRight" data-wow-duration="1500ms"
				style="background-image: url(public/asset/images/shapes/about-three-s-1.png);">
			</div><!-- /.about-three__shape -->
			<div class="container">
				<div class="row gutter-y-60">
					<div class="col-lg-6">
						<div class="about-three__image">
							<img src="public/asset/images/resources/about-three-1-1.png" class="wow fadeInUp"
								data-wow-duration="1500ms" alt="">
						</div><!-- /.about-three__image -->
					</div><!-- /.col-lg-6 -->
					<div class="col-lg-6">
						<div class="about-three__content">
							<div class="section-title ">
								<p class="section-title__text">BraveSpark Benefits</p><!-- /.section-title__text -->
								<h2 class="section-title__title">Why You Should Choose
									Our Services</h2><!-- /.section-title__title -->
							</div><!-- /.section-title -->
							<div class="about-three__text">Choose BraveSpark Infetech to have custom software solutions for your
								business with the most reasonable price.</div><!-- /.about-three__text -->
							<ul class="about-three__list">
								<li class="about-three__list__item">
									<div class="about-three__list__icon">
										<i class="icon-cloud"></i>
									</div><!-- /.about-three__list__icon -->
									<div class="about-three__list__content">
										<h3 class="about-three__list__title"><a href="service-cyber-security.html">IT Solutions & Cybersecurity</a></h3><!-- /.about-three__list__title -->
										<p class="about-three__list__text">BraveSpark provides reliable IT solutions, from system design to implementation, with a strong focus on cybersecurity to protect your business and data.</p><!-- /.about-three__list__text -->
									</div><!-- /.about-three__list__content -->
								</li>
								<li class="about-three__list__item">
									<div class="about-three__list__icon">
										<i class="icon-group"></i>
									</div><!-- /.about-three__list__icon -->
									<div class="about-three__list__content">
										<h3 class="about-three__list__title"><a href="team.html">App Development & Digital Marketing</a>
										</h3><!-- /.about-three__list__title -->
										<p class="about-three__list__text"> We create custom apps and effective digital marketing strategies that drive growth and enhance your online presence.</p><!-- /.about-three__list__text -->
									</div><!-- /.about-three__list__content -->
								</li>
							</ul><!-- /.about-three__list -->
						</div><!-- /.about-three__content -->
					</div><!-- /.col-lg-6 -->

				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>
        


		{{-- <section
          class="section-padding--bottom section-padding--top gray-bg testimonials-one background-repeat-no background-position-top-center"
          style="background-image: url(public/asset/images/shapes/testi-bg-2-1.png);">
          <div class="container">
            <div class="section-title text-center">
              <p class="section-title__text">Our clients</p><!-- /.section-title__text -->
              <h2 class="section-title__title">Trusted Worldwide Peoples</h2><!-- /.section-title__title -->
            </div><!-- /.section-title -->
            <div class="row gutter-y-30">
              <div class="col-lg-6">
                <div class="testimonials-one-card">
                  <div class="testimonials-one-card__image">
                    <img src="public/asset/images/resources/testi-1-1.jpg" alt="">
                  </div><!-- /.testimonials-one-card__image -->
                  <div class="testimonials-one-card__content">
                    <div class="testimonials-one-card__text">On the other hand denounc with ghteo
                      indignation and dislike men who so beguiled and demoralized the charms of pleasure
                      the momen blinded by desire cannot foresee the pain and trouble.</div>
                    <!-- /.testimonials-one-card__text -->
                    <h3 class="testimonials-one-card__title">Michal Rahul</h3>
                    <!-- /.testimonials-one-card__title -->
                    <p class="testimonials-one-card__designation">Ul - UX Designer</p>
                    <!-- /.testimonials-one-card__designation -->
                    <i class="icon-right-quote testimonials-one-card__icon"></i>
                  </div><!-- /.testimonials-one-card__content -->
                </div><!-- /.testimonials-one-card -->
              </div><!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="testimonials-one-card">
                  <div class="testimonials-one-card__image">
                    <img src="public/asset/images/resources/testi-1-2.jpg" alt="">
                  </div><!-- /.testimonials-one-card__image -->
                  <div class="testimonials-one-card__content">
                    <div class="testimonials-one-card__text">On the other hand denounc with ghteo
                      indignation and dislike men who so beguiled and demoralized the charms of pleasure
                      the momen blinded by desire cannot foresee the pain and trouble.</div>
                    <!-- /.testimonials-one-card__text -->
                    <h3 class="testimonials-one-card__title">Jessica Brown</h3>
                    <!-- /.testimonials-one-card__title -->
                    <p class="testimonials-one-card__designation">Ul - UX Designer</p>
                    <!-- /.testimonials-one-card__designation -->
                    <i class="icon-right-quote testimonials-one-card__icon"></i>
                  </div><!-- /.testimonials-one-card__content -->
                </div><!-- /.testimonials-one-card -->
              </div><!-- /.col-lg-6 -->
            </div><!-- /.ro -->
          </div><!-- /.container -->
	</section> --}}



{{-- <section class="section-padding--top section-padding--bottom">
  <div class="container">
    <div class="section-title text-center">
      <p class="section-title__text">Direct from the Blog Posts</p><!-- /.section-title__text -->
      <h2 class="section-title__title">Checkout Our Latest <br>News & Articles</h2><!-- /.section-title__title -->
    </div><!-- /.section-title -->

    <div id="blogCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <!-- First Slide -->
        <div class="carousel-item active">
          <div class="row gutter-y-30">
            <!-- Blog Post 1 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="blog-card-one">
                <div class="blog-card-one__image">
                  <img src="public/asset/images/blog/blog-1-1.jpg" alt="">
                  <a href="blog-details.html"></a>
                </div><!-- /.blog-card-one__image -->
                <div class="blog-card-one__content">
                  <div class="blog-card-one__meta">
                    <div class="blog-card-one__date">
                      <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                      July, 25, 2022
                    </div><!-- /.blog-card-one__date -->
                    <a href="blog.html" class="blog-card-one__category">Designer</a>
                  </div><!-- /.blog-card-one__meta -->
                  <h3 class="blog-card-one__title"><a href="blog-details.html">Web design done Delightful Visualization Examples</a></h3>
                  <a href="blog-details.html" class="blog-card-one__more">
                    Read More
                    <i class="fa fa-arrow-right"></i>
                  </a><!-- /.blog-card-one__more -->
                </div><!-- /.blog-card-one__content -->
              </div><!-- /.blog-card-one -->
            </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
            
            <!-- Blog Post 2 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="blog-card-one">
                <div class="blog-card-one__image">
                  <img src="public/asset/images/blog/blog-1-2.jpg" alt="">
                  <a href="blog-details.html"></a>
                </div><!-- /.blog-card-one__image -->
                <div class="blog-card-one__content">
                  <div class="blog-card-one__meta">
                    <div class="blog-card-one__date">
                      <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                      July, 25, 2022
                    </div><!-- /.blog-card-one__date -->
                    <a href="blog.html" class="blog-card-one__category">Graphic</a>
                  </div><!-- /.blog-card-one__meta -->
                  <h3 class="blog-card-one__title"><a href="blog-details.html">Technology Support Allows Erie non-profit to Serve</a></h3>
                  <a href="blog-details.html" class="blog-card-one__more">
                    Read More
                    <i class="fa fa-arrow-right"></i>
                  </a><!-- /.blog-card-one__more -->
                </div><!-- /.blog-card-one__content -->
              </div><!-- /.blog-card-one -->
            </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
            
            <!-- Blog Post 3 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="blog-card-one">
                <div class="blog-card-one__image">
                  <img src="public/asset/images/blog/blog-1-3.jpg" alt="">
                  <a href="blog-details.html"></a>
                </div><!-- /.blog-card-one__image -->
                <div class="blog-card-one__content">
                  <div class="blog-card-one__meta">
                    <div class="blog-card-one__date">
                      <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                      July, 25, 2022
                    </div><!-- /.blog-card-one__date -->
                    <a href="blog.html" class="blog-card-one__category">SEO</a>
                  </div><!-- /.blog-card-one__meta -->
                  <h3 class="blog-card-one__title"><a href="blog-details.html">Software Makes Your Profit Double if You Scale Properly</a></h3>
                  <a href="blog-details.html" class="blog-card-one__more">
                    Read More
                    <i class="fa fa-arrow-right"></i>
                  </a><!-- /.blog-card-one__more -->
                </div><!-- /.blog-card-one__content -->
              </div><!-- /.blog-card-one -->
            </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
          </div><!-- /.row gutter-y-30 -->
        </div><!-- /.carousel-item -->
        
        <!-- Second Slide -->
        <div class="carousel-item">
          <div class="row gutter-y-30">
            <!-- Blog Post 4 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="blog-card-one">
                <div class="blog-card-one__image">
                  <img src="public/asset/images/blog/blog-1-4.jpg" alt="">
                  <a href="blog-details.html"></a>
                </div><!-- /.blog-card-one__image -->
                <div class="blog-card-one__content">
                  <div class="blog-card-one__meta">
                    <div class="blog-card-one__date">
                      <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                      August, 1, 2022
                    </div><!-- /.blog-card-one__date -->
                    <a href="blog.html" class="blog-card-one__category">Marketing</a>
                  </div><!-- /.blog-card-one__meta -->
                  <h3 class="blog-card-one__title"><a href="blog-details.html">Marketing Strategy Tips for the New Year</a></h3>
                  <a href="blog-details.html" class="blog-card-one__more">
                    Read More
                    <i class="fa fa-arrow-right"></i>
                  </a><!-- /.blog-card-one__more -->
                </div><!-- /.blog-card-one__content -->
              </div><!-- /.blog-card-one -->
            </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
            
            <!-- Blog Post 5 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="blog-card-one">
                <div class="blog-card-one__image">
                  <img src="public/asset/images/blog/blog-1-5.jpg" alt="">
                  <a href="blog-details.html"></a>
                </div><!-- /.blog-card-one__image -->
                <div class="blog-card-one__content">
                  <div class="blog-card-one__meta">
                    <div class="blog-card-one__date">
                      <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                      August, 5, 2022
                    </div><!-- /.blog-card-one__date -->
                    <a href="blog.html" class="blog-card-one__category">Technology</a>
                  </div><!-- /.blog-card-one__meta -->
                  <h3 class="blog-card-one__title"><a href="blog-details.html">Tech Tools Every Business Owner Should Have</a></h3>
                  <a href="blog-details.html" class="blog-card-one__more">
                    Read More
                    <i class="fa fa-arrow-right"></i>
                  </a><!-- /.blog-card-one__more -->
                </div><!-- /.blog-card-one__content -->
              </div><!-- /.blog-card-one -->
            </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
            
            <!-- Blog Post 6 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="blog-card-one">
                <div class="blog-card-one__image">
                  <img src="public/asset/images/blog/blog-1-6.jpg" alt="">
                  <a href="blog-details.html"></a>
                </div><!-- /.blog-card-one__image -->
                <div class="blog-card-one__content">
                  <div class="blog-card-one__meta">
                    <div class="blog-card-one__date">
                      <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                      August, 10, 2022
                    </div><!-- /.blog-card-one__date -->
                    <a href="blog.html" class="blog-card-one__category">Innovation</a>
                  </div><!-- /.blog-card-one__meta -->
                  <h3 class="blog-card-one__title"><a href="blog-details.html">Innovative Ideas in Design and Development</a></h3>
                  <a href="blog-details.html" class="blog-card-one__more">
                    Read More
                    <i class="fa fa-arrow-right"></i>
                  </a><!-- /.blog-card-one__more -->
                </div><!-- /.blog-card-one__content -->
              </div><!-- /.blog-card-one -->
            </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
          </div><!-- /.row gutter-y-30 -->
        </div><!-- /.carousel-item -->
      </div><!-- /.carousel-inner -->

      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div><!-- /.carousel -->
  </div><!-- /.container -->
</section> --}}

	  



<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <a href="#" class="mobile-nav__close mobile-nav__toggler">
            <span></span>
            <span></span>
        </a>

        <div class="logo-box">
            <a href="index.html" aria-label="logo image"><img src="public/asset/images/favicons/bravespark-logo.png" width="98"
                    height="33" alt="BraveSpark"></a>
        </div>
        <!-- /.logo-box -->
        <div class="mobile-nav__container"></div>
        <!-- /.mobile-nav__container -->

        <ul class="mobile-nav__contact list-unstyled">
            {{-- <li>
                <i class="fa fa-phone"></i>
                <a href="tel:+8898006802">+ 88 ( 9800 ) 6802</a>
            </li> --}}
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:bravesparkinfotech@gmail.com">bravesparkinfotech@gmail.com</a>
            </li>
           
        </ul><!-- /.mobile-nav__contact -->
        <ul class="mobile-nav__social">
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul><!-- /.mobile-nav__social -->



    </div>
    <!-- /.mobile-nav__content -->
</div>
<!-- /.mobile-nav__wrapper -->

<div class="search-popup">
    <div class="search-popup__overlay search-toggler"></div>
    <!-- /.search-popup__overlay -->
    <div class="search-popup__content">
        <form action="#">
            <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
            <input type="text" id="search" placeholder="Search Here..." />
            <button type="submit" aria-label="search submit" class="thm-btn">
                <span><i class="icon-magnifying-glass"></i></span>
            </button>
        </form>
    </div>
    <!-- /.search-popup__content -->
</div>
<!-- /.search-popup -->





<section class="cta-one">
    <div class="container">
        <div class="cta-one__inner text-center wow fadeInUp" data-wow-duration="1500ms">
            <div class="cta-one__circle"></div><!-- /.cta-one__circle -->
         
            <div class="container">
              <p class="section-title__text">Need Any Technology Solution</p>
          <h2 class="section-title__title section-title__title--light">Let’s Work Together on Project</h2>
    
                
            </div>
				
            <a href="#" class="thm-btn thm-btn--light cta-one__btn mt-5"><span>Start Now</span></a>
            <!-- /.thm-btn thm-btn--light cta-one__btn -->
        </div><!-- /.cta-one__inner -->
    </div><!-- /.container -->
</section><!-- /.cta-one -->

@include('MainPage.main-footer')
