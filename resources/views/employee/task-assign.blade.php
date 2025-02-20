@include('common.employee.inner_header')
@include('common.employee.sidebar')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/employees/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Task</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>project Name </th>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>GitUrl</th>
                                                <th>Project File</th>
                                                <th>view</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($project as $key => $values)
                                                <tr class="item">
                                                    <td class="id">{{ $loop->iteration }}</td>
                                                    <td class="form_name">{{ $values->project }}</td>
                                                    <td class="form_name">{{ $values->desc }}</td>
                                                    <td class="form_name">{{ $values->type }}</td>
                                        
                                                    <td>
                                                        @if($values->status == 1)
                                                            <span class="badge badge-warning">Processing</span>
                                                        @elseif($values->status == 2)
                                                            <span class="badge badge-danger">Pending</span>
                                                        @else
                                                            <span class="badge badge-success">Completed</span>
                                                        @endif
                                                    </td>
                                        
                                                    <td class="form_name">
                                                        <a href="{{ $values->git_url }}" class="fa fa-github fa-2x" target="_blank"></a>
                                                    </td>
                                                    <td class="form_name">
                                                        <a href="{{ $values->project_file }}" class="fa fa-2x fa-download"></a>
                                                    </td>

                                                    <td class="form_name">
                                                        <a href="{{ url('taskboard') }}" class="fa fa-2x fa-eye"></a>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                        
                                        


                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>
</div>
</div>

</div>

@include('common.employee.inner_footer')
