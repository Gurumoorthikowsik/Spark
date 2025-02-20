
<?php echo $__env->make('MainPage.main-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="page-wrapper">


  <?php echo $__env->make('MainPage.nav-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



  
  <div class="slider-one slider-two">
    <ul class="slider-two__social">
      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
      <li><a href="#"><i class="fab fa-facebook"></i></a></li>
      <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
    </ul><!-- /.topbar__social -->
    <div class="slider-one__carousel owl-carousel owl-theme thm-owl__carousel"
      data-owl-options='{"loop": true, "items": 1, "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"], "margin": 0, "dots": true, "nav": true, "animateOut": "slideOutDown", "animateIn": "fadeIn", "active": true, "smartSpeed": 1000, "autoplay": true, "autoplayTimeout": 7000, "autoplayHoverPause": false}'>
      <div class="item slider-one__slide-1">
        <div class="slider-one__bg" style="background-image: url(public/asset/images/background/slider-2-1.jpg);">
        </div><!-- /.slider-one__bg -->
        <div class="slider-one__shape-1"></div><!-- /.slider-one__shape-1 -->
        <div class="container">
          <div class="slider-one__content ">
            <div class="slider-one__title-wrapper">
              <h2 class="slider-one__title">Ignite Your <br>
                Career with  <br>
                BraveSpark </h2><!-- /.slider-one__title -->
            </div><!-- /.slider-one__title-wrapper -->
            <div class="slider-one__btns">
              <a href="<?php echo e(URL::to('/')); ?>" class="thm-btn slider-one__btn"><span>Learn More</span></a>
              <!-- /.thm-btn slider-one__btn -->
            </div><!-- /.slider-one__btns -->
          </div><!-- /.slider-one__content -->
        </div><!-- /.container -->
      </div><!-- /.item -->
      <div class="item slider-one__slide-2">
        <div class="slider-one__bg" style="background-image: url(public/asset/images/background/slider-2-2.jpg);">
        </div><!-- /.slider-one__bg -->
        <div class="slider-one__shape-1"></div><!-- /.slider-one__shape-1 -->
        <div class="container">
          <div class="slider-one__content ">
            <div class="slider-one__title-wrapper">
              <h2 class="slider-one__title">Enroll in  <br>
                Our Expert-Led  <br>
                Training Programs</h2><!-- /.slider-one__title -->
            </div><!-- /.slider-one__title-wrapper -->
            <div class="slider-one__btns">
              <a href="<?php echo e(URL::to('/')); ?>" class="thm-btn slider-one__btn"><span>Learn More</span></a>
              <!-- /.thm-btn slider-one__btn -->
            </div><!-- /.slider-one__btns -->
          </div><!-- /.slider-one__content -->
        </div><!-- /.container -->
      </div><!-- /.item -->
    </div><!-- /.slider-one__carousel -->
  </div><!-- /.slider-one -->

    

  <section class="section-padding--top service-details--page section-padding-lg--bottom">


      <div class="col-lg-12 ">
        <h2 class="mb-5 section-title__title text-center">Our Courses</h2>
      </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="card" style="width: 18rem;">
            <img src="public/new-image/web-design.webp" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center">Web Designing</h5>
            </div>
          </div>
        </div>


        <div class="col-lg-3">
          <div class="card" style="width: 18rem;">
            <img src="public/new-image/mern.webp" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center">MERN Stack</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="card" style="width: 18rem;">
            <img src="public/new-image/fullstack.webp" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center">Python </h5>
            </div>
          </div>
        </div>


        
        <div class="col-lg-3">
          <div class="card" style="width: 18rem;">
            <img src="public/new-image/java-developer.webp" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center">Java </h5>
            </div>
          </div>
        </div>






      </div>
    </div>

  </section>



<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="mb-5 section-title__title text-center">Why BraveSparkinfotech</h2>

      <p class="testimonials-one-card__text text-center">Empowering the next generation of tech talent with real-world skills through BraveSparkinfotech fostering industry connections that drive career success and innovation.</p>
    </div>
  </div>
</div>


<style>
      .floating-icons {
          position: relative;
          width: 100%;
          height: 500px;
          display: flex;
          justify-content: center;
          align-items: center;
          background-color: #f8f9fa; /* Light background for better visibility */
      }

      .circle-container {
          position: relative;
          width: 300px;
          height: 300px;
          border-radius: 50%;
          display: flex;
          justify-content: center;
          align-items: center;
          animation: rotate-circle 20s linear infinite;
      }

      .floating-icon {
          position: absolute;
          width: 50px;
          height: 50px;
          transform: rotate(var(--angle)) translate(150px);
          transition: transform 0.5s ease-in-out;
      }

      @keyframes  rotate-circle {
          from {
              transform: rotate(0deg);
          }
          to {
              transform: rotate(360deg);
          }
      }
</style>



<section class="service-details--page section-padding-lg--bottom">
  <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="accrodion-grp service-details__accrodion"
            data-grp-name="service-details__accrodion-1">
            <!--Start Faq One Single-->
            <div class="accrodion  wow fadeInUp" data-wow-delay="0ms">
              <div class="accrodion-title">
                <h4>Real Projects<span
                    class="accrodion-icon"></span>
                </h4>
              </div>
              <div class="accrodion-content">
                <div class="inner">
                  <p>Work on cutting-edge projects that solve real-world problems. Gain hands-on experience while building a strong portfolio that impresses employers.</p>
                </div>
              </div>
            </div>
            <!-- End Faq One Single-->
            <!--Start Faq One Single-->
            <div class="accrodion active wow fadeInUp" data-wow-delay="0ms">
              <div class="accrodion-title">
                <h4>Certifications<span
                    class="accrodion-icon"></span></h4>
              </div>
              <div class="accrodion-content">
                <div class="inner">
                  <p>Get industry-recognized certifications that validate your expertise and boost your credibility. Stand out in job applications with verified skills.</p>
                </div>
              </div>
            </div>
            <!-- End Faq One Single-->
            <!--Start Faq One Single-->
            <div class="accrodion  wow fadeInUp" data-wow-delay="0ms">
              <div class="accrodion-title">
                <h4>Live Classes <span
                    class="accrodion-icon"></span></h4>
              </div>
              <div class="accrodion-content">
                <div class="inner">
                  <p>Attend interactive live sessions with expert instructors. Ask questions, collaborate with peers, and enhance your learning in real-time.</p>
                </div>
              </div>
            </div>
            <!-- End Faq One Single-->
            <!--Start Faq One Single-->
            <div class="accrodion  wow fadeInUp" data-wow-delay="0ms">
              <div class="accrodion-title">
                <h4>Skill Development<span
                    class="accrodion-icon"></span>
                </h4>
              </div>
              <div class="accrodion-content">
                <div class="inner">
                  <p>Enhance your technical and soft skills with structured training, industry insights, and hands-on exercises tailored to your career goals.</p>
                </div>
              </div>
            </div>
            <!-- End Faq One Single-->
          </div>
        </div><!-- /.col-md-12 -->



        <div class="col-lg-6">
          
      
          <section class="floating-icons">
            <div class="circle-container">
                <img src="public/new-image/figma.webp" class="floating-icon" style="--angle: 0deg;">
                <img src="public/new-image/html.webp" class="floating-icon" style="--angle: 36deg;">
                <img src="public/new-image/css.webp" class="floating-icon" style="--angle: 72deg;">
                <img src="public/new-image/js.webp" class="floating-icon" style="--angle: 108deg;">
                <img src="public/new-image/Bootstrap.webp" class="floating-icon" style="--angle: 144deg;">
                <img src="public/new-image/react.webp" class="floating-icon" style="--angle: 180deg;">
                <img src="public/new-image/python.webp" class="floating-icon" style="--angle: 216deg;">
                <img src="public/new-image/mDB.webp" class="floating-icon" style="--angle: 252deg;">
                <img src="public/new-image/github.webp" class="floating-icon" style="--angle: 288deg;">
                <img src="public/new-image/flutter.webp" class="floating-icon" style="--angle: 324deg;">
                
                <img src="public/new-image/angular.web" class="floating-icon" style="--angle: 324deg;">
                <img src="public/new-image/aws.webp" class="floating-icon" style="--angle: 324deg;">
                <img src="public/new-image/mysql.webp" class="floating-icon" style="--angle: 324deg;">
                <img src="public/new-image/Node.js_logo.svg" class="floating-icon" style="--angle: 324deg;">



                
              </div>
        </section>
     


      </div><!-- /.row -->
    </div>
</section>




    <section class="service-details--page section-padding-lg--bottom">
      <div class="container">
        <div class="section-title text-center">
          <p class="section-title__text">Our Student Review</p><!-- /.section-title__text -->
        </div><!-- /.section-title -->
    
        <div class="row">
          <!-- Left Card with Carousel -->
          <div class="col-lg-6">
              <div class="card-body">
                
                <!-- Carousel for Left Card -->
                <div id="leftReviewCarousel" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <!-- Left Review Item 1 -->
                    <div class="carousel-item active">
                      <div class="testimonials-one-card">
                        <div class="testimonials-one-card__image">
                          <img src="public/new-image/dineshkumar-review.png" alt="">
                        </div><!-- /.testimonials-one-card__image -->
                        <div class="testimonials-one-card__content">
                          <div class="testimonials-one-card__text">A great platform with affordable courses. The Quality of the web designing courses are solid. The  experience is great with challenging tasks and real world industry knowledge. Overall, I would strongly recommend the platform for freshers as it bridges the gap between your degree and your workplace.
                          </div>
                          <h3 class="testimonials-one-card__title">Dinesh Kumar</h3>
                          <p class="testimonials-one-card__designation">Web Designing</p>
                          <i class="icon-right-quote testimonials-one-card__icon"></i>
                        </div><!-- /.testimonials-one-card__content -->
                      </div><!-- /.testimonials-one-card -->
                    </div><!-- /.carousel-item -->
    
                    <!-- Left Review Item 2 -->
                    <div class="carousel-item">
                      <div class="testimonials-one-card">
                        <div class="testimonials-one-card__image">
                          <img src="public/new-image/tv-sudharasan.png" alt="">
                        </div><!-- /.testimonials-one-card__image -->
                        <div class="testimonials-one-card__content">
                          <div class="testimonials-one-card__text">The best part of this training Course is can learn everything from basic to advanced and do practicaly the bestest platform I have seen ever to enhance my skills thanks BraveSpark                          </div>
                          <h3 class="testimonials-one-card__title">T.V. Sudharasan</h3>
                          <p class="testimonials-one-card__designation">Web Designing</p>
                          <i class="icon-right-quote testimonials-one-card__icon"></i>
                        </div><!-- /.testimonials-one-card__content -->
                      </div><!-- /.testimonials-one-card -->
                    </div><!-- /.carousel-item -->


                    <!-- Left Review Item 2 -->
                    <div class="carousel-item">
                      <div class="testimonials-one-card">
                        <div class="testimonials-one-card__image"> 
                          <img src="public/new-image/diya.png" alt="">  
                        </div><!-- /.testimonials-one-card__image -->
                        <div class="testimonials-one-card__content">
                          <div class="testimonials-one-card__text">It was an incredible experience interning at BraveSpark. I had the opportunity to learn a great deal about Core Python. The mentors were incredibly supportive and helpful, guiding me throughout my project assignments. My experience at BraveSparkinfotech has truly been invaluable.</div>
                          <h3 class="testimonials-one-card__title">Suguneshwari</h3>
                          <p class="testimonials-one-card__designation">Python </p>
                          <i class="icon-right-quote testimonials-one-card__icon"></i>
                        </div><!-- /.testimonials-one-card__content -->
                      </div><!-- /.testimonials-one-card -->
                    </div><!-- /.carousel-item -->

    
                  </div><!-- /.carousel-inner -->
    
                  <!-- Carousel Controls -->
                  <button class="carousel-control-prev" type="button" data-bs-target="#leftReviewCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#leftReviewCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div><!-- /.carousel -->
              </div><!-- /.card-body -->
           
          </div><!-- /.col-lg-6 -->
    
          <!-- Right Card with Carousel -->
          <div class="col-lg-6">
              <div class="card-body">
                <!-- Carousel for Right Card -->
                <div id="rightReviewCarousel" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <!-- Right Review Item 1 -->
                    <div class="carousel-item active">
                      <div class="testimonials-one-card">
                        <div class="testimonials-one-card__image">
                          <img src="public/new-image/divya.png" alt="">  
                        </div><!-- /.testimonials-one-card__image -->
                        <div class="testimonials-one-card__content">
                          <div class="testimonials-one-card__text">I am a mern stack developer (beginner). I done an Course in BraveSparkInfoetch. It is a wonderful experience and gained more knowledge and experience.</div>
                          <h3 class="testimonials-one-card__title">Divya</h3>
                          <p class="testimonials-one-card__designation">Web Developer</p>
                          <i class="icon-right-quote testimonials-one-card__icon"></i>
                        </div><!-- /.testimonials-one-card__content -->
                      </div><!-- /.testimonials-one-card -->
                    </div><!-- /.carousel-item -->
    
                    <!-- Right Review Item 2 -->
                    <div class="carousel-item">
                      <div class="testimonials-one-card">
                        <div class="testimonials-one-card__image">
                          <img src="public/new-image/devika.png" alt="">
                        </div><!-- /.testimonials-one-card__image -->
                        <div class="testimonials-one-card__content">
                          <div class="testimonials-one-card__text">Great experience at your organization. Helped and gained remarkable knowledge and practical experience.</div>
                          <h3 class="testimonials-one-card__title">Devika</h3>
                          <p class="testimonials-one-card__designation">Java Developer</p>
                          <i class="icon-right-quote testimonials-one-card__icon"></i>
                        </div><!-- /.testimonials-one-card__content -->
                      </div><!-- /.testimonials-one-card -->
                    </div><!-- /.carousel-item -->
    
                  </div><!-- /.carousel-inner -->
    
                  <!-- Carousel Controls -->
                  <button class="carousel-control-prev" type="button" data-bs-target="#rightReviewCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#rightReviewCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div><!-- /.carousel -->
              </div><!-- /.card-body -->
     
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section>
    

  
    <section class="section-padding--bottom">
      <div class="container">
        <div class="section-title text-center">
          <h2 class="section-title__title">Our Student Latest Project</h2><!-- /.section-title__title -->
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
                      <img src="public/new-image/1.png" alt="">
                      <a href="<?php echo e(URL::to('/')); ?>"></a>
                    </div><!-- /.blog-card-one__image -->
                    <div class="blog-card-one__content">
                      <div class="blog-card-one__meta">
                        <div class="blog-card-one__date"></div><!-- /.blog-card-one__date -->
                      </div><!-- /.blog-card-one__meta -->
                      <h3 class="blog-card-one__title text-center">Dinesh Kumar</h3>
                      <div class="text-center">
                        <a href="#!" class="blog-card-one__category" data-bs-toggle="modal" data-bs-target="#imageModal">Project</a>
                      </div>
                    </div><!-- /.blog-card-one__content -->
                  </div><!-- /.blog-card-one -->
                </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
                
                <!-- Blog Post 2 -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="blog-card-one">
                    <div class="blog-card-one__image">
                      <img src="public/new-image/3 (1).png" alt="">
                      <a href="<?php echo e(URL::to('/')); ?>"></a>
                    </div><!-- /.blog-card-one__image -->
                    <div class="blog-card-one__content">
                      <h3 class="blog-card-one__title text-center">T.V Sudharasan</h3>
                      <div class="text-center">
                        <a href="#!" class="blog-card-one__category" data-bs-toggle="modal" data-bs-target="#imageModal3">Project</a>
                      </div>
                    </div><!-- /.blog-card-one__content -->
                  </div><!-- /.blog-card-one -->
                </div><!-- /.col-lg-4 col-md-6 col-sm-12 -->
                
                <!-- Blog Post 3 -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="blog-card-one">
                    <div class="blog-card-one__image">
                      <img src="public/new-image/5.png" alt="">
                      <a href="<?php echo e(URL::to('/')); ?>"></a>
                    </div><!-- /.blog-card-one__image -->
                    <div class="blog-card-one__content">
                      <h3 class="blog-card-one__title text-center">Divya</h3>
                      <div class="text-center">
                        <a href="#!" class="blog-card-one__category" data-bs-toggle="modal" data-bs-target="#imageModal3">Project</a>
                      </div>               
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
                      <img src="public/new-image/6.png" alt="">
                      <a href="<?php echo e(URL::to('/')); ?>"></a>
                    </div><!-- /.blog-card-one__image -->
                    <div class="blog-card-one__content">
                      <h3 class="blog-card-one__title text-center">Hari</h3>
                      <div class="text-center">
                        <a href="#!" class="blog-card-one__category" data-bs-toggle="modal" data-bs-target="#imageModal4">Project</a>
                      </div>
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
    </section>
      




    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Image View</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>


              <div class="modal-body text-center">
                  <img src="public/new-image/1.png" alt="Image" class="img-fluid">

                  <img src="public/new-image/2.png" alt="Image" class="img-fluid">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>


    <div class="modal fade" id="imageModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Image View</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>


              <div class="modal-body text-center">
                  <img src="public/new-image/3 (1).png" alt="Image" class="img-fluid">

                  <img src="public/new-image/3 (2).png" alt="Image" class="img-fluid">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>


  <div class="modal fade" id="imageModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body text-center">
                <img src="public/new-image/4.png" alt="Image" class="img-fluid">

                <img src="public/new-image/5.png" alt="Image" class="img-fluid">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="imageModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Image View</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>


          <div class="modal-body text-center">
              <img src="public/new-image/6.png" alt="Image" class="img-fluid">

              <img src="public/new-image/7.png" alt="Image" class="img-fluid">

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<?php echo $__env->make('MainPage.main-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\dashboard\code\GIT\Spark\resources\views/MainPage/course-page.blade.php ENDPATH**/ ?>