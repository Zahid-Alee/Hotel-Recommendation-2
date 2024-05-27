<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.html"
                        class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
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
                        <a href="index.html" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                            data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Rooms</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Rooms</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Booking Start -->
        <div
        class="container-fluid booking pb-5 wow fadeIn"
        data-wow-delay="0.1s"
      >
        <div class="container">
          <div class="bg-white shadow" style="padding: 35px">
            <div class="row g-2">
              <div class="col-md-10">
                <div class="row g-2">
                    <h3>Describe your requirements</h3>
                    <small>Example, I'm looking for a hotel on beach side</small>
                  <div class="lg-3">
                    <input
                    style="width: 100%; padding: 30px; margin: 30px 0px;"
                    
                      type="text"
                      id="userPrompt"
                      placeholder="I'm looking for a clean hotel with good staff"
                    />
                  </div>
                  <!-- <div class="col-md-3">
                    <select
                      id="tagsSelect"
                      class="form-control"
                      multiple="multiple"
                    >
                      <option value="tag1">Tag1</option>
                      <option value="tag2">Tag2</option>
                      <option value="tag3">Tag3</option>
                    </select>
                  </div>
                </div> -->
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
      <!-- Booking End -->

      <!-- Room Start -->
      <div class="container-xxl py-5">
        <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">
              Top Hotels
            </h6>
            <h1 class="mb-5">
              Recommended 
              <span class="text-primary text-uppercase">Hotels</span>
            </h1>
          </div>
          <div id="hotel-container" class="row g-4">
            
          </div>
        </div>
      </div>
      <!-- Room End -->


    </div>
        <!-- Booking End -->


        <!-- Room Start -->
    
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
</x-app-layout>

<script>
      $(document).ready(function () {
        // Initialize Select2 for multiselect dropdown
        // $("#tagsSelect").select2();

        // Handle form submission
        $("#submitBtn").click(function () {
          const userPrompt = $("#userPrompt").val();
          const tags = $("#tagsSelect").val() || []; // Get selected tags, default to empty array
          const data = {
            prompt: userPrompt,
            // tags: tags,
          };
          fetchRecommendations(data);
        });

        // Function to make API call and fetch recommendations
        const fetchRecommendations = (data) => {
          fetch("http://localhost:5000/recommend", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          })    
            .then((response) => response.json())
            .then((data) => {
              const hotels = data;
              const mapHotelDetails = (hotel) => {
                return `
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="room-item shadow rounded overflow-hidden">
                <div class="position-relative">
                  <img class="img-fluid" src="${hotel.images??'img/room-1.jpg'}" alt="" />
                  <small
                    class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4"
                    >${hotel.nationality}</small
                  >
                </div>
                <div class="p-4 mt-2">
                  <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">${hotel.hotel_name}</h5>
                    <div class="ps-2">
                      <small class="fa fa-star text-primary"></small>
                      ${hotel.avg_rating}
                    </div>
                  </div>
                  <div class="d-flex mb-3">
                  </div>
                  <p class="text-body mb-3">Descripton</p>
                  <div class="d-flex justify-content-between">
                    <a class="btn btn-sm btn-primary rounded py-2 px-4" target='_blank' href="${hotel.url}"
                      >View Detail</a
                    >
                    <a class="btn btn-sm btn-dark rounded py-2 px-4" target='_blank' href="${hotel.hotel_url}"
                      >Book Now</a
                    >
                  </div>
                </div>
              </div>
            </div>
                  `;
              };

              const sortedHotels = hotels.sort((a, b) => Number(b.avg_rating) - Number(a.avg_rating));
              
              const hotelContainer = document.getElementById("hotel-container");
              hotelContainer.innerHTML = ""; 
              sortedHotels?.forEach((hotel) => {
                const hotelHtml = mapHotelDetails(hotel);
                hotelContainer.insertAdjacentHTML("beforeend", hotelHtml);
              });
            })
            .catch((error) => {
              console.error("Error:", error);
            });
        };
      });
    </script>