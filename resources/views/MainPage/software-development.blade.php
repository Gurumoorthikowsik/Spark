@include('MainPage.main-style')

<style>
          .tab-content.mt-3 {
          background-color: var(--cretech-gray, #f9f6ff);
          padding: 20px;
      }

      .single-auction-tab {
          background-color: var(--cretech-gray, #f9f6ff);
      }


      #big_diamond {
              width: 60%;
              margin: 10% auto;
              display: grid;
              grid-template-columns: repeat(3, 1fr);
              gap: 60px;
              place-items: center;
              position: relative;
              transform: rotate(45deg);
              padding: 20px;
              border-radius: 20px;
              margin-left: 15px;
          }
          
          .diamond {
              width: 100px;
              height: 100px;
              background: #fff;
              background-size: cover;
              background-position: center;
              border-radius: 10px;
              transition: transform 0.3s ease-in-out, box-shadow 0.3s;
              box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.3);
              transform: rotate(-45deg);
          }
          
          .diamond:hover {
              transform: rotate(-45deg) scale(1.1);
              box-shadow: 5px 5px 20px rgba(255, 165, 0, 0.8);
          }


</style>



<div class="page-wrapper">

    @include('MainPage.nav-menu')


    <div class="page-header">
      <div class="page-header__bg"
      style="background-image: url(public/new-image/Software-Development-Services.jpg);"></div>
        <div class="container">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="index.html">Home</a></li>
                <li>{{$title}}</li>
            </ul>
            <h2 class="page-header__title">{{$title}}</h2>
        </div>
    </div>


    


    <section class="section-padding--top section-padding--bottom about-two">

        <div class="container">
            <div class="row gutter-y-60">
            

                <div class="col-lg-6">
                    <div class="single-auction-tab">
                        <ul class="nav nav-tabs auction-tablist" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link service-details__box__title" data-bs-toggle="tab" data-bs-target="#tab_1" type="button" role="tab" aria-selected="false">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class=" service-details__box__title nav-link active" data-bs-toggle="tab" data-bs-target="#tab_2" type="button" role="tab" aria-selected="true">What We Do</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade" id="tab_1" role="tabpanel">
                                <div class="auction-item-desc">

                            <p>we specialize in delivering high-quality, innovative software development solutions tailored to meet the unique needs of businesses across various industries. Our team of experienced developers, engineers, and project managers work collaboratively to build scalable, efficient, and user-friendly software that drives business growth and enhances operational efficiency</p>
                                  <ul class="content-feature-list style2 list-style">
                                        <li>Custom Software Development</li>
                                        <li>Enterprise Software Solutions</li>
                                        <li>Mobile Application Development</li>
                                        <li>Software Integration Services</li>
                                        <li>Software Maintenance & Support</li>


                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="tab_2" role="tabpanel">
                            <div class="activity-card">
                        <div class="activity-card-info">
                            <h3><a href="">Software Development</a></h3>
                            <p class="text-justify">we specialize in delivering comprehensive software development services to help businesses solve complex challenges and achieve their goals. Our dedicated team of experts works closely with clients to create innovative, custom software solutions that enhance productivity, streamline operations, and improve overall performance</p>									
                        </div>
                    </div>										
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-6">
                    <div class="about-two__image">
                        <img src="public/asset/images/resources/about-two-1-1.jpg" alt="" class="wow fadeInUp animated" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-name: fadeInUp;">
                    </div><!-- /.about-two__image -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div>

    </section>


    <section class="section-padding--bottom service-details--page">

        <div class="section-title ">
            <p class="section-title__text text-center">BraveSpark Infotech</p><!-- /.section-title__text -->
            <h2 class="section-title__title text-center">Our Software Services</h2>
            <!-- /.section-title__title -->
        </div>


        <div class="container">
                
    
        <div class="row gutter-y-30 service-details__box-wrapper">
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-coding"></i>
                    <div class="service-details__box__content">

                        <h4 class="service-details__box__title">Custom Software Development</h4>
                        <p class="service-details__box__text">We design and build software solutions specifically tailored to your business requirements, providing personalized functionality that aligns with your goals.                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-android"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                      Mobile App Development
                        </h3>
                        <p class="service-details__box__text">We create intuitive, high-quality mobile applications for iOS and Android, ensuring a seamless experience for users across multiple devices.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-web-design"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                          Enterprise Software Solutions
                        </h3>
                        <p class="service-details__box__text"> We deliver robust, enterprise-grade software that helps businesses manage complex processes, optimize workflows, and enhance data management for large-scale operations..</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-system"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                          Software Integration & API Development
                        </h3>
                        <p class="service-details__box__text">We enable seamless integration between different software systems and build custom APIs that ensure smooth data exchange and interoperability across platforms.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-data-visualization"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                          Maintenance & Ongoing Support
                        </h3>
                        <p class="service-details__box__text">Our work doesn’t stop after deployment. We offer continuous maintenance and support to ensure your software stays secure, updated, and aligned with evolving business needs..</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-cloud"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            <a href="#">Cloud-Based Solutions</a>
                        </h3>
                        <p class="service-details__box__text">We develop scalable cloud applications that enable flexibility, accessibility, and efficiency, making your software solutions available anywhere and anytime.</p>
                    </div><!-- /.service-details__box__content -->
                </div><!-- /.service-details__box -->
            </div><!-- /.col-md-6 col-sm-12 -->







            
        </div><!-- /.row -->

        </div>

    </section>


        <section class="section-padding--bottom about-five">
			<div class="container">
				<div class="row gutter-y-60">
					<div class="col-lg-6">
 

                        
                        <div id="big_diamond">
                            <div class="diamond" style="background-image: url('public/new-image/c#.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/docker.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/github.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/mysql.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/software-developer.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/aws.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/mDB.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/java.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/python.webp');"></div>
                          </div>


                    </div>

			



					<div class="col-lg-6">
						<div class="about-five__content">
							<div class="section-title ">
								<p class="section-title__text">About Company</p>
								<h2 class="section-title__title">Why Choose BraveSpark Infotech for Software Development?</h2>
							<div class="about-five__text">we pride ourselves on our deep knowledge and experience in a wide range of technologies. From front-end development to back-end solutions, mobile app development, cloud services, AI/ML integration, and enterprise solutions, we have the skills to deliver the right solution for your project. Our team is well-versed in the latest development frameworks, programming languages, and tools, ensuring your software is built on solid, up-to-date technologies.</div>
							
              <div class="about-five__text">We understand that each business has unique needs, which is why we offer custom software development services tailored to your specific goals. Whether you're a startup or a large enterprise, our solutions are designed to meet your requirements, enhance your business processes, and help you stay ahead of the competition.</div>

                                        
						
						</div><!-- /.about-five__content -->
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>

    
@include('MainPage.footer')