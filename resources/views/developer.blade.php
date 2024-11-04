<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Developer Info - BSMRU Admin Panel</title>


    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('admin.partials.header')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

</head>

<body>
    <style>
        .section-title h2 {
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            position: relative;
            color: #222222;

            .section-title h2 ec {
                margin-left: 30%;
            }

            @media(max-width: 900px) {

                font-size: 20px;

                .section-title h2 ec {
                    margin-left: 30%;
                }

            }

            @media(max-width: 790px) {

                font-size: 25px;

                .section-title h2 ec {
                    margin-left: 30%;
                }

            }

            @media(max-width:620px) {
                font-size: 18px;

                .section-title h2 ec {
                    margin-left: 3%;
                }
            }

            @media(max-width:333px) {
                font-size: 14px;

                .section-title h2 ec {
                    margin-left: 3%;
                }
            }
        }

        .section-title h2::before,
        .section-title h2::after {
            content: "";
            width: 50px;
            height: 2px;
            background: #3498db;
            display: inline-block;
        }

        .section-title h2::before {
            margin: 0 15px 10px 0;
        }

        .section-title h2::after {
            margin: 0 0 10px 15px;
        }

        .section-title p {
            margin: 15px 0 0 0;
        }
        /* General styling for .text-align-center class */
    .profile .profile-card h3 {
        font-size: 18px; /* Default font size for larger screens */
    }

    @media (max-width: 600px) {
        .profile .profile-card h3 {
            font-size: 12px;
            text-align:center;
        }
    }


    </style>
    <main id="main" class="main">
        <section class="profile">
            <div class="row">
                <div class="col-xl-1 "></div>
                <div class="col-xl-7 ">
                    <div class="row ">
                        <div class="section-title aos-init aos-animate d-flex justify-content-center pt-4" style="padding-bottom: 10px">
                            <h2>Lead Developer</h2>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{asset('assets/developer/lead.jpg')}}" alt="Profile" class="rounded-circle">
                            <h2 style="padding-bottom: 5px">Saimon Islam</h2>
                            <h3 class="text-align-center">Dept. of Computer Science & Engineering</h3>
                            <h3 class="text-align-center" style="margin-top: -5px">Bangabandhu Sheikh Mujibur Rahman University, Kishoreganj</h3>
                            <div class="social-links mt-2">
                                <a href="mailto:saimonislam.cse@gmail.com" class="email"><i class="ri-mail-send-fill"></i></a>
                                <a target="./" href="https://bd.linkedin.com/in/saimon-islam?trk=public-profile-badge-profile-badge-view-profile-cta" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="profile">
            <div class="row">
                <div class="col-xl-1 "></div>
                <div class="col-xl-7 ">
                    <div class="row ">
                        <div class="section-title aos-init aos-animate d-flex justify-content-center pt-4" style="padding-bottom: 10px">
                            <h2>Chief Advisor</h2>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{asset('assets/developer/advisor.jpg')}}" alt="Profile" class="rounded-circle">
                            <h2 style="padding-bottom: 5px">Swapnil Biswas</h2>
                            <h3 class="text-align-center">Dept. of Computer Science & Engineering</h3>
                            <h3 class="text-align-center" style="margin-top: -5px">Military Institute of Science and Technology</h3>
                            <div class="social-links mt-2">
                                <a href="mailto:swapnil.cse16@gmail.com" class="email"><i class="ri-mail-send-fill"></i></a>
                                <a target="./" href="https://bd.linkedin.com/in/swapnil-biswas-48250a225?trk=public-profile-badge-profile-badge-view-profile-cta" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="profile">
            <div class="row">
                <div class="col-xl-1 "></div>
                <div class="col-xl-7 ">
                    <div class="row ">
                        <div class="section-title aos-init aos-animate d-flex justify-content-center pt-4" style="padding-bottom: 10px">
                            <h2>Chief Patron</h2>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{asset('assets/developer/patron.jpg')}}" alt="Profile" class="rounded-circle">
                            <h2 style="padding-bottom: 5px">Dr. Z. M. Parvez Sazzad</h2>
                            <h3 class="text-align-center">Dept. of Electronics and Communication Engineering</h3>
                            <h3 class="text-align-center" style="margin-top: -5px"> University of Dhaka</h3>
                            <div class="social-links mt-2">
                                <a href="mailto:sazzad@du.ac.bd" class="email"><i class="ri-mail-send-fill"></i></a>
                                <a target="./" href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>




    @include('admin.partials.footerFile')
</body>

</html>
