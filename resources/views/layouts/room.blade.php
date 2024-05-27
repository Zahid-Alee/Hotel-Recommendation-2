<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Hotelier - Hotel HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
      defer
    ></script>
  </head>

  <body>
    <div class="container-xxl bg-white p-0">
      <!-- Spinner Start -->
      <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
      >
        <div
          class="spinner-border text-primary"
          style="width: 3rem; height: 3rem"
          role="status"
        >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- Spinner End -->

      <!-- Header Start -->
      <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
          <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a
              href="index.php"
              class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center"
            >
              <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
            </a>
          </div>
          <div class="row gx-0 bg-white d-none d-lg-flex">
          <div class="col-lg-7 px-5 text-start">
    <?php
    if (isset($_COOKIE['user_id'])) {
        // User is logged in, show logout button
        echo '
        <div class="h-100 d-inline-flex align-items-center py-2 me-4">
            <i class="fa fa-sign-out text-primary me-2"></i>
            <a href="logout.php">
                <p class="mb-0">Logout</p>
            </a>
        </div>';
    } else {
        // User is not logged in, show login and register buttons
        echo '
        <div class="h-100 d-inline-flex align-items-center py-2 me-4">
            <i class="fa fa-lock text-primary me-2"></i>
            <a href="login.php">
                <p class="mb-0">Login</p>
            </a>
        </div>
        <div class="h-100 d-inline-flex align-items-center py-2">
            <i class="fa fa-user text-primary me-2"></i>
            <a href="signup.php">
                <p class="mb-0">Register</p>
            </a>
        </div>';
    }
    ?>
