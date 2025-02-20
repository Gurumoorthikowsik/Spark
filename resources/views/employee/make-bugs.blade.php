@include('common.employee.inner_header')
@include('common.employee.sidebar')

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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">

                    <form action="{{URL::to('addbugs')}}" id="leave-day-form" class="leave-day-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="mb-3" id="modal-id" style="display: none;">
                                <label for="id-field" class="form-label">ID</label>
                                <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="bug_name" class="form-label">Bugs Name</label>
                                <input type="text" class="form-control" name="bug_name" id="bug_name" />
                            </div>

                            <div class="mb-3">
                                <label for="bug_desc" class="form-label">Bugs Description*</label>
                                <input type="text" class="form-control" name="bug_desc" id="bug_desc" />
                            </div>

                            <div class="mb-3">
                                <label for="module_name" class="form-label">Module Name*</label>
                                <input type="text" class="form-control" name="module_name" id="module_name" />
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status*</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0">Process</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Completed</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="bug_images" class="form-label">Bug Image*</label>
                                <input type="file" class="form-control" name="bug_images" id="bug_images" />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="leave_day-btn" name="leave_day_btn">Submit</button>
                            </div>
                        </div>
                    </form>



                                </div>
                            </div>
                        </div>

           



                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>

@include('common.employee.inner_footer')
