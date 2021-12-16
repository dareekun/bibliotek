<div>
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3"><b>{{$pass}}</b></div>
                        <div class="col-9 text-end">
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#Modal1">
                                <i class="fas fa-file-upload"></i> <span> Update Document</span></button>
                                @if ($statusdoc == 0)
                            <button class="btn btn-sm btn-outline-primary" wire:click="editdoc('{{$pass}}')">
                                <i class="fas fa-pencil-alt"></i> <span> Edit Data</span></button>
                                @else
                            <button class="btn btn-sm btn-outline-success" wire:click="editdoc('{{$pass}}')">
                                <i class="fas fa-pencil-alt"></i> <span> Edit Data</span></button>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($records as $index => $rcd)
                    @if ($rcd->status == 1)
                    <div class="row">
                        <div class="col-2">Issue Date</div>
                        <div class="col-3"><input class="form-control" wire:model.defer="records.{{$index}}.issuedate"
                                type="date"></div>
                        <div class="col-2">Expired Date</div>
                        <div class="col-3"><input class="form-control" wire:model.defer="records.{{$index}}.expireddate"
                                type="date"></div>
                    </div>
                    <div class="row">
                        <div class="col-2">Reminder Days</div>
                        <div class="col-3 ">
                            <div class="input-group mb-3">
                                <input class="form-control" wire:model.defer="records.{{$index}}.remider" type="number">
                                <span class="input-group-text">days</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">Person In Charge</div>
                        <div class="col-3">
                            <select class="form-select" required wire:model.defer="pic"
                                aria-label="Default select example">
                                <option selected>Select Users</option>
                                @foreach ($users as $usr)
                                <option value="{{$usr->id}}">{{$usr->nik}} - {{$usr->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">Person In Notify</div>
                        <div class="col-3">
                            @foreach ($records as $index => $rcd)
                            <div class="input-group mb-3">
                                <select class="form-select" required wire:model.defer="pic"
                                    aria-label="Default select example">
                                    <option selected>Select Users</option>
                                    @foreach ($users as $usr)
                                    <option value="{{$usr->id}}">{{$usr->nik}} - {{$usr->name}}</option>
                                    @endforeach
                                </select>
                                @endforeach
                            </div>
                            <div class="col-2">Remark</div>
                            <div class="col-3"><input class="form-control" wire:model.defer="records.{{$index}}.remark" type="text"></div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-2">Issue Date</div>
                            <div class="col-3">{{$rcd->issuedate}}</div>
                            <div class="col-2">Expired Date</div>
                            <div class="col-3">{{$rcd->expireddate}}</div>
                        </div>
                        <div class="row">
                            <div class="col-2">Reminder Days</div>
                            <div class="col-3">{{$rcd->reminder}}</div>
                            <div class="col-2">Status Document</div>
                            <div class="col-3">
                                @if ($rcd->statusdoc == 3)
                                <span class="text-danger">Expired</span>
                                @elseif ($rcd->statusdoc == 2)
                                <span class="text-warning">Deadline</span>
                                @elseif ($rcd->statusdoc == 1)
                                <span class="text-success">Valid</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">Person In Charge</div>
                            <div class="col-3">{{$rcd->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-2">Person In Notify</div>
                            <div class="col-3">
                                @foreach ($notif as $ntf)
                                {{$ntf->name}} <br>
                                @endforeach
                            </div>
                            <div class="col-2">Remark</div>
                            <div class="col-3">{{$rcd->remark}}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <table id="example" class="display table border table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No Document</th>
                            <th>Issue date</th>
                            <th>Expired date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="/document/{{$pass}}">0001</a></td>
                            <td>21 - 12 - 2021</td>
                            <td>21 - 12 - 2021</td>
                            <td><i class="fas fa-check-circle text-primary"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row py-2">
                            <div class="col-12 text-center">
                                Do you want Update the document or deactive the document
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-6 text-center">
                                <button class="btn btn-outline-warning" wire:click="update"><i
                                        class="fas fa-history"></i>
                                    Update
                                    Document</button>
                            </div>
                            <div class="col-6 text-center">
                                <button class="btn btn-outline-danger" wire:click="deactive"><i
                                        class="fas fa-exclamation-circle"></i> Deactive
                                    Document</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>