</div>

            <div class="col-lg-5 px-5 text-end">
                <div class="d-inline-flex align-items-center py-2">
                    <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                    <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                    <a class="" href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        </div>
      </div>
      <!-- Header End -->

      <!-- Page Header Start -->
      <div
        class="container-fluid page-header mb-5 p-0"
        style="background-image: url(img/carousel-1.jpg)"
      >
        <div class="container-fluid page-header-inner py-5">
          <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">
              Recommendation
            </h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Recommendation</a></li>
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
            <center>
              <?php
              
            if (isset($_COOKIE['user_id'])) {
                  $userId = $_COOKIE['user_id'];
                echo "Seach you requirements to get recommended hotels here";
                } 
                else {
                  echo "<a href='login.php' class='btn btn-primary py-md-3 px-md-5 me-3 animated'> Login </a>";
                }

              ?>
            </center>
          </div>
        </div>
      </div>
      <!-- Room End -->

      <!-- Testimonial Start -->
      <div
        class="container-xxl testimonial mt-5 py-5 bg-dark wow zoomIn"
        data-wow-delay="0.1s"
        style="margin-bottom: 90px"
      >
        <div class="container">
          <div class="owl-carousel testimonial-carousel py-5">
            <div
              class="testimonial-item position-relative bg-white rounded overflow-hidden"
            >
              <p>
              What an indulgent experience! From the moment we stepped into the lobby, we were treated like royalty. The room was spacious and elegantly furnished, with breathtaking views of the city skyline. The staff were attentive and went above and beyond to ensure our stay was perfect. The amenities were top-notch, especially the spa facilities. We left feeling relaxed and rejuvenated. Highly recommend!
              </p>
              <div class="d-flex align-items-center">
                <img
                  class="img-fluid flex-shrink-0 rounded"
                  src="img/testimonial-1.jpg"
                  style="width: 45px; height: 45px"
                />
                <div class="ps-3">
                  <h6 class="fw-bold mb-1">Client Name</h6>
                  <small>Profession</small>
                </div>
              </div>
              <i
                class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"
              ></i>
            </div>
            <div
              class="testimonial-item position-relative bg-white rounded overflow-hidden"
            >
              <p>
              Our stay at Seaside Serenity Resort was nothing short of magical. Nestled along the coastline, the views were absolutely stunning. The room was cozy and beautifully decorated, and the sound of the waves lulled us to sleep every night. The staff were incredibly friendly and helpful, always ready with recommendations for local attractions and dining options. We can't wait to return
              </p>
              <div class="d-flex align-items-center">
                <img
                  class="img-fluid flex-shrink-0 rounded"
                  src="img/testimonial-2.jpg"
                  style="width: 45px; height: 45px"
                />
                <div class="ps-3">
                  <h6 class="fw-bold mb-1">Client Name</h6>
                  <small>Profession</small>
                </div>
              </div>
              <i
                class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"
              ></i>
            </div>
            <div
              class="testimonial-item position-relative bg-white rounded overflow-hidden"
            >
              <p>
              Urban Oasis Hotel exceeded all our expectations. The location was perfect, close to shops, restaurants, and nightlife. The room was modern and comfortable, with all the amenities we needed for a comfortable stay. The highlight was definitely the rooftop pool, offering panoramic views of the city. The staff were friendly and accommodating, making us feel right at home. We'll definitely be back!
              </p>
              <div class="d-flex align-items-center">
                <img
                  class="img-fluid flex-shrink-0 rounded"
                  src="img/testimonial-3.jpg"
                  style="width: 45px; height: 45px"
                />
                <div class="ps-3">
                  <h6 class="fw-bold mb-1">Client Name</h6>
                  <small>Profession</small>
                </div>
              </div>
              <i
                class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"
              ></i>
            </div>
          </div>
        </div>
      </div>
      <!-- Testimonial End -->

      <!-- Newsletter Start -->
      <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="row justify-content-center">
          <div class="col-lg-10 border rounded p-1">
            <div class="border rounded text-center p-1">
              <div class="bg-white rounded text-center p-5">
                <h4 class="mb-4">
                  Subscribe Our
                  <span class="text-primary text-uppercase">Newsletter</span>
                </h4>
                <div class="position-relative mx-auto" style="max-width: 400px">
                  <input
                    class="form-control w-100 py-3 ps-4 pe-5"
                    type="text"
                    placeholder="Enter your email"
                  />
                  <button
                    type="button"
                    class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2"
                  >
                    Submit
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Newsletter Start -->

      <!-- Footer Start -->
      <div
        class="container-fluid bg-dark text-light footer wow fadeIn"
        data-wow-delay="0.1s"
      >
        <div class="container pb-5">
          <div class="row g-5">
            <div class="col-md-6 col-lg-4">
              <div class="bg-primary rounded p-4">
                <a href="index.php"
                  ><h1 class="text-white text-uppercase mb-3">Hotelier</h1></a
                >
                <p class="text-white mb-0">
                We provide services to our loyal customer, they could now get hotel recommendations through their requirements
                </p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <h6
                class="section-title text-start text-primary text-uppercase mb-4"
              >
                Contact
              </h6>
              <p class="mb-2">
                <i class="fa fa-map-marker-alt me-3"></i>123 Street, New York,
                USA
              </p>
              <p class="mb-2">
                <i class="fa fa-phone-alt me-3"></i>+012 345 67890
              </p>
              <p class="mb-2">
                <i class="fa fa-envelope me-3"></i>info@example.com
              </p>
              <div class="d-flex pt-2">
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-twitter"></i
                ></a>
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-youtube"></i
                ></a>
                <a class="btn btn-outline-light btn-social" href=""
                  ><i class="fab fa-linkedin-in"></i
                ></a>
              </div>
            </div>
            <div class="col-lg-5 col-md-12">
              <div class="row gy-5 g-4">
                <div class="col-md-6">
                  <h6
                    class="section-title text-start text-primary text-uppercase mb-4"
                  >
                    Company
                  </h6>
                  <a class="btn btn-link" href="">About Us</a>
                  <a class="btn btn-link" href="">Contact Us</a>
                  <a class="btn btn-link" href="">Privacy Policy</a>
                  <a class="btn btn-link" href="">Terms & Condition</a>
                  <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-md-6">
                  <h6
                    class="section-title text-start text-primary text-uppercase mb-4"
                  >
                    Services
                  </h6>
                  <a class="btn btn-link" href="">Food & Restaurant</a>
                  <a class="btn btn-link" href="">Spa & Fitness</a>
                  <a class="btn btn-link" href="">Sports & Gaming</a>
                  <a class="btn btn-link" href="">Event & Party</a>
                  <a class="btn btn-link" href="">GYM & Yoga</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="copyright">
            <div class="row">
              <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; <a class="border-bottom" href="#">Your Site Name</a>, All
                Right Reserved.

                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                Designed By
                <a class="border-bottom" href="https://htmlcodex.com"
                  >HTML Codex</a
                >
              </div>
              <div class="col-md-6 text-center text-md-end">
                <div class="footer-menu">
                  <a href="">Home</a>
                  <a href="">Cookies</a>
                  <a href="">Help</a>
                  <a href="">FQAs</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer End -->

      <!-- Back to Top -->
      <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
        ><i class="bi bi-arrow-up"></i
      ></a>
    </div>
    <script>
      $(document).ready(function () {
        // Initialize Select2 for multiselect dropdown
        $("#tagsSelect").select2();

        // Handle form submission
        $("#submitBtn").click(function () {
          const userPrompt = $("#userPrompt").val();
          const tags = $("#tagsSelect").val() || []; // Get selected tags, default to empty array
          const data = {
            user_prompt: userPrompt,
            tags: tags,
          };
          fetchRecommendations(data);
        });

        // Function to make API call and fetch recommendations
        const fetchRecommendations = (data) => {
          fetch("http://localhost:5000/recommendations", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          })
            .then((response) => response.json())
            .then((data) => {
              const hotels = JSON.parse(data);
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
                      ${hotel.rating}
                    </div>
                  </div>
                  <div class="d-flex mb-3">
                    ${hotel.tags}
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

              const sortedHotels = hotels.sort((a, b) => Number(b.rating) - Number(a.rating));
              
              console.log('sortedHotels',sortedHotels);

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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
