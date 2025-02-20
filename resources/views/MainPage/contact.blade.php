@include('MainPage.main-style')


<div class="page-wrapper">

    @include('MainPage.nav-menu')


    
		<div class="page-header">
			<div class="page-header__bg"
				style="background-image: url(public/assets/images/background/page-header-bg-1-1.jpg);"></div>
			<!-- /.page-header__bg -->
			<div class="container">
				<ul class="thm-breadcrumb list-unstyled">
					<li><a href="{{ URL::to('/') }}">Home</a></li>
					<li>Contact</li>
				</ul>
				<h2 class="page-header__title">Contact</h2><!-- /.page-header__title -->
			</div><!-- /.container -->
		</div><!-- /.page-header -->

		<section class="contact-one section-padding--top section-padding--bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<form action="https://webdevcode.com/html/cretech/assets/inc/sendemail.php" class="contact-one__form contact-form-validated">
							<div class="section-title">
								<p class="section-title__text">Contact with us</p><!-- /.section-title__text -->
								<h2 class="section-title__title">Join Us To Get IT Free
									Consultations</h2><!-- /.section-title__title -->
							</div><!-- /.section-title -->
							<div class="row ">
								<div class="col-lg-6 col-md-12">
									<input type="text" placeholder="Your name" name="name">
								</div><!-- /.col-lg-6 col-md-12 -->
								<div class="col-lg-6 col-md-12">
									<input type="email" placeholder="Email address" name="email">
								</div><!-- /.col-lg-6 col-md-12 -->
								<div class="col-lg-12 col-md-12">
									<textarea name="message" placeholder="Write message"></textarea>
								</div><!-- /.col-lg-6 col-md-12 -->
								<div class="col-md-12">
									<button class="thm-btn contact-one__btn" type="submit"><span>send a
											message</span></button>
								</div><!-- /.col-md-12 -->
							</div><!-- /.row -->
						</form><!-- /.contact-one__form -->
						<div class="result"></div><!-- / -->
					</div><!-- /.col-lg-8 -->
					<div class="col-lg-4">
						<div class="contact-one__info wow fadeInRight" data-wow-duration="1500ms"
							style="background-image: url(public/assets/images/background/contact-one-bg-1-1.png);">
							
					
						</div><!-- /.contact-one__info -->
					</div><!-- /.col-lg-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.contact-one -->


@include('MainPage.main-footer')