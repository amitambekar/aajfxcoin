<?php $this->view('template2/includes/header'); ?>
    <!--Page Title-->
    <section class="page-title" style="background-image: url(<?= imagePath('assets/template2/images/background/4.jpg','',1200,0); ?>);">
        <div class="auto-container">
            <h1>Testimonials</h1>
        </div>
    </section>
    <!--End Page Title-->
    
    <!-- testimonial -->
    <section class="testimonial-section2">
        <div class="auto-container">

            <div class="row clearfix">
                <article class="col-md-4 col-sm-6 col-xs-12">
                    <div class="testimonial-item">
                        <div class="content">
                            <span class="fa fa-quote-left"></span>
                            <p>Till yet good experience, good profit, thanks to Amit sir. Option Mastery must do everyone, in option mastery till yet 100% profit, no loss.</p>
                        </div>
                        <div class="author">
                            <ul class="list-inline">
                                <li>
                                    <img src="<?= imagePath('assets/template2/images/team/5.jpg','',0,0); ?>" alt="">
                                </li>
                                <li>
                                    <h5>Bikrant Dutt</h5>
                                    <p>India</p>
                                </li>
                            </ul>
                        </div>
                    </div>     
                </article>
            </div>
        </div>
    </section>
<?php $this->view('template2/includes/footer'); ?>