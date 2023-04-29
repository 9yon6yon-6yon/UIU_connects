@include('header')
@extends('header')
@push('title')
    <title>Dashboard</title>
@endpush

@include('nav-bar')
<div class="container">

    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light  bg-light">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-start" id="navbarNav">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"
                                onclick="showSection('User')">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Awards')">Awards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Follows')">Follows</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#"
                                onclick="showSection('Experiences')">Experiences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Certificates')">Certificates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Skills')">Skills</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Education')">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Testimonials')">Testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('About')">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Volunteer')">Volunteer works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Publications')">Publications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('Interests')">Interests</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- HTML code for content sections -->
    <div id="User-section" class="content-section">
        <form>
            <div class="mb-3">
                <label for="id" class="form-label">User ID</label>
                <input type="text" class="form-control" id="id" value="{{ $user[0]->u_id }} " disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="{{ $user[0]->email }}">
            </div>
            <div class="mb-3">
                <label for="verified" class="form-label">Verified</label>
                <input type="text" class="form-control" id="verified" value="{{ $user[0]->status }}" disabled>
            </div>
            <div class="mb-3">
                <label for="userType" class="form-label">User Type</label>
                <input type="text" class="form-control" id="type" value="{{ $user[0]->user_type }}" disabled>

            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="input-group">
                    @if ($user[0]->is_active == 1)
                        <span class="input-group-text bg-success text-white">Active</span>
                    @else
                        <span class="input-group-text bg-danger text-white">Inactive</span>
                    @endif
                </div>
            </div>
        </form>

    </div>
    <div id="Awards-section" class="content-section" style="display:none">
        <div class="container">
            <h2>Awards</h2>
            <table class="table">
                <thead>
                    <tr>

                        <th>Award Name</th>
                        <th>Date Received</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $data)
                        <tr>
                            <td><input type="text" value="{{ $data->award_name }}"></td>

                            @if (isset($data->date_received))
                                <td><input type="text" value="{{ $data->date_received }}"> </td>
                            @else
                                <td>N/A</td>
                            @endif

                            @if (isset($data->date_received))
                                <td><input type="text" value="{{ $data->description }}"></td>
                            @else
                                <td>N/A</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="Follows-section" class="content-section" style="display:none">
        <div class="row">
            @foreach($following as $user)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $user->image_path }}" class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->userName }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <div id="Experiences-section" class="content-section"></div>
    <div id="Certificates-section" class="content-section"></div>
    <div id="Skills-section" class="content-section"></div>
    <div id="Education-section" class="content-section"></div>
    <div id="Testimonials-section" class="content-section"></div>
    <div id="About-section" class="content-section"></div>
    <div id="Volunteer-section" class="content-section"></div>
    <div id="Publications-section" class="content-section"></div>
    <div id="Interests-section" class="content-section"></div>

</div>

</section>

<script>
    function showSection(sectionName) {

        var contentSections = document.getElementsByClassName("content-section");
        for (var i = 0; i < contentSections.length; i++) {
            contentSections[i].style.display = "none";
        }
        var selectedSection = document.getElementById(sectionName + "-section");
        selectedSection.style.display = "block";
    }
</script>
@include('footer')
