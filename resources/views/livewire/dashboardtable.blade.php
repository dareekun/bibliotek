<div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border text-white bg-success mb-3">
                <div class="card-body">
                    <div class="row align-middle">
                        <span class="col-sm-3 align-middle my-auto text-center">
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
                        <div class="col-sm-3 align-middle text-center my-auto">
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
                            <div class="col-sm-3 align-middle text-center my-auto">
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
        <div class="col-sm-4">
            <input class="form-control" placeholder="Search" wire:model.defer="inputsearch" type="text">
        </div>
        <div class="col-sm-8 text-end">
            <a class="btn btn-outline-success" href="/newdocument">
                <i class="far fa-plus-square"></i> <span> Add Document</span></a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <table id="example" class="display table border table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Pic</th>
                        <th>Category</th>
                        <th>Issue date</th>
                        <th>Expired date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($documents) == 0)
                    <tr>
                        <td class="text-center" colspan="6">No data yet.</td>
                    </tr>
                    @else 
                    @foreach ($documents as $index => $dcm)
                    <tr>
                        <td><a href="/document/{{$dcm->id}}">{{ucwords($dcm->title)}}</a></td>
                        <td>{{$dcm->pic}}</td>
                        <td>{{$dcm->category}}</td>
                        <td>{{$dcm->issuedate}}</td>
                        <td>{{$dcm->expireddate}}</td>
                        <td>
                        @if($dcm->statusdoc == 1) 
                        <i class="fas fa-check-circle text-success"></i>
                        @elseif($dcm->statusdoc == 2)
                        <i class="fas fa-check-circle text-warning"></i>
                        @elseif($dcm->statusdoc == 3)
                        <i class="fas fa-check-circle text-danger"></i>
                        @else
                        <i class="fas fa-check-circle text-secondary"></i>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>