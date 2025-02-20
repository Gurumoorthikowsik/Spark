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
                <li><a href="{{ URL::to('/') }}">Home</a></li>
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
                                    <p>we understand that digital marketing is the cornerstone of success in today’s online-driven world. Our comprehensive Digital Marketing services are designed to help businesses increase their online presence, reach targeted audiences, and drive meaningful engagement that converts into tangible results. Whether you're a startup looking to build your brand or an established business aiming to scale, we offer a full spectrum of innovative, result-oriented digital marketing solutions tailored to your unique goals</p>
                                    <p>Our strategic approach combines the latest industry trends, advanced tools, and data-driven insights to create custom campaigns that boost visibility and ROI. From Search Engine Optimization (SEO) that helps you rank higher on search engines, to pay-per-click (PPC) ads that drive immediate traffic, we cover it all. Our social media marketing strategies are crafted to engage with your audience effectively, and our content marketing approach focuses on delivering valuable and relevant content that resonates with potential customers</p>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="tab_2" role="tabpanel">
                            <div class="activity-card">
                        <div class="activity-card-info">
                            <h3><a href="">Digital Marketing</a></h3>
                            <p class="text-justify"> we are a full-service technology and digital solutions provider committed to delivering excellence in every project we undertake. Our team of experts combines innovation with experience to help businesses transform their digital presence and achieve their goals. Here’s what we do</p>									
                           
                           

                        
                        
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
                    <i class="service-details__box__icon icon-analysis"></i>
                    <div class="service-details__box__content">

                        <h4 class="service-details__box__title">Search Engine Optimization (SEO)</h4>
                        <p class="service-details__box__text">We implement data-driven SEO strategies that help your website rank higher on search engine results pages, driving organic traffic and increasing visibility. Our approach focuses on both on-page and off-page SEO to ensure long-term success and improved search rankings.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-web-design"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            Branding
                        </h3>
                        <p class="service-details__box__text">Our branding services are designed to create a unique identity for your business. We focus on developing a memorable brand image, voice, and message that resonates with your target audience, building trust and loyalty in the long run.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-group"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            Pay Per Click Advertising (PPC)
                        </h3>
                        <p class="service-details__box__text">Our PPC campaigns ensure that your business gets immediate visibility through targeted ads on platforms like Google Ads and social media. We optimize ad spend to maximize ROI, driving relevant traffic and increasing conversions.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-link"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            Content Marketing
                        </h3>
                        <p class="service-details__box__text">We create and distribute high-quality, valuable content to engage your audience and establish your brand as an industry leader. Our content marketing strategies are focused on building strong customer relationships and improving SEO performance.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-data-visualization"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            Mobile Advertising
                        </h3>
                        <p class="service-details__box__text">With more users accessing the web through mobile devices, we offer mobile advertising strategies that are tailored for smartphone and tablet users. Our campaigns are designed to deliver targeted, personalized ads that drive mobile app downloads, website visits, and conversions.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-web-development"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            Content Marketing
                        </h3>
                        <p class="service-details__box__text">We deliver impactful content marketing strategies to tell your brand’s story. From blog posts and articles to videos and infographics, our team ensures your content engages, educates, and converts potential customers into loyal advocates.</p><!-- /.service-details__box__text -->
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
                            <div class="diamond" style="background-image: url('public/new-image/digital.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/sound-marketing.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/smm.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/content-marketing.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/Digital-marketer.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/ads.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/payper.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/branding.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/seo.webp');"></div>
                          </div>


                    </div>

			



					<div class="col-lg-6">
						<div class="about-five__content">
							<div class="section-title ">
								<p class="section-title__text">About Company</p><!-- /.section-title__text -->
								<h2 class="section-title__title">Why Choose BraveSpark Infotech for Digital Marketing?</h2>
								<!-- /.section-title__title -->
							</div><!-- /.section-title -->
							<div class="about-five__text">BraveSpark Infotech, we deliver tailored digital marketing solutions that help businesses succeed in today’s competitive online world.</div>
							<!-- /.about-five__text -->
							<div class="about-five__text">Our team of experts is committed to driving measurable results through innovative strategies and a deep understanding of your industry. We prioritize a data-driven approach, ensuring that every decision is backed by insights to maximize ROI. Whether it's SEO, PPC, branding, or content marketing, we offer end-to-end services that create a cohesive online presence for your business. We are dedicated to staying ahead of trends, using the latest tools and technologies to ensure your business stands out and thrives in the digital landscape</div>
							<!-- /.about-five__text -->
						
                            <div class="about-five__text">By partnering with BraveSpark Infotech, you're not just investing in a service; you're securing a long-term, growth-focused relationship.</div>

                              
                                        
						
						</div><!-- /.about-five__content -->
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>

    
@include('MainPage.footer')