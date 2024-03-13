@extends('web.layouts.home') 
@section('content')
<section>
    <div class="banner-1 cover-image sptb-2 sptb-tab bg-background2" data-bs-image-src="../assets/web/assets/images/banners/banner_1.jpg" style="background: url('../assets/images/banners/banner_1.jpg') center center;">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white mb-7">
                    <h2 class="mb-2">Final Ideal Workspaces and Professional Service</h2>
                    <h2 class="mb-2">anywhere anytime</h2>
                    <!-- <p>Let's work together to preserve our environment and local communities</p> -->
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-10 d-block mx-auto">
                        <div class="search-background bg-transparent">
                            <div class="form row no-gutters">
                                <div class="form-group col-xl-7 col-lg-7 col-md-12 mb-0">
                                    <input type="text" class="form-control input-lg br-tr-md-0 br-br-md-0" id="text4" placeholder="Search Location" />
                                    <span><i class="fa fa-map-marker location-gps me-1" style="font-size: 18px;"></i> </span>
                                </div>
                                <div class="form-group col-xl-3 col-lg-3 col-md-12 mb-0">
                                    <select class="form-control select2 form-select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value="0">Workspaces</option>
                                        <option value="1">Professional Services</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-12 mb-0"><a href="listing-workspaces.html" class="btn btn-lg btn-block btn-primary br-tl-md-0 br-bl-md-0">Search</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="categories">
    <div class="container">
        <div class="section-title center-block text-center">
            <h2>Check current promotions below:</h2>
            <!-- <p>Book workspaces and professional services anywhere anytime. Check our current promotions below</p> -->
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
                <div class="item-search-tabs">
                    <div class="item-search-menu">
                        <ul class="nav">
                            <li class=""><a href="#index1" class="active" data-bs-toggle="tab">Workspaces</a></li>
                            <li><a href="#index2" data-bs-toggle="tab">Professional Services</a></li>
                        </ul>
                    </div>
                    <div class="tab-content index-search-select">
                        <div class="tab-pane active" id="index1">
                            <div class="container">
                                <div class="items-blog-tab-heading row">
                                    <div class="col-12">
                                        <ul class="nav items-blog-tab-menu mb-40 mt-40">
                                            <li class=""><a href="listing-workspaces.html" class="ml-0">Hot Desk</a></li>
                                            <li class=""><a href="listing-workspaces.html" class="ml-0">Dedicated Desk</a></li>
                                            <li class=""><a href="listing-workspaces.html" class="ml-0">Private Office</a></li>
                                            <li class=""><a href="listing-workspaces.html" class="ml-0">Virtual Office</a></li>
                                            <li class=""><a href="listing-workspaces.html" class="ml-0">Conference Room</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="myCarousel1" class="owl-carousel owl-carousel-icons2 owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage">
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-0">
                                                        <div class="item-card2-img">
                                                            <a href="workspace-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/products/h4.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">20% Off </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card2">
                                                                <div class="item-card2-text">
                                                                    <a href="workspace-detail.html" class="text-dark">
                                                                        <h4 class="">Blue Sky Hotel</h4>
                                                                    </a>
                                                                    <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                                    <h5 class="font-weight-bold mb-3">AU$49.00 <span class="fs-12 font-weight-normal">Per Hour</span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <img src="{{asset('assets/web/assets/images/hot-desk.png')}}" alt="image" class="me-2" />
                                                                    <h5 class="time-title text-muted p-0 leading-normal my-auto">
                                                                        Hot Desk
                                                                        <i class="si si-check text-success fs-12 ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="verified" aria-label="verified"></i>
                                                                    </h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.9</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-0">
                                                        <div class="item-card2-img">
                                                            <a href="workspace-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/products/h2.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">8% Off </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card2">
                                                                <div class="item-card2-text">
                                                                    <a href="workspace-detail.html" class="text-dark">
                                                                        <h4 class="">Royal Complex</h4>
                                                                    </a>
                                                                    <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                                    <h5 class="font-weight-bold mb-3">AU$129.00 <span class="fs-12 font-weight-normal">Per Day</span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <img src="{{asset('assets/web/assets/images/ded-desk.png')}}" alt="image" class="me-2" />
                                                                    <h5 class="time-title text-muted p-0 leading-normal my-auto">
                                                                        Dedicated Desk
                                                                        <i class="si si-check text-success fs-12 ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="verified" aria-label="verified"></i>
                                                                    </h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.0</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-0">
                                                        <div class="item-card2-img">
                                                            <a href="workspace-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/products/h1.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">12% Off </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card2">
                                                                <div class="item-card2-text">
                                                                    <a href="workspace-detail.html" class="text-dark">
                                                                        <h4 class="">123 Roy Plaza</h4>
                                                                    </a>
                                                                    <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                                    <h5 class="font-weight-bold mb-3">AU$29.00 <span class="fs-12 font-weight-normal">Per Hour</span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <img src="{{asset('assets/web/assets/images/hot-desk.png')}}" alt="image" class="me-2" />
                                                                    <h5 class="time-title text-muted p-0 leading-normal my-auto">
                                                                        Hot Desk
                                                                        <i class="si si-check text-success fs-12 ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="verified" aria-label="verified"></i>
                                                                    </h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-0">
                                                        <div class="item-card2-img">
                                                            <a href="workspace-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/products/h5.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">10% Off </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card2">
                                                                <div class="item-card2-text">
                                                                    <a href="workspace-detail.html" class="text-dark">
                                                                        <h4 class="">Rainbow Palace</h4>
                                                                    </a>
                                                                    <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                                    <h5 class="font-weight-bold mb-3">AU$69.00 <span class="fs-12 font-weight-normal">Per Hour</span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <img src="{{asset('assets/web/assets/images/pri-ofc.png')}}" alt="image" class="me-2" />
                                                                    <h5 class="time-title text-muted p-0 leading-normal my-auto">
                                                                        Private Office
                                                                        <i class="si si-check text-success fs-12 ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="verified" aria-label="verified"></i>
                                                                    </h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.9</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-0">
                                                        <div class="item-card2-img">
                                                            <a href="workspace-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/products/j2.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">5% Off </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card2">
                                                                <div class="item-card2-text">
                                                                    <a href="workspace-detail.html" class="text-dark">
                                                                        <h4 class="">Emerald Suits</h4>
                                                                    </a>
                                                                    <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                                    <h5 class="font-weight-bold mb-3">AU$29.00 <span class="fs-12 font-weight-normal">Per Hour</span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <img src="{{asset('assets/web/assets/images/hot-desk.png')}}" alt="image" class="me-2" />
                                                                    <h5 class="time-title text-muted p-0 leading-normal my-auto">
                                                                        Hot Desk
                                                                        <i class="si si-check text-success fs-12 ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="verified" aria-label="verified"></i>
                                                                    </h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-0">
                                                        <div class="item-card2-img">
                                                            <a href="workspace-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/products/f1.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">15% Off </span></div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card2">
                                                                <div class="item-card2-text">
                                                                    <a href="workspace-detail.html" class="text-dark">
                                                                        <h4 class="">123 Roy Plaza</h4>
                                                                    </a>
                                                                    <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                                    <h5 class="font-weight-bold mb-3">AU$29.00 <span class="fs-12 font-weight-normal">Per Hour</span></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <img src="{{asset('assets/web/assets/images/hot-desk.png')}}" alt="image" class="me-2" />
                                                                    <h5 class="time-title text-muted p-0 leading-normal my-auto">
                                                                        Hot Desk
                                                                        <i class="si si-check text-success fs-12 ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="verified" aria-label="verified"></i>
                                                                    </h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-nav">
                                        <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                                        <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
                                    </div>
                                    <div class="owl-dots disabled"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="index2">
                            <div class="container">
                                <div class="items-blog-tab-heading row">
                                    <div class="col-12">
                                        <ul class="nav items-blog-tab-menu mb-40 mt-40">
                                            <li class=""><a href="listing-services.html" class="ml-0">Financial & Insurance Services</a></li>
                                            <li class=""><a href="listing-services.html" class="ml-0">Health Care & Social Assistance</a></li>
                                            <li class=""><a href="listing-services.html" class="ml-0">Professional, Scientific, Technical Services</a></li>
                                            <li class=""><a href="listing-services.html" class="ml-0">Others</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="myCarousel2" class="owl-carousel owl-carousel-icons2 owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage">
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-xl-0">
                                                        <div class="item-card8-img br-tr-3 br-tl-3">
                                                            <a href="service-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/pro-service/serv1.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">15% Off </span></div>
                                                            </div>
                                                            <div class="item-tags">
                                                                <div class="ms-serv-cat tag-option">Financial & Insurance Services</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card8-desc">
                                                                <h4 class="font-weight-semibold"><a href="service-detail.html"> Wellness in Baldivis</a></h4>
                                                                <p class="text-muted mb-5">Wine,Music,Cheese...</p>
                                                                <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <h5 class="font-weight-bold ms-rte">AU$129.00</h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-xl-0">
                                                        <div class="item-card8-img br-tr-3 br-tl-3">
                                                            <a href="service-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/pro-service/serv2.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">12% Off </span></div>
                                                            </div>
                                                            <div class="item-tags">
                                                                <div class="ms-serv-cat tag-option">Professional, Scientific, Technical Services</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card8-desc">
                                                                <h4 class="font-weight-semibold"><a href="service-detail.html"> Wellness in Baldivis</a></h4>
                                                                <p class="text-muted mb-5">Wine,Music,Cheese...</p>
                                                                <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <h5 class="font-weight-bold ms-rte">AU$129.00</h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-xl-0">
                                                        <div class="item-card8-img br-tr-3 br-tl-3">
                                                            <a href="service-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/pro-service/serv3.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">5% Off </span></div>
                                                            </div>
                                                            <div class="item-tags">
                                                                <div class="ms-serv-cat tag-option">Health Care & Social Assistance</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card8-desc">
                                                                <h4 class="font-weight-semibold"><a href="service-detail.html"> Wellness in Baldivis</a></h4>
                                                                <p class="text-muted mb-5">Wine,Music,Cheese...</p>
                                                                <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <h5 class="font-weight-bold ms-rte">AU$129.00</h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-xl-0">
                                                        <div class="item-card8-img br-tr-3 br-tl-3">
                                                            <a href="service-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/pro-service/serv1.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">15% Off </span></div>
                                                            </div>
                                                            <div class="item-tags">
                                                                <div class="ms-serv-cat tag-option">Others</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card8-desc">
                                                                <h4 class="font-weight-semibold"><a href="service-detail.html"> Wellness in Baldivis</a></h4>
                                                                <p class="text-muted mb-5">Wine,Music,Cheese...</p>
                                                                <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <h5 class="font-weight-bold ms-rte">AU$129.00</h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="item">
                                                    <div class="card mb-xl-0">
                                                        <div class="item-card8-img br-tr-3 br-tl-3">
                                                            <a href="service-detail.html"></a> <img src="{{asset('assets/web/assets/images/products/pro-service/serv3.jpg')}}" alt="img" class="cover-image" />
                                                            <div class="tag-text">
                                                                <div class="flipthis-wrapper"><span class="bg-danger tag-option">10% Off </span></div>
                                                            </div>
                                                            <div class="item-tags">
                                                                <div class="ms-serv-cat tag-option">Health Care & Social Assistance</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="item-card8-desc">
                                                                <h4 class="font-weight-semibold"><a href="service-detail.html"> Wellness in Baldivis</a></h4>
                                                                <p class="text-muted mb-5">Wine,Music,Cheese...</p>
                                                                <p class="mb-2 d-flex"><img src="{{asset('assets/web/assets/images/map.svg')}}" alt="" class="ms-mr" />Brisbane</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="footerimg d-flex mt-0 mb-0">
                                                                <div class="d-flex footerimg-l mb-0">
                                                                    <h5 class="font-weight-bold ms-rte">AU$129.00</h5>
                                                                </div>
                                                                <div class="my-auto footerimg-r ms-auto"><i class="fa fa-star"></i> <small class="text-muted">4.2</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-nav">
                                        <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                                        <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
                                    </div>
                                    <div class="owl-dots disabled"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sptb bg-white">
    <div class="container">
        <div class="section-title center-block text-center">
            <h2>Host your workspaces and professional services for free, simply:</h2>
            
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-lg-0 mb-4">
                        <a href="{{route('/')}}">
                            <div class="service-card text-center">
                                <div class="bg-white icon-bg box-shadow icon-service2 about">
                                    <img src="{{asset('assets/web/assets/images/products/about/employees.png')}}" alt="img" />
                                </div>
                                <div class="servic-data mt-3">
                                    <h4 class="font-weight-semibold mb-2">Create Account</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-lg-0 mb-4">
                        <a href="{{route('/')}}">    
                            <div class="service-card text-center">
                                <div class="bg-white icon-bg box-shadow icon-service2 about"><img src="{{asset('assets/web/assets/images/products/about/megaphone.png')}}" alt="img" /></div>
                                <div class="servic-data mt-3">
                                    <h4 class="font-weight-semibold mb-2">Host Workspaces</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-sm-0 mb-4">
                        <a href="{{route('/')}}">
                            <div class="service-card text-center">
                                <div class="bg-white icon-bg box-shadow icon-service2 about"><img src="{{asset('assets/web/assets/images/products/about/pencil.png')}}" alt="img" /></div>
                                <div class="servic-data mt-3">
                                    <h4 class="font-weight-semibold mb-2">Host Professional Services</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="">
                        <a href="{{route('/')}}">
                            <div class="service-card text-center">
                                <div class="bg-white icon-bg box-shadow icon-service2 about"><img src="{{asset('assets/web/assets/images/products/about/coins.png')}}" alt="img" /></div>
                                <div class="servic-data mt-3">
                                    <h4 class="font-weight-semibold mb-2">Get Earnings</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sptb">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4 align-self-end ms-mb-50">
                <div class="text-wrap">
                    <div class="section-title">
                        <h2 class="font-weight-bold">Download App</h2>
                        <h3 class="font-weight-bold">On Me</h3>
                    </div>
                    <div class="btn-list">
                        <a href="https://apps.apple.com/us/app" class="mr-1">
                            <img src="{{asset('assets/web/assets/images/app-store.svg')}}" width="140" alt="" />
                        </a>
                        <a href="https://play.google.com/store/apps" class="">
                            <img src="{{asset('assets/web/assets/images/p-store.svg')}}" width="140" alt="" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"><img src="{{asset('assets/web/assets/images/app-down.png')}}" alt="" /></div>
        </div>
    </div>
</section>

@endsection 

@section('script') 
@endsection
