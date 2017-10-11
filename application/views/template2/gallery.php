<?php $this->view('template2/includes/header'); ?>
    <!--Page Title-->
    <section class="page-title" style="background-image: url(<?= imagePath('assets/template2/images/background/4.jpg','',1200,0); ?>);">
        <div class="auto-container">
            <h1>Gallery</h1>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Projects Section-->
    <section class="projects">
        <div class="auto-container">
            <div class="row clearfix masonary-layout filter-layout">
                <!--Default Portfolio Item-->
                <div class="default-portfolio-item Growth col-md-4 col-sm-6 col-xs-12">
                    <div class="inner hover-style1">
                        <figure class="hover-style1-img">
                            <img src="<?= imagePath('assets/template2/aajfxcoin/video.jpg','',1000,666,false); ?>" alt="image">
                            <div class="hover-style1-view">
                                <a href="https://www.youtube.com/watch?v=Ybt9ScBSHss" class="overlay-link lightbox-image video-fancybox"><span class="icon flaticon-arrow"></span></a>
                                </a>                                
                            </div>
                        </figure>
                        <div class="hover-style1-title title-style-1">
                            <h3><a href="#">Online Trading Institute</a></h3>
                            <span>How To Make Money Part 1</span>
                        </div>
                    </div>
                </div>

                <!--Default Portfolio Item-->
                <div class="default-portfolio-item Growth col-md-4 col-sm-6 col-xs-12">
                    <div class="inner hover-style1">
                        <figure class="hover-style1-img">
                            <img src="<?= imagePath('assets/template2/aajfxcoin/video.jpg','',1000,666,false); ?>" alt="image">
                            <div class="hover-style1-view">
                                <a href="https://www.youtube.com/watch?v=mH1D5KedBgw" class="overlay-link lightbox-image video-fancybox"><span class="icon flaticon-arrow"></span></a>
                                </a>                                
                            </div>
                        </figure>
                        <div class="hover-style1-title title-style-1">
                            <h3><a href="#">Online Trading Institute</a></h3>
                            <span>How To Make Money Part 2</span>
                        </div>
                    </div>
                </div>
                
                <!--Default Portfolio Item-->
                <!--<div class="default-portfolio-item Consulting Marketing col-md-4 col-sm-6 col-xs-12">
                    <div class="inner hover-style1">
                        <figure class="hover-style1-img">
                            <img src="<?= imagePath('assets/template2/images/gallery/1.jpg','',1000,666,false); ?>" alt="image">
                            <div class="hover-style1-view">
                                <a class="lightbox-image option-btn" title="Image Caption Here" data-fancybox-group="example-gallery" href="<?= imagePath('assets/template2/images/gallery/1.jpg','',1000,666,false); ?>">
                                    <i class="fa fa-eye"></i>
                                </a>                                
                            </div>
                        </figure>
                        <div class="hover-style1-title title-style-1">
                            <h3><a href="#">project title</a></h3>
                            <span>client name</span>
                        </div>
                    </div>
                </div>-->                
            </div>
        </div>
    </section>
    <!--End Projects Section-->
<?php $this->view('template2/includes/footer'); ?>