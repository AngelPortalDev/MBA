@extends('frontend.master')
@section('content')

<style>
    .main-page {
        position: relative;
        display: flex;
        align-items: center; 
        padding: 10px;
        border-bottom: 1px solid #e0e0e0; 
        background-color: #fff;
        transition: background 0.3s;
    }

    .main-page:hover {
        background: #f1f1f1;
    }

    .main-page img {
        height: 80px;
        width: 80px;
        border-radius: 8px; /* Rounded corners for images */
    }

    .main-page .play-button {
        position: absolute;
        top: 50%;
        left: 50px;
        transform: translate(-50%, -50%);
        font-size: 30px;
        color: #fff;
        transition: opacity 0.3s ease;
        opacity: 0;
    }

    .main-page:hover .play-button {
        opacity: 1;
        cursor: pointer;
    }

    .episode-info {
        flex-grow: 1;
        padding-left: 15px; 
        margin-right: 3rem;
    }

    .timing {
        min-width: 60px; /* Fixed width for timings */
        text-align: right; /* Align timings to the right */
    }

    .more-link {
        color: #2b3990;
        cursor: pointer;
    }
    .podcast-view-btn{
        border: 1px solid #D34059;
    }
    .podcast-view-btn:hover{
        background: #D34059;
        color: #fff;
        border: none;
        cursor: pointer;
    }
</style>

