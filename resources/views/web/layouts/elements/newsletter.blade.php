    <!-- Start Call To Action Area -->
    <div class="call-to-action-area mt-0 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="action-content text-center pb-3">
                        <h2 class="text-dark lh-base">Don't miss out on the latest updates, promotions, and exclusive content. <br>Sign up for our newsletters by entering your email address below.</h2>
                    </div>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="subscribe-section">
                        <form class="d-flex" action="{{ route('web.newsletter.create') }}" method="post">
                            @csrf
                            <input type="email" name="email" placeholder="Enter your email">
                            <button type="submit" class="px-2 px-lg-5">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Call To Action Area -->