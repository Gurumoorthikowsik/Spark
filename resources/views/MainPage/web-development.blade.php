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
            style="background-image: url(public/new-image/Cybersecurity-Management.png);"></div>
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
                                    <p>we specialize in crafting exceptional web experiences that resonate with your business objectives. Our team of creative professionals and technical experts are committed to delivering top-tier web development solutions tailored to meet your needs. With a deep focus on both cutting-edge technologies and modern design principles, we aim to help your brand stand out in a competitive digital landscape.</p>
                                    <ul class="content-feature-list style2 list-style">
                                        <li>Innovative Web Design</li>
                                        <li>Custom Solutions</li>
                                        <li>Branding Through Design</li>
                                        <li>Website redesigning</li>
                                        <li>Static & Dynamic Websites</li>
                                        <li>Responsive Design</li>


                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="tab_2" role="tabpanel">
                            <div class="activity-card">
                        <div class="activity-card-info">
                            <h3><a href="">Web Development</a></h3>
                            <p class="text-justify">we are passionate about shaping digital experiences that drive business success. With years of expertise in web development, we specialize in delivering high-quality, innovative websites that not only look stunning but also perform flawlessly across all platforms.

                                Our team is made up of dedicated professionals who combine creative design with the latest technological advancements to provide you with a website that stands out in the crowded digital space. We work closely with you to understand your brand's vision, goals, and audience, ensuring that every website we build is tailored to your specific needs.
                                
                                We take pride in our ability to create responsive, user-friendly websites that engage and convert. Whether it's developing a simple static website, a dynamic web application, or a full-scale e-commerce platform.</p>									
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
            <h2 class="section-title__title text-center">Our Core Services</h2>
            <!-- /.section-title__title -->
        </div>


        <div class="container">
                
    
        <div class="row gutter-y-30 service-details__box-wrapper">
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-software-engineer"></i>
                    <div class="service-details__box__content">

                        <h4 class="service-details__box__title">Custom Web App Development</h4>
                        <p class="service-details__box__text">We specialize in building tailored web applications that meet your unique business needs, ensuring seamless functionality and an exceptional user experience</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-chip"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            <a href="#">Back-end & API Development</a>
                        </h3>
                        <p class="service-details__box__text">We create robust back-end systems and scalable APIs that power seamless integration and ensure smooth communication between your web applications.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-smart-tv"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            <a href="#">Responsive Web Design</a>
                        </h3>
                        <p class="service-details__box__text"> Ensures your website provides an optimal viewing experience across all devices, from desktops to mobile phones, with easy navigation and minimal resizing.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-cloud-data"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            <a href="#">Dynamic Website Design</a>
                        </h3>
                        <p class="service-details__box__text">Enables interactive and personalized user experiences by displaying content that changes based on user interactions or real-time data</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-data-visualization"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            <a href="#">E-Commerce Website Design</a>
                        </h3>
                        <p class="service-details__box__text">Specializes in creating secure, user-friendly, and visually appealing e-commerce website designs that drive sales and enhance customer experiences.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-web-development"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            <a href="#">Static Web Design</a>
                        </h3>
                        <p class="service-details__box__text">Excels in designing clean, fast-loading, and visually striking static websites that effectively showcase your brand with simplicity and elegance</p><!-- /.service-details__box__text -->
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
                            <div class="diamond" style="background-image: url('public/new-image/react.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/Angular.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/node.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/Bootstrap.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/webdeveloper.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/php.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/js.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/css.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/html.webp');"></div>
                          </div>


                    </div>

			



					<div class="col-lg-6">
						<div class="about-five__content">
							<div class="section-title ">
								<p class="section-title__text">About Company</p><!-- /.section-title__text -->
								<h2 class="section-title__title">Why Choose BraveSpark Infotech for Web Development?</h2>
								<!-- /.section-title__title -->
							</div><!-- /.section-title -->
							<div class="about-five__text">We create custom web development solutions that are aligned with your business goals, ensuring your website or application serves your unique needs.</div>
							<!-- /.about-five__text -->
							<div class="about-five__text">Our focus is on delivering seamless, user-friendly experiences that keep visitors engaged and enhance customer satisfaction.</div>
							<!-- /.about-five__text -->
						
                            <div class="about-five__text">We leverage the latest technologies and tools, ensuring your website or web application is fast, secure, and scalable.</div>

                                <div class="about-five__text">All our web projects are designed to perform beautifully on any device, ensuring optimal experiences for users across desktops, tablets, and smartphones.</div>

                                    <div class="about-five__text">We offer continuous support and regular updates, ensuring your website or application stays current, secure, and performs at its best.</div>

                                        
						
						</div><!-- /.about-five__content -->
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>

    
@include('MainPage.footer')