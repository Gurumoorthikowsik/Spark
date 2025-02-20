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
                                    <p>we specialize in creating high-quality, user-friendly mobile applications that cater to a wide range of industries. With the ever-growing reliance on mobile devices, having a well-designed mobile app is essential for businesses to engage with their customers, streamline operations, and stay competitive. Our mobile app development services focus on delivering innovative, scalable, and secure applications tailored to meet your unique business needs.</p>
                                    <p>Our expertise spans across various industries, including e-commerce, healthcare, finance, education, and entertainment, allowing us to create customized mobile solutions that fit the specific requirements of each sector. Whether it’s building a robust mobile app for a large corporation or a simple, functional app for a startup, BraveSpark Infotech provides end-to-end mobile app development solutions that drive business success.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="tab_2" role="tabpanel">
                            <div class="activity-card">
                        <div class="activity-card-info">
                            <h3><a href="">Mobile App Development</a></h3>
                            <p class="text-justify"> we are dedicated to crafting innovative and impactful mobile applications that empower businesses to engage their customers, improve operations, and achieve digital success. Our mobile app development services encompass the entire lifecycle – from initial concept and strategy to design, development, deployment, and ongoing support. Here's a closer look at what we do</p>									
                           
                           

                        
                        
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

                        <h4 class="service-details__box__title">Custom Mobile App Development</h4>
                        <p class="service-details__box__text">We specialize in developing custom mobile apps that are tailored to your business needs. Whether you need an app for iOS, Android, or both, our team of experts ensures your app is designed to provide the best user experience, functionality, and performance. </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-chip"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            Cross-Platform Development
                        </h3>
                        <p class="service-details__box__text">To help you reach a broader audience, we offer cross-platform mobile app development services. Our developers use technologies like React Native, Flutter, and Xamarin to create apps that work seamlessly across multiple platforms while maintaining a native-like experience.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-smart-tv"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            UI/UX Design
                        </h3>
                        <p class="service-details__box__text">We focus on creating intuitive, engaging, and aesthetically pleasing designs that enhance user experience (UX) and ensure usability. Our UI/UX design team works closely with clients to understand their vision and deliver visually appealing, easy-to-navigate mobile apps that captivate users from the first touch.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-cloud-data"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            App Integration Services
                        </h3>
                        <p class="service-details__box__text">We understand the importance of connecting your mobile app to existing systems or third-party tools. Our integration services ensure that your app can interact smoothly with databases, APIs, cloud services, and other enterprise systems, providing a seamless experience for your users</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-data-visualization"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            App Maintenance & Support
                        </h3>
                        <p class="service-details__box__text">The mobile app development process doesn’t stop at launch. We provide comprehensive post-launch support and maintenance to ensure your app stays up-to-date, secure, and fully optimized. Whether you need updates, bug fixes, or performance improvements, we are here to support your app every step of the way</p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="service-details__box">
                    <i class="service-details__box__icon icon-web-development"></i>
                    <div class="service-details__box__content">
                        <h3 class="service-details__box__title">
                            App Testing & Quality Assurance
                        </h3>
                        <p class="service-details__box__text">We take quality seriously. Our team conducts rigorous testing to identify and resolve any issues before your app hits the market. We perform functional testing, usability testing, performance testing, and security testing to ensure that the app performs seamlessly under all conditions.
                        </p><!-- /.service-details__box__text -->
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
                            <div class="diamond" style="background-image: url('public/new-image/ios.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/kotlin.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/fullter.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/adobexd.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/mobile-developer.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/firebase.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/figma.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/swift.webp');"></div>
                            <div class="diamond" style="background-image: url('public/new-image/android-studio.webp');"></div>
                          </div>


                    </div>

			



					<div class="col-lg-6">
						<div class="about-five__content">
							<div class="section-title ">
								<p class="section-title__text">About Company</p><!-- /.section-title__text -->
								<h2 class="section-title__title">Why Choose BraveSpark Infotech for Mobile App Development?</h2>
								<!-- /.section-title__title -->
							</div><!-- /.section-title -->
							<div class="about-five__text">we have extensive experience in developing apps for iOS, Android, and cross-platform solutions. Our team is proficient in utilizing the latest technologies like Swift, Kotlin, React Native, and Flutter to build apps that work seamlessly across various devices.</div>
							<!-- /.about-five__text -->
							<div class="about-five__text">We understand that each business is unique, and so are its app requirements. Our approach is highly personalized to meet your specific needs and objectives. From concept to development, we collaborate closely with you to create an app that aligns perfectly with your brand and goals.</div>
							<!-- /.about-five__text -->
						
                            <div class="about-five__text">The success of any app lies in how user-friendly and intuitive it is. Our UI/UX experts focus on crafting clean, modern, and visually appealing designs that enhance user engagement and ensure ease of use. We strive to provide a smooth, enjoyable experience for your users from the moment they open your app</div>

                              
                                        
						
						</div><!-- /.about-five__content -->
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>

    
@include('MainPage.footer')