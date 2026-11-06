<style>
    .review-stars {
        margin-top: 10px;
        color: #FFD700; /* Gold color */
        font-size: 20px;
        text-align: center;
    }
    .review-text {
        display: block;            /* allows justification */
        text-align: justify;       /* aligns both left & right */
        line-height: 1.6;          /* improves readability */
        color: #333;               /* optional: better contrast */
        font-size: 16px;           /* optional */
    }
    .slider-container {
        position: relative;
        overflow: hidden;
        width: 101%;

    }

    .slider {
        display: flex;
        transition: transform 0.6s ease;
    }

    .slide {
        min-width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }

    .col-lg-8, .col-lg-4 {
        box-sizing: border-box;
        padding: 10px;
    }

    .col-lg-8 {
        flex: 0 0 65%;
    }

    .col-lg-4 {
        flex: 0 0 35%;
    }

    .review-text {
        display: block;
        text-align: justify;
        line-height: 1.6;
        color: #333;
        font-size: 16px;
    }

    .review-stars {
        margin-top: 10px;
        color: #FFD700;
        font-size: 20px;
        text-align: center;
    }

    .reviewer-info {
        text-align: center;
    }

    .reviewer-info img {
        width: 20%;
        padding:10px;
    }

    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        color: white;
        border: none;
        font-size: 10px;
        padding: 6px 8px;
        cursor: pointer;
        border: 1px solid gray;
        color: gray;
    }

    .slider-btn:hover {
        background: rgba(33,37,41,1);
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

    @media (max-width: 768px) {
        .slide {
            flex-direction: column;
        }
        .col-lg-8, .col-lg-4 {
            flex: 0 0 100%;
        }
    }
    .font_50_600 {
        font-size: 50px;
        font-weight: 600;
    }
    .padding_40_center {
        padding: 40px;
        text-align: center;
        box-shadow: 0px 4px 9px 1px #0000001A;
    }

    /* ✅ Responsive improvements for review slider */
@media (max-width: 992px) {
    .slide {
        flex-direction: column;
        text-align: center;
    }

    .col-lg-8, .col-lg-4, .col-lg-12 {
        flex: 0 0 100%;
        max-width: 100%;
        padding: 10px 20px;
    }

    .review-text {
        font-size: 15px;
        line-height: 1.6;
    }

    .reviewer-info img {
        width: 35%;
    }

    .font_50_600 {
        font-size: 35px;
    }

    .padding_40_center {
        padding: 25px 10px;
    }

    .slider-btn {
        font-size: 12px;
        padding: 6px 10px;
    }
}

@media (max-width: 768px) {
    .review-text {
        font-size: 14px;
        text-align: justify;
        padding: 0 5px;
    }

    .reviewer-info img {
        width: 40%;
    }

    .font_50_600 {
        font-size: 28px;
    }

    .slider-container {
        width: 100%;
    }

    .slider-btn {
        top: auto;
        bottom: 15px;
        transform: none;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border-radius: 50%;
    }

    .prev-btn {
        left: 35%;
    }

    .next-btn {
        right: 35%;
    }
}

@media (max-width: 480px) {
    .font_50_600 {
        font-size: 24px;
    }

    .review-text {
        font-size: 13px;
        line-height: 1.5;
    }

    .reviewer-info img {
        width: 50%;
    }

    .slider-btn {
        font-size: 10px;
        padding: 4px 8px;
    }

    .prev-btn {
        left: 30%;
    }

    .next-btn {
        right: 30%;
    }
}

</style>

<div class="row padding_40_center" style="margin: unset; ">
        <div class="font_50_600">
            <span>Take Their </span>
            <span style="color: red;">Word For It</span>
        </div>
        <div>
            <span>Explore The Experiences Of Our Satisfied Customers. Delve Into Genuine Feedback, Sharing Insights Into Our Exceptional Products And Services</span>
        </div>

    </div>

<div class="slider-container">
    <div class="slider" id="slider">
        <!-- Slide 1 -->
        <div class="slide">
            <div class="col-lg-8">
                <div>
                    <span class="review-text">
                        The team at Encore continues to impress. We at XR Soccer training know we are going to get quality fabric that the players like, and designs that the organization loves, within our budget and shipped on time. We know that the team has taken the time to get to know and perfect the designs we like, so the collaboration is effortless and the product never fails to meet expectations. And, they are quick to help you out anytime you need them. Truly a great partnership.
                    </span>
                </div>
                <div class="review-stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-alt"></i>
                </div>
                <div class="reviewer-info">
                    <img src="{{ asset('assets/customer_end/review/review_1_logo.png') }}" alt="Logo">
                    <div><strong>Xavi R</strong></div>
                    <span>XR Soccer Training</span>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('assets/customer_end/review/review_1_gif.gif') }}" alt="Logo" style="width:100%; border-radius:8px;">
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide">
            <div class="col-lg-8">
                <div>
                    <span class="review-text">
                        "My experience with Encore was nothing but the best! Their team, patient during my off-season, ensured timely gear delivery as my season approached. Encore's commitment to excellence shone when faced with low jersey stock. Rather than providing second-hand items, they went above and beyond, sending usable alternatives until our ordered jerseys were back in stock. Their persistence and drive for excellence left my team more than satisfied. The jerseys are top-notch—breathable, flexible, and durable. Encore's exceptional customer service and commitment make them the go-to for anyone seeking a high-quality purchase with a smooth communication process."
                    </span>
                </div>
                <div class="review-stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="reviewer-info">
                    <img src="{{ asset('assets/customer_end/review/review_2_logo.png') }}" alt="Logo">
                    <div><strong>Sincerely, a Satisfied Customer</strong></div>
                    <span>Joe O - 59'ers Soccer</span>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('assets/customer_end/review/review_2_gif.gif') }}" alt="Logo" style="width:100%; border-radius:8px;">
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide">
            <div class="col-lg-8">
                <div>
                    <span class="review-text">
                        Once again, I want to thank you for supporting the U21 Uganda team. I really can't express how grateful I am. Your donation was so huge for us. Our players absolutely loved their uniforms and will treasure them forever. They were so proud to wear the Uganda uniform and represent their country. You've touched the lives of many young men who you may never meet but whose lives you've forever impacted. One more time, on behalf of all of the players, I want to say "thank you". It was the experience of a lifetime and we could not have done it without you
                    </span>
                </div>
                <div class="review-stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="reviewer-info">
                    <img src="{{ asset('assets/customer_end/review/review_3_logo.png') }}" alt="Logo">
                    <div><strong>Jeramy P</strong></div>
                    <span>Uganda National Lacrosse</span>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('assets/customer_end/review/review_3_gif.gif') }}" alt="Logo" style="width:100%; border-radius:8px;">
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="slide">
            <div class="col-lg-8">
                <div>
                    <span class="review-text">
                        The customer service Encore has provided our canoe club has gone and beyond our expectations. From top to bottom Encore helped us every step of the way from design through order competition. I can't imagine an easier more fluid system for any team that wants to get gear made without the hassle of having to run the project themselves. encore worked with us to get the materials specifically right for both the water and sun. Product is superb!
                    </span>
                </div>
                <div class="review-stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="reviewer-info">
                    <img src="{{ asset('assets/customer_end/review/review_4_logo.png') }}" alt="Logo">
                    <div><strong>TIM O'DWYER</strong></div>
                    <span>TIM O'DWYER</span>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('assets/customer_end/review/review_4_gif.gif') }}" alt="Logo" style="width:100%; border-radius:8px;">
            </div>
        </div>

        <!-- Slide 5 -->
        <div class="slide">
            <div class="col-lg-12">
                <div>
                    <span class="review-text">
                        USA Lacrosse and Encore have worked with one another for a number of years. This relationship has been successful in helping programs get the uniforms that are needed the right way! Encore has helped us put together uniforms for our ULA organizations and other programs that work with us by walking them through the process of the type of uniforms, material, the overall concept,as well as working with them and their budget. This is a company that will do their best to make sure you end up with what you wanted and needed.
                    </span>
                </div>
                <div class="review-stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="reviewer-info">
                    <img src="{{ asset('assets/customer_end/review/review_4_logo.png') }}" alt="Logo">
                    <div><strong>Donovan Dennis</strong></div>
                    <span>Manager, Diversity, Equity & Inclusion</span><br>
                    <span>2 Loveton Circle | Sparks MD 21152</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <button class="slider-btn prev-btn" id="prevBtn"><i class="fa fa-chevron-left"></i></button>
    <button class="slider-btn next-btn" id="nextBtn"><i class="fa fa-chevron-right"></i></button>
</div>

<script>
    const slider = document.getElementById('slider');
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;

    document.getElementById('nextBtn').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    });
</script>
