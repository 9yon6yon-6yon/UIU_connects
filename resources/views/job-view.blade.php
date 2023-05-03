@include('header')
@extends('header')
@push('title')
    <title>Job</title>
@endpush


@include('nav-bar')
<div class="container">
    <div class="row">
        @if (Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
        @elseif(Session::has('error'))
            <p class="alert alert-warning">{{ Session::get('error') }}</p>
        @endif
        <div class="col-lg-12">
            <div class="user-post-container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3>{{ $jobs->job_title }}</h3>
                            </div>
                            <div class="col-sm-4 text-right">
                                <small>Posted {{ $jobs->created_at }}</small>
                                <br>
                                <small>By {{ $personal_info->userName ?? 'Anonymous' }} ({{ $user->user_type }})</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $jobs->job_details }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('storage/files/' . $jobs->files) }}" alt="" width="720px"
                            height="auto">
                    </div>
                </div>
                <br>
                @if (Session::get('$user_id') == $jobs->user_id)
                    <div class="text-right">
                        <form action="{{ route('delete.p.job', ['id' => $jobs->job_id]) }}" method="post"
                            style="display: inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    @if (count($applications) > 0)
                        <div class="card">
                            <div class="card-header">
                                <h2>Applications:</h2>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    @foreach ($applications as $application)
                                        <li class="list-group-item">
                                            <a href="{{ asset('storage/files/' . $application->file_path) }}"
                                                target="_blank">{{ $application->file_path }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <p>No applications yet.</p>
                    @endif
                @else
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" onclick="toggleCVInput()">Apply</button>
                    </div>
                    <div class="form-group mt-3" id="cvInput" style="display: none">
                        <form action="{{ route('apply.job', ['id' => $jobs->job_id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="form-control" name="cv" required>
                            <button type="submit" class="btn btn-success mt-2">Submit</button>
                        </form>
                    </div>
                @endif
                <br>
            </div>
        </div>
    </div>
</div>


</section>
<script>
    function toggleCVInput() {
        var cvInput = document.getElementById('cvInput');
        if (cvInput.style.display === 'none') {
            cvInput.style.display = 'block';
        } else {
            cvInput.style.display = 'none';
        }
    }
</script>



@include('footer')
