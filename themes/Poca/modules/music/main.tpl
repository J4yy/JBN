<!--BEGIN: main-->

<!-- ***** Welcome Area Start ***** -->
<section class="welcome-area">
    <!-- Single Welcome Slide -->
    <div class="welcome-welcome-slide bg-img bg-overlay"
        style="background-image: url({NV_BASE_SITEURL}modules/music/assets/1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h2 data-animation="fadeInUp" data-delay="100ms">Poca Premium</h2>
                        <h5 data-animation="fadeInUp" data-delay="300ms">Tận hưởng nghe nhạc miễn phí chất lượng cao
                            không giới hạn <br> không quảng cáo và nhiều tiện ích hấp dẫn
                        </h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ***** Welcome Area End ***** -->


<!-- ***** Latest Episodes Area Start ***** -->
<section class="poca-latest-epiosodes section-padding-80">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Nghe Nhạc Miễn Phí Không Giới Hạn</h2>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Menu
    <div class="container">
        <div class="poca-projects-menu mb-30 wow fadeInUp" data-wow-delay="0.3s">
            <div class="text-center portfolio-menu">
                <button class="btn active" data-filter="*">All</button>
                <button class="btn" data-filter=".entre">Entrepreneurship</button>
                <button class="btn" data-filter=".media">Media</button>
                <button class="btn" data-filter=".tech">Tech</button>
                <button class="btn" data-filter=".tutor">Tutorials</button>
            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="row poca-portfolio">
            <!-- BEGIN: loopp -->
            <div class="col-12 col-md-6 single_gallery_item entre wow fadeInUp" data-wow-delay="0.2s">
                <!-- Welcome Music Area -->
                <div class="poca-music-area style-2 d-flex align-items-center flex-wrap">
                    <div class="poca-music-thumbnail">
                        <img src="{NV_BASE_SITEURL}uploads/music/image/{SONG.IMAGE}" alt="">
                    </div>
                    <div class="poca-music-content text-center">
                        <span class="music-published-date mb-2">{SONG.UPDATETIME}</span>
                        <h2>{SONG.TENBAIHAT}</h2>
                        <div class="music-meta-data">
                            <p>Ca sĩ: {SONG.TENCASI} | Thể loại: {SONG.TENTHELOAI}</p>
                        </div>
                        <!-- Music Player -->
                        <div class="poca-music-player">
                            <audio preload="auto" controls>
                                <source src="{NV_BASE_SITEURL}uploads/music/music/{SONG.PART}">
                            </audio>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: loopp -->
        </div>
    </div>
</section>
<!-- ***** Latest Episodes Area End ***** -->


<!--END: main-->