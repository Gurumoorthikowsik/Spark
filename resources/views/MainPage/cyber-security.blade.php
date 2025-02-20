@include('MainPage.main-style')


<style>



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
        <!-- /.page-header__bg -->
        <div class="container">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li>Service Details</li>
            </ul>
            <h2 class="page-header__title">Cyber Security</h2><!-- /.page-header__title -->
        </div><!-- /.container -->
    </div><!-- /.page-header -->


    
		<section class="section-padding--top service-details--page">
			<div class="container">
				<div class="row ">
		
                    <h2 class="service-details__title text-center">Why Cyber Security is Important</h2>

                    <p class="service-details__content"> we recognize that cybersecurity is crucial in today’s digital age where businesses rely on technology to drive their operations. Cybersecurity is not just about protecting your data; it’s about safeguarding your entire business from various cyber threats that can disrupt operations, cause financial losses, and damage your reputation. With the rise of cyber-attacks, including ransomware, data breaches, and phishing scams, the risk to sensitive information and intellectual property is at an all-time high. Without robust cybersecurity measures in place, businesses expose themselves to significant vulnerabilities that can lead to unauthorized access, data theft, and loss of valuable assets.</p>

				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>


        <section class="section-padding--bottom service-details--page">
			<div class="container">
				<div class="row ">
		
                    <div class="row gutter-y-30 service-details__box-wrapper">
                        <div class="col-md-6 col-sm-12">
                            <div class="service-details__box">
                                <i class="service-details__box__icon icon-consulting"></i>
                                <div class="service-details__box__content">

                                    <h3 class="service-details__box__title">
                                        <a href="#">Web Vapt</a>
                                    </h3>
                                    <p class="service-details__box__text">Our Web VAPT service identifies and addresses security vulnerabilities in your web applications, simulating real-world attacks to detect weaknesses. We provide actionable solutions to strengthen your website’s defenses against potential threats.</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="service-details__box">
                                <i class="service-details__box__icon icon-chip"></i>
                                <div class="service-details__box__content">
                                    <h3 class="service-details__box__title">
                                        <a href="#">Mobile Vapt</a>
                                    </h3>
                                    <p class="service-details__box__text">Our Mobile VAPT service thoroughly tests your mobile applications for security flaws, ensuring protection against vulnerabilities like weak encryption and unauthorized access. We help secure your apps and protect user data from potential threats.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="service-details__box">
                                <i class="service-details__box__icon icon-chip"></i>
                                <div class="service-details__box__content">
                                    <h3 class="service-details__box__title">
                                        <a href="#">Network Vapt</a>
                                    </h3>
                                    <p class="service-details__box__text">With our Network VAPT service, we assess and test your network infrastructure to identify vulnerabilities such as open ports and misconfigurations. We provide solutions to fortify your network, preventing unauthorized access and cyber-attacks.</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="service-details__box">
                                <i class="service-details__box__icon icon-chip"></i>
                                <div class="service-details__box__content">
                                    <h3 class="service-details__box__title">
                                        <a href="#">Forensic Analysis</a>
                                    </h3>
                                    <p class="service-details__box__text">Our Forensic Analysis service investigates security incidents by tracing cyber-attacks, recovering critical data, and identifying the origin of breaches. We help businesses understand attacks and strengthen defenses to prevent future threats.</p>
                                </div>
                            </div>
                        </div>





                        
                    </div>



				</div>
			</div>
        	</section>



        <section class="section-padding--bottom about-five">
			<div class="container">
				<div class="row gutter-y-60">
					<div class="col-lg-6">
						<div class="about-five__images">
							<div class="about-five__images__shape"></div><!-- /.about-five__images__shape -->
							
							
                            <div id="big_diamond">
                                <div class="diamond" style="background-image: url('public/new-image/metasploit.png');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/beef.png');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/hashcat.png');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/wireshark.png');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/hacker.webp');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/autospy.jpg');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/Nmap.jpg');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/owasp-zap.webp');"></div>
                                <div class="diamond" style="background-image: url('public/new-image/burp-suite.png');"></div>
                              </div>
				
					
						</div><!-- /.about-five__images -->
					</div><!-- /.col-lg-6 -->
					<div class="col-lg-6">
						<div class="about-five__content">
							<div class="section-title ">
								<p class="section-title__text">About Company</p><!-- /.section-title__text -->
								<h2 class="section-title__title">Why Choose BraveSpark Infotech for cyber security </h2>
								<!-- /.section-title__title -->
							</div><!-- /.section-title -->
							<div class="about-five__text"> cybersecurity and penetration testing services is a decision rooted in expertise, reliability, and a commitment to safeguarding your digital assets. As cyber threats evolve, it’s essential to partner with a company that not only understands the complexities of modern cyberattacks but is also equipped to counter them effectively. BraveSpark Infotech offers a comprehensive range of cybersecurity solutions tailored to meet the specific needs of businesses, from small enterprises to large corporations.</div>
							<!-- /.about-five__text -->
							<div class="about-five__text">One of the standout qualities of BraveSpark Infotech is its team of skilled professionals with deep knowledge of the latest cybersecurity trends and techniques. Their penetration testing services are designed to simulate real-world attacks, providing you with a clear understanding of your system's vulnerabilities.</div>
							<!-- /.about-five__text -->
						
                            <div class="about-five__text"> Their penetration testing and cybersecurity services offer a critical layer of defense against the increasingly complex and persistent cyber threats of today’s digital landscape.</div>

                                
                                   
                                        
						
						</div><!-- /.about-five__content -->
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section>

    
@include('MainPage.footer')