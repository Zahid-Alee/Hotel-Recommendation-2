<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
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
    <!-- Header End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
      <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
          <h1 class="display-3 text-white mb-3 animated slideInDown">Recommendation</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item text-white active" aria-current="page">Recommendation</li>
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
                <div style="justify-content: space-between;align-items:center" class="flex">
                  <h3>Describe your requirements</h3>
                  <button id="viewHistoriesBtn" class="btn btn-primary">View Histories</button>
                </div>
                <small>Example, I'm looking for a hotel on beach side</small>
                <div class="lg-3">
                  <input style="width: 100%; padding: 30px; margin: 30px 0px;" type="text" id="userPrompt" placeholder="I'm looking for a clean hotel with good staff" />
                  <div id="error-message" style="color: red; display: none;">Please enter a valid description with at least 3 words and only alphabets.</div>
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

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
  </div>

  <div id="historyModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div class="inline-block align-top bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                User Histories
              </h3>
              <div class="mt-2">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead>
                    <tr>
                      <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                      </th>
                      <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prompt
                      </th>
                      <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Created At
                      </th>
                    </tr>
                  </thead>
                  <tbody id="historiesTableBody" class="bg-white divide-y divide-gray-200">
                    <!-- Histories will be inserted here -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="button" id="closeModalBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<script>
  $(document).ready(function() {
    // Initialize Select2 for multiselect dropdown
    // $("#tagsSelect").select2();

    // Handle form submission
    $("#submitBtn").click(function() {
      const userPrompt = $("#userPrompt").val();
      const tags = $("#tagsSelect").val() || [];
      const errorMessage = $("#error-message");

      if (validateInput(userPrompt)) {
        errorMessage.hide();

        const data = {
          prompt: userPrompt,
          // tags: tags,
        };
        fetchRecommendations(data);
      } else {
        errorMessage.show();
      }



      // fetchRecommendations(data);
    });

    function validateInput(input) {
      // Check if the input contains only alphabets and spaces, and has at least 3 words
      const regex = /^[A-Za-z\s]+$/;
      const words = input.split(/\s+/);

      return regex.test(input) && words.length >= 3;
    }


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
                  <img class="img-fluid" src="${hotel.images ?? 'img/room-1.jpg'}" alt="" />
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
                      >Check Reviews</a
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


          const userPrompt = $("#userPrompt").val();

          const prompt = {
            prompt: userPrompt,
          };

          // Retrieve the CSRF token from the meta tag
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          // Fetch request with CSRF token included in the headers
          fetch("/history", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken, // Include the CSRF token in the headers
              },
              body: JSON.stringify(prompt), // Ensure you pass an object, not just the prompt
            })
            .then((res) => {
              if (!res.ok) {
                throw new Error('Network response was not ok');
              }
              return res.json();
            })
            .then((data) => {
              console.log(data); // Handle the response data
            })
            .catch((e) => {
              console.log(e);
            });


        })
        .catch((error) => {
          console.error("Error:", error);
        });
    };
  });
</script>

<script>
  $(document).ready(function() {
    $('#viewHistoriesBtn').on('click', function() {
      // Fetch user histories via AJAX


      // Show the modal
      $('#historyModal').removeClass('hidden');

    });

    $('#closeModalBtn').on('click', function() {
      // Hide the modal
      $('#historyModal').addClass('hidden');
    });
  });
</script>