<section class="pt-8 pb-4 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <img src="https://www.industrialempathy.com/img/remote/ZiClJf-1920w.jpg" class="img-fluid rounded-3" style="height: 300px; width: 400px; object-fit: cover;"/>
            </div>
            <div class="col-lg-9 col-sm-12">
                <h1 class="text-left text-color font-weight-bold mt-6 text-dark">A Century Of Stories</h1>
                <p class="fw-bold">Join Kunal Vijayakar and Cyrus Broacha as they unravel the enchanting stories of India's last century. From groundbreaking innovations to cricketing legends, A Century of Stories is a captivating blend of humour and history, inviting you to relive and discover the tales that shaped modern India.</p>
                <button class="btn podcast-view-btn">Play Now</button>
            </div>
        </div>
        <h3 class="mt-4">Episodes</h3>
        <div>
            <div class="main-page">
                <div>
                    <img src="https://m.media-amazon.com/images/S/dmp-catalog-images-prod/images/230e07ac-cd9f-47f2-bb66-8afd40bc2314/d258e312-2636-4f46-bb30-8ab11319572b-482270004._SX768_SY768_BL0_QL100__UX56_FMwebp_QL85_.jpg" class="rounded-3"/>
                    <div class="play-button">&#9658;</div>
                </div>
                <div class="episode-info">
                    <h6 class="mb-0">3 days ago</h6>
                    <h5 class="mb-0 text-dark">Pokhran II: India’s Nuclear Breakthrough | India</h5>
                    <p>
                        Kunal takes you back this week to look at the historic Pokhran-II tests, the moment India officially became a nuclear power. Back in May 1998, India secretly carried out five underground nuclear tests in the Rajasthan desert, shocking the world. Code-named “Operation Shakti,” these tests were a huge achievement for the country,
                        <span class="more-text" style="display: none;">
                        led by Dr R Chidambaram and Dr APJ Abdul Kalam and a team of brilliant Indian scientists. 
                        We'll break down how they pulled it off, what it meant for India's global standing, and how the world reacted. It’s a story of science, strategy, and India making its mark on the world stage.
                        </span>
                        <span class="more-link">Read more</span>
                    </p>
                </div>
                <div class="timing">
                    <h5>42 mins</h5>
                </div>
            </div>

            <div class="main-page">
                <div>
                    <img src="https://m.media-amazon.com/images/S/dmp-catalog-images-prod/images/230e07ac-cd9f-47f2-bb66-8afd40bc2314/d258e312-2636-4f46-bb30-8ab11319572b-482270004._SX768_SY768_BL0_QL100__UX56_FMwebp_QL85_.jpg" class="rounded-3"/>
                    <div class="play-button">&#9658;</div>
                </div>
                <div class="episode-info">
                    <h6 class="mb-0">3 days ago</h6>
                    <h5 class="mb-0 text-dark">Pokhran II: India’s Nuclear Breakthrough | India</h5>
                    <p>
                        Kunal takes you back this week to look at the historic Pokhran-II tests, the moment India officially became a nuclear power. Back in May 1998, India secretly carried out five underground nuclear tests in the Rajasthan desert, shocking the world. Code-named “Operation Shakti,” these tests were a huge achievement for the country,
                        <span class="more-text" style="display: none;">
                        led by Dr R Chidambaram and Dr APJ Abdul Kalam and a team of brilliant Indian scientists. 
                        We'll break down how they pulled it off, what it meant for India's global standing, and how the world reacted. It’s a story of science, strategy, and India making its mark on the world stage.
                        </span>
                        <span class="more-link">Read more</span>
                    </p>
                </div>
                <div class="timing">
                    <h5>53 mins</h5>
                </div>
            </div>

            <div class="main-page">
                <div>
                    <img src="https://m.media-amazon.com/images/S/dmp-catalog-images-prod/images/230e07ac-cd9f-47f2-bb66-8afd40bc2314/d258e312-2636-4f46-bb30-8ab11319572b-482270004._SX768_SY768_BL0_QL100__UX56_FMwebp_QL85_.jpg" class="rounded-3"/>
                    <div class="play-button">&#9658;</div>
                </div>
                <div class="episode-info">
                    <h6 class="mb-0">3 days ago</h6>
                    <h5 class="mb-0 text-dark">Pokhran II: India’s Nuclear Breakthrough | India</h5>
                    <p>
                        Kunal takes you back this week to look at the historic Pokhran-II tests, the moment India officially became a nuclear power. Back in May 1998, India secretly carried out five underground nuclear tests in the Rajasthan desert, shocking the world. Code-named “Operation Shakti,” these tests were a huge achievement for the country,
                        <span class="more-text" style="display: none;">
                        led by Dr R Chidambaram and Dr APJ Abdul Kalam and a team of brilliant Indian scientists. 
                        We'll break down how they pulled it off, what it meant for India's global standing, and how the world reacted. It’s a story of science, strategy, and India making its mark on the world stage.
                        </span>
                        <span class="more-link">Read more</span>
                    </p>
                </div>
                <div class="timing">
                    <h5>29 mins</h5>
                </div>
            </div>

            <div class="main-page">
                <div>
                    <img src="https://m.media-amazon.com/images/S/dmp-catalog-images-prod/images/230e07ac-cd9f-47f2-bb66-8afd40bc2314/d258e312-2636-4f46-bb30-8ab11319572b-482270004._SX768_SY768_BL0_QL100__UX56_FMwebp_QL85_.jpg" class="rounded-3"/>
                    <div class="play-button">&#9658;</div>
                </div>
                <div class="episode-info">
                    <h6 class="mb-0">3 days ago</h6>
                    <h5 class="mb-0 text-dark">Pokhran II: India’s Nuclear Breakthrough | India</h5>
                    <p>
                        Kunal takes you back this week to look at the historic Pokhran-II tests, the moment India officially became a nuclear power. Back in May 1998, India secretly carried out five underground nuclear tests in the Rajasthan desert, shocking the world. Code-named “Operation Shakti,” these tests were a huge achievement for the country,
                        <span class="more-text" style="display: none;">
                        led by Dr R Chidambaram and Dr APJ Abdul Kalam and a team of brilliant Indian scientists. 
                        We'll break down how they pulled it off, what it meant for India's global standing, and how the world reacted. It’s a story of science, strategy, and India making its mark on the world stage.
                        </span>
                        <span class="more-link">Read more</span>
                    </p>
                </div>
                <div class="timing">
                    <h5>29 mins</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.more-link').forEach(link => {
        link.addEventListener('click', function() {
            const moreText = this.previousElementSibling;
            moreText.style.display = moreText.style.display === 'none' ? 'inline' : 'none';
            this.style.display = moreText.style.display === 'inline' ? 'none' : 'inline';
        });
    });
</script>

@endsection
