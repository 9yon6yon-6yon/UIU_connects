@include('header')
@extends('header')
@push('title')
    <title>Dashboard</title>
@endpush

@include('nav-bar')
<div class="container" style="margin-top: 10px;">

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
                            <a class="nav-link" href="#" onclick="showSection('Follows')">Following</a>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>Award Name</th>
                        <th>Date Received</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody id="awards-table">
                    @foreach ($user as $award)
                        <tr>
                            <td><input type="text" name="award_name" value="{{ $award->award_name }}" disabled>
                            </td>
                            <td><input type="text" name="date_received"
                                    value="{{ $award->award_received ?? 'N/A' }}" disabled> </td>
                            <td><input type="text" name="description"
                                    value="{{ $award->award_description ?? 'N/A' }}" disabled> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>

            <form action="{{ route('user.addAward') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="award_name" class="form-label">Award Name</label>
                    <input type="text" class="form-control" id="award_name" name="award_name">
                </div>
                <div class="mb-3">
                    <label for="date_received" class="form-label">Date Received</label>
                    <input type="date" class="form-control" id="date_received" name="date_received">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Award</button>
            </form>
        </div>
    </div>
    <div id="Follows-section" class="content-section" style="display:none">
        <div class="row">
            @foreach ($following as $user)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset('/storage/files/' . $user->image_path) }}" class="card-img-top"
                            alt="Profile Picture">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->userName }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div id="Experiences-section" class="content-section" style="display:none">
        <table id="experiences-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $experience)
                    <tr>
                        <td><input type="text" name="company" value="{{ $experience->company }}"></td>
                        <td><input type="text" name="title" value="{{ $experience->position }}"></td>
                        <td><input type="date" name="start_date" value="{{ $experience->joining_date }}"></td>
                        <td><input type="date" name="end_date" value="{{ $experience->retired_date }}"></td>
                        <td><input type="text" name="description" value="{{ $experience->description }}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="Certificates-section" class="content-section" style="display:none">

    </div>
    <div id="Skills-section" class="content-section" style="display:none">

    </div>
    <div id="Education-section" class="content-section" style="display:none">

    </div>
    <div id="Testimonials-section" class="content-section" style="display:none">

    </div>
    <div id="About-section" class="content-section" style="display:none">

        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.addAbout') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Personal Info</h5>
                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <input type="text" class="form-control" id="userName" name="userName"
                                    value="{{ $info->userName }}">
                            </div>
                            <div class="form-group">
                                <label for="fathersName">Father's Name</label>
                                <input type="text" class="form-control" id="fathersName" name="fathersName"
                                    value="{{ $info->fathersName }}">
                            </div>
                            <div class="form-group">
                                <label for="mothersName">Mother's Name</label>
                                <input type="text" class="form-control" id="mothersName" name="mothersName"
                                    value="{{ $info->mothersName }}">
                            </div>
                            <div class="form-group">
                                <label for="image_path">Image Path</label>
                                <input type="file" class="form-control" id="image_path" name="image_path"
                                    value="{{ asset('/storage/files/'.$info->image_path) }}">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    value="{{ $info->dob }}">
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="nationality"
                                    value="{{ $info->nationality }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" name="status"
                                    value="{{ $info->status }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">Contact Info</h5>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $info->email }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="{{ $info->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="others">Others</label>
                                <textarea class="form-control" id="others" name="others">{{ $info->others }}</textarea>
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address">{{ $info->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div id="Volunteer-section" class="content-section" style="display:none">

    </div>
    <div id="Publications-section" class="content-section" style="display:none">

    </div>
    <div id="Interests-section" class="content-section" style="display:none">

    </div>

</div>

</section>

<script>
    const menuItems = document.querySelectorAll('.nav-item');

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            // remove "active" class from all menu items
            menuItems.forEach(item => item.querySelector('a').classList.remove('active'));

            // add "active" class to the clicked menu item
            item.querySelector('a').classList.add('active');
        });
    });

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
