<div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border text-white bg-success mb-3">
                <div class="card-body">
                    <div class="row align-middle">
                        <span class="col-sm-3 align-middle">
                            <h2>50</h2>
                        </span>
                        <span class="col-sm-9 align-middle">
                            <h2> Total</h2>
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
                            <h2>50</h2>
                        </div>
                        <div class="col-sm-9 align-middle">
                            <h2> Progress</h2>
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
                                <h2>50</h2>
                            </div>
                            <div class="col-sm-9 align-middle">
                                <h2> Expired</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-12">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="far fa-plus-square"></i> <span> Add Document</span></button>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form wire:submit.prevent="adddocument">
                    <div class="mb-3">
                        <label for="start" class="form-label">No Document</label>
                        <input type="text" required name="start" id="start" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="end" class="form-label">End Date</label>
                        <input type="date" required name="end" id="end" class="form-control">
                    </div>
                    <label for="reminder" class="form-label">Remind Me Before</label>
                    <div class="input-group mb-3">
                        <input type="number" required name="reminder" id="reminder" class="form-control">
                        <span class="input-group-text" id="basic-addon2">days</span>
                    </div>
                    <div class="mb-3">
                        <label for="end" class="form-label">Remark</label>
                        <input type="text" required name="end" id="end" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment</label>
                        <input type="file" required name="attachment" id="attachment" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Person in Charge</label>
                        <input type="email" required name="attachment" id="attachment" class="form-control">
                    </div>
                    <label for="person" class="form-label">Person in Notify</label>
                    @for ($i = 1; $i < $pin ; $i++)
                    <div class="input-group mb-3">
                        <input type="email" required wire:model.defer="pin[0]" aria-describedby="basic-addon2"
                            class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-primary"  type="button"><i class="fas fa-user-plus"></i></button>
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-success">Save changes</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>