<style>
    .custom_gif {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .font_35_600 {
        font-size: 35px;
        font-weight: 600;
    }
    .take_action_text_div {
        color: white;
        text-align: center;
        justify-content: center;
        align-items: center;
    }
    .review_text {
        padding: 0px 13%;
        font-size: 18px;
        color: white;
    }
    .reviewer-info {
        text-align: center;
        color: white;
    }

    .reviewer-info img {
        width: 7%;
        padding:10px;
    }
    .review-stars {
        margin-top: 10px;
        color: #FFD700;
        font-size: 20px;
        text-align: center;
    }
    .prev-btn, .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 50%;
        transition: background 0.3s ease;
    }

    .prev-btn:hover, .next-btn:hover {
        background: rgba(255,255,255,0.3);
    }

    .prev-btn {
        left: 20px;
    }

    .next-btn {
        right: 20px;
    }
    .review-slider {
        position: relative;
        width: 100%;
        text-align: center;
        overflow: hidden;
    }
    .review_content {
        display: none;
        color: white;
        max-width: 800px;
        margin: 0 auto;
        transition: opacity 0.6s ease-in-out;
    }

    .review_content.active {
        display: block;
        opacity: 1;
    }
    .comma_text {
        font-size: 50px;
        color: red;
    }
</style>

<div class="row custom_gif" style="margin: unset; padding-bottom: 40px;">

    <div style="text-align: center; padding: 40px 0px;">
        <span class="font_35_600" style="color: gray;">WHAT OUR CUSTOMERS SAY</span>
    </div>
    <div class="review-slider">
        <!-- Review 1 -->
        <div class="review_content active">
            <div style="text-align: center;">
                <span class="comma_text">"</span>
            </div>
            <div class="review_text" style="text-align: center;">
                <span>
                    Once again, I want to thank you for supporting the U21 Uganda team. I really can't express how grateful I am...
                    It was the experience of a lifetime and we could not have done it without you.
                </span>
            </div>
            <div class="review-stars">
                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <div class="reviewer-info">
                <img src="{{ asset('assets/customer_end/review/review_3_logo.png') }}" alt="Logo">
                <div><strong>Jeramy P</strong></div>
                <span>Uganda National Lacrosse</span>
            </div>
        </div>
        <!-- Review 2 -->
        <div class="review_content">
            <div style="text-align: center;">
                <span class="comma_text">"</span>
            </div>
            <div class="review_text" style="text-align: center;">
                <span>
                    The team at Encore continues to impress. We at XR Soccer training know we are going to get quality fabric...
                    Truly a great partnership.
                </span>
            </div>
            <div class="review-stars">
                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <div class="reviewer-info">
                <img src="{{ asset('assets/customer_end/review/review_1_logo.png') }}" alt="Logo">
                <div><strong>Xavi R</strong></div>
                <span>XR Soccer Training</span>
            </div>
        </div>
        <!-- Navigation buttons -->
        <button class="prev-btn"><i class="fa fa-chevron-left"></i></button>
        <button class="next-btn"><i class="fa fa-chevron-right"></i></button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const reviews = document.querySelectorAll(".review_content");
        const nextBtn = document.querySelector(".next-btn");
        const prevBtn = document.querySelector(".prev-btn");

        let current = 0;
        let autoSlide;

        function showReview(index) {
            reviews.forEach((rev, i) => {
                rev.classList.toggle("active", i === index);
            });
        }

        function nextReview() {
            current = (current + 1) % reviews.length;
            showReview(current);
        }

        function prevReview() {
            current = (current - 1 + reviews.length) % reviews.length;
            showReview(current);
        }

        // Auto slide every 3 seconds
        function startAutoSlide() {
            autoSlide = setInterval(nextReview, 3000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlide);
        }

        nextBtn.addEventListener("click", () => {
            nextReview();
            stopAutoSlide();
            startAutoSlide();
        });

        prevBtn.addEventListener("click", () => {
            prevReview();
            stopAutoSlide();
            startAutoSlide();
        });

        showReview(current);
        startAutoSlide();
    });
</script>
