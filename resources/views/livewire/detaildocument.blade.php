<div>
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3"><b>{{$pass}}</b></div>
                        <div class="col-9 text-end">
                            @if ($docstatus == 0)
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#Modal0">
                                <i class="fas fa-file-upload"></i> <span> Reactive Document</span></button>
                            @else 
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#Modal1">
                                <i class="fas fa-file-upload"></i> <span> Update Document</span></button>
                            @endif
                            @if ($statusdoc == 0)
                            <button class="btn btn-sm btn-outline-info" wire:click="editdoc()">
                                <i class="fas fa-pencil-alt"></i> <span> Edit</span></button>
                            @else
                            <button class="btn btn-sm btn-outline-danger" wire:click="canceldoc()">
                                <i class="fas fa-undo"></i> <span> Cancel</span></button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($records as $index => $rcd)
                    @if ($statusdoc == 1)
                    <div class="row my-3">
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
                                <input class="form-control" wire:model.defer="records.{{$index}}.reminder"
                                    type="number">
                                <span class="input-group-text">days</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">Document Owner</div>
                        <div class="col-3">
                            <select class="form-select" required wire:model.defer="records.{{$index}}.idpic"
                                aria-label="Default select example">
                                <option selected>Select Users</option>
                                @foreach ($users as $usr)
                                <option value="{{$usr->id}}">{{$usr->nik}} - {{$usr->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">Remark</div>
                        <div class="col-3"><input class="form-control" wire:model.defer="records.{{$index}}.remark"
                                type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col-2">Person In Notify</div>
                        <div class="col-4">
                            @foreach ($notif as $no => $ntf)
                            <div class="row">
                                <div class="col-10">
                                    <div class="input-group mb-3">
                                        <select class="form-select" required wire:model.defer="notif.{{$no}}.iduser"
                                            wire:change="changepin({{$ntf->id}}, {{$no}})"
                                            aria-label="Default select example">
                                            <option selected>Select Users</option>
                                            @foreach ($users as $usr)
                                            <option value="{{$usr->id}}">{{$usr->nik}} - {{$usr->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                <button class="btn btn-outline-danger" wire:click="deletepin({{$ntf->id}})"><i class="fas fa-times-circle"></i></button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-2">
                        <button class="btn btn-outline-primary" wire:click="addpin"><i class="fas fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-2"><button class="btn btn-outline-success w-100" wire:click="savedoc({{$index}})"><i class="fas fa-save"></i>
                                Save</button></div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-2">Issue Date</div>
                        <div class="col-3">{{date('d-m-Y', strtotime($rcd->issuedate))}}</div>
                        <div class="col-2">Expired Date</div>
                        <div class="col-3">{{date('d-m-Y', strtotime($rcd->expireddate))}}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">Reminder Days</div>
                        <div class="col-3">{{$rcd->reminder}} Before</div>
                        <div class="col-2">Status Document</div>
                        <div class="col-3">
                            @if ($rcd->statusdoc == 1)
                            <i class="fas fa-check-circle text-success"> Valid</i> 
                            @elseif ($rcd->statusdoc == 2)
                            <i class="fas fa-check-circle text-danger"> Pending</i> 
                            @elseif ($rcd->statusdoc == 3)
                            <i class="fas fa-check-circle text-warning"> On Going</i> 
                            @elseif ($rcd->statusdoc == 4)
                            <i class="fas fa-check-circle text-info"> Waiting</i> 
                            @else
                            <i class="fas fa-check-circle text-secondary"> Deactive</i> 
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">Document Owner</div>
                        <div class="col-3">
                            @if ($rcd->name == '')
                            <span class="text-danger"> No Document Owner!</span>
                            @else 
                            {{$rcd->name}}
                            @endif
                        </div>
                        <div class="col-2">Remark</div>
                        <div class="col-3">
                            @if ($rcd->remark == '')
                            <span class="text-danger"> -</span>
                            @else 
                            {{$rcd->remark}}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">Person In Notify</div>
                        <div class="col-3">
                            @foreach ($notif as $ntf)
                            {{$ntf->name}} <br>
                            @endforeach
                        </div>
                        <div class="col-2">Location</div>
                        <div class="col-3">{{$rcd->docloc}}</div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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
                    @foreach ($table as $index => $tbl)
                    <tr>
                        <td><button class="btn btn-sm btn-outline-link" wire:click="showpdf('{{$tbl->file}}')">
                            @if ($tbl->code == '')
                                <span class="text-danger"> No Document ID!</span>
                            @else 
                                {{$tbl->code}}
                            @endif    
                        </button></td>
                        <td>{{date('d-m-Y', strtotime($tbl->issuedate))}}</td>
                        <td>{{date('d-m-Y', strtotime($tbl->expirdate))}}</td>
                        <td>
                            @if ($tbl->statusdoc == 1) 
                            <i class="fas fa-check-circle text-success"> Valid</i> 
                            @elseif ($tbl->statusdoc == 2) 
                            <i class="fas fa-check-circle text-danger"> Pending</i> 
                            @elseif ($tbl->statusdoc == 3)
                            <i class="fas fa-check-circle text-warning"> On Going</i> 
                            @elseif ($tbl->statusdoc == 4)
                            <i class="fas fa-check-circle text-info"> Waiting</i> 
                            @else
                            <i class="fas fa-check-circle text-secondary"> Deactive</i> 
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal 0-->
    <div class="modal fade" id="Modal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reactive Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            Its look like your document have been deactive, Do you want to reactive it again?
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-dismiss="modal"
                                data-bs-target="#Modal2">Yes</button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-danger" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 1-->
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
                            <button class="btn btn-outline-warning" wire:click="update"><i class="fas fa-history"></i>
                                Update Document</button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-danger" wire:click="deactive"><i
                                    class="fas fa-exclamation-circle"></i> Deactive Document</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 2-->
    <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" wire:ignore aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload New Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="newdoc">
                <div class="modal-body">
                    <div class="row py-2">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="start" class="form-label">No Document</label>
                                <input type="text" wire:model.defer="newnodoc" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="end" class="form-label">Issued date</label>
                                <input type="date" required wire:model.defer="newissuedate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="end" class="form-label">Expired date</label>
                                <input type="date" required wire:model.defer="newexpiredate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="file" accept=".pdf" required wire:model.defer="newfile" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-success" type="submit">Save</button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Modal PDF -->
    <div class="modal fade bd-example-modal-lg" id="modalpdf" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl h-100">
            <div class="modal-content h-90">
                <div class="modal-body">
                    <embed id="pdfloc" src="{{asset('doc/'.$document.'.pdf')}}" type="application/pdf" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>
</div>