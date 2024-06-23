<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white p-0">
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="/" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">info@example.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+012 345 6789</p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                @include('layouts.navigation')
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="/" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Sentiment Analyzer</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Sentiments</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <h3>Enter a sentence</h3>
                                <small>The rooms were not clean</small>
                                <div class="lg-3">
                                    <input style="width: 100%; padding: 30px; margin: 30px 0px;" type="text" id="userPrompt" placeholder="The hotel was clean,and with good staff" />
                                    <div id="error-message" style="color: red; display: none;">The sentence must contain 3 words, and should not contain any integers or special characters</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button id="submitBtn" class="btn btn-primary w-100">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">

                        <h1 class="mb-5">
                            Sentiments
                            <span class="text-primary text-uppercase">Output</span>
                        </h1>
                    </div>
                    <div id="sentiment-container" class="row g-4">

                    </div>
                </div>
            </div>

        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $("#submitBtn").click(function() {
            const userPrompt = $("#userPrompt").val();
            const errorMessage = $("#error-message");

            if (validateInput(userPrompt)) {
                errorMessage.hide();

                const data = {
                    prompt: userPrompt
                };
                getSentiments(data);
            } else {
                errorMessage.show();
            }
        });

        function validateInput(input) {
            const regex = /^[A-Za-z\s]+$/;
            const words = input.split(/\s+/);
            return regex.test(input) && words.length >= 3;
        }

        const getSentiments = (data) => {
            fetch("http://localhost:5000/sentiment_analysis", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((data) => {
                    displaySentiments(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        };

        const displaySentiments = (data) => {
            const sentimentContainer = $("#sentiment-container");
            sentimentContainer.empty();

            const classification = data.Classification;
            let emoji;
            let description;

            if (classification === "Positive") {
                emoji = "😊";
                description = "Your given prompt is classified as Positive.";
            } else if (classification === "Negative") {
                emoji = "😔";
                description = "Your given prompt is classified as Negative.";
            } else {
                emoji = "😐";
                description = "Your given prompt is classified as Neutral.";
            }

            const sentimentHtml = `
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Classification</h5>
                            <p class="card-text">${description} ${emoji}</p>
                            <h5 class="card-title">Scores</h5>
                            <p class="card-text">Positive: ${data.Sentiment.pos}</p>
                            <p class="card-text">Negative: ${data.Sentiment.neg}</p>
                            <p class="card-text">Neutral: ${data.Sentiment.neu}</p>
                            <p class="card-text">Compound: ${data.Sentiment.compound}</p>
                        </div>
                    </div>
                </div>
            `;

            sentimentContainer.append(sentimentHtml);
        };
    });
</script>