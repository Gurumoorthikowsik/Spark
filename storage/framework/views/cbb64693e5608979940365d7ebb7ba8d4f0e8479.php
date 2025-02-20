
<?php echo $__env->make('MainPage.main-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="page-wrapper">

    <?php echo $__env->make('MainPage.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




    
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
                            <a href="<?php echo e(URL::to('/cybersecurity')); ?>">cyber <br>
                                Security</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="100ms">
                        <i class="about-seven__list__icon icon-system"></i>
                        <h3 class="about-seven__list__title">
                            <a href="<?php echo e(URL::to('/web-development')); ?>">Web <br>
                                Development</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="200ms">
                        <i class="about-seven__list__icon icon-cloud-data"></i>
                        <h3 class="about-seven__list__title">
                            <a href="<?php echo e(URL::to('/software-development')); ?>">Software <br>
                                Development</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="300ms">
                        <i class="about-seven__list__icon icon-data-visualization"></i>
                        <h3 class="about-seven__list__title">
                            <a href="<?php echo e(URL::to('/mobile-app-development')); ?>">Mobile <br>
                                App Development</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="400ms">
                        <i class="about-seven__list__icon icon-group"></i>
                        <h3 class="about-seven__list__title">
                            <a href="<?php echo e(URL::to('/digital-marketing')); ?>">Digital <br>
                                Marketing</a>
                        </h3>
                    </li>
                    <li class="about-seven__list__item text-center wow fadeInLeft" data-wow-duration="1500ms"
                        data-wow-delay="500ms">
                        <i class="about-seven__list__icon icon-web-design"></i>
                        <h3 class="about-seven__list__title">
                            <a href="<?php echo e(URL::to('/training-course')); ?>">Course  <br>
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
							<img src="<?php echo e(URL::to('/')); ?>/public/asset/images/resources/about-six-1-1.jpg" alt="">
							<img src="<?php echo e(URL::to('/')); ?>/public/asset/images/resources/about-six-1-2.jpg" alt="">
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
										<p class="about-three__list__text">raveSpark provides reliable IT solutions, from system design to implementation, with a strong focus on cybersecurity to protect your business and data</p><!-- /.about-three__list__text -->
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
            <li>
                <i class="fa fa-phone"></i>
                <a href="tel:+8898006802">+ 88 ( 9800 ) 6802</a>
            </li>
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
          <h2 class="section-title__title section-title__title--light">Let’s Work Togather on Project</h2>
    
                
            </div>
				
            <a href="#" class="thm-btn thm-btn--light cta-one__btn mt-5"><span>Start Now</span></a>
            <!-- /.thm-btn thm-btn--light cta-one__btn -->
        </div><!-- /.cta-one__inner -->
    </div><!-- /.container -->
</section><!-- /.cta-one -->

<?php echo $__env->make('MainPage.main-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\dashboard\code\learnGit\example-app\resources\views/MainPage/Index.blade.php ENDPATH**/ ?>