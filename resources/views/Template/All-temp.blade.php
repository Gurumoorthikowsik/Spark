@include('common.employee.inner_header')
@include('common.employee.sidebar')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    /* Optional styles for better card design */
    .card-preview {
        height: 150px;
        overflow: hidden;
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    .card-body {
        overflow: hidden;
    }
</style>

 <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/employees/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @foreach ($project as $proj)
                        <div class="col-lg-3 mb-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ $proj->screenshot }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $proj->template_name }}</h5>
                                    <p class="card-text">{{ $proj->desc }}</p>
        
                  
                                    <a href="{{ URL::to('template') }}/{{ $proj->id }}" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- #/ container -->
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@include('common.employee.inner_footer')
