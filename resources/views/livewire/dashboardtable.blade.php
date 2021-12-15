<div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border text-white bg-success mb-3">
                <div class="card-body">
                    <div class="row align-middle">
                        <span class="col-sm-3 align-middle">
                            <h2>{{$green}}</h2>
                        </span>
                        <span class="col-sm-9 align-middle">
                            <h2> Total Document</h2>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border text-white bg-warning mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 align-middle">
                            <h2>{{$yellow}}</h2>
                        </div>
                        <div class="col-sm-9 align-middle">
                            <h2> Deadlines Document</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border text-white bg-danger mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-3 align-middle">
                                <h2>{{$red}}</h2>
                            </div>
                            <div class="col-sm-9 align-middle">
                                <h2> Expired Document</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-12">
            <a class="btn btn-outline-success" href="/newdocument">
                <i class="far fa-plus-square"></i> <span> Add Document</span></a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <table id="example" class="display table border table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No Document</th>
                        <th>Pic</th>
                        <th>Category</th>
                        <th>Issue date</th>
                        <th>Expired date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($documents as $index => $dcm)
                    <tr>
                        <td><a href="/document/{{$dcm->id}}">{{$dcm->nodoc}}</a></td>
                        <td>{{$dcm->pic}}</td>
                        <td>{{$dcm->category}}</td>
                        <td>{{$dcm->issuedate}}</td>
                        <td>{{$dcm->expireddate}}</td>
                        <td>
                        @if($dcm->statusdoc == 1) 
                        <i class="fas fa-check-circle text-secondary"></i>
                        @elsif($dcm->statusdoc == 2)
                        <i class="fas fa-check-circle text-success"></i>
                        @elsif($dcm->statusdoc == 3)
                        <i class="fas fa-check-circle text-warning"></i>
                        @else
                        <i class="fas fa-check-circle text-danger"></i>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>