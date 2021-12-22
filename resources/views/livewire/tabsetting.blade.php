<div>
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="/setting" aria-current="page">
                                Setting Configuration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="/tabsetting">Table Setting</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body pt-4">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#addlocation">
                                <i class="far fa-plus-square"></i> <span> Add Location</span></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <table id="example" class="display table border table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Location</th>
                                        <th style="width:100px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($locations) == 0)
                                    <tr>
                                        <td class="text-center" colspan="6">No data yet.</td>
                                    </tr>
                                    @else
                                    @foreach ($locations as $index => $loc)
                                    <tr>
                                        @if ($statusloc[$index] == 1)
                                        <td>{{$index + 1}}</td>
                                        <td><input class="form-control" wire:model.defer="locations.{{$index}}.desc"
                                                type="text"></td>
                                        <td>
                                            <button class="btn btn-sm w-25 btn-outline-success"
                                                wire:click="saveloc('{{$loc->id}}', {{$index}})"><i
                                                    class="fas fa-save"></i></button>
                                            <button class="btn btn-sm w-25 btn-outline-danger"
                                                wire:click="cancelloc('{{$cat->id}}')"><i
                                                    class="fas fa-window-close"></i></button>
                                        </td>
                                        @else
                                        <td>{{$index + 1}}</td>
                                        <td>{{$loc->desc}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                wire:click="editloc('{{$loc->id}}')"><i
                                                    class="far fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                wire:click="deleteloc('{{$loc->id}}')"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for add setting -->
    <div class="modal fade" id="addsetting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Adding Setting still need hardcode for HTML, It cannot be use even the value already created!</p>
                    <form wire:submit.prevent="submit">
                        <div class="mb-3">
                            <label class="form-label">Setting Name</label>
                            <input type="text" required wire:model.defer="input1" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Setting Location</label>
                            <select class="form-select" required wire:model.defer="input2"
                                aria-label="Default select example">
                                <option value="">Select Location</option>
                                @foreach ($locations as $loc)
                                <option value="{{$loc->id}}">{{$loc->desc}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Setting</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for delete confirmation -->
    <div class="modal fade" id="deletesetting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-danger">
                        Please Be Carefull When Delete Setting, It May Be Broke Some Of Configuration!.</h5>
                    <p> Are you sure want to delete this configuration? <br>
                        {{ $name }} - {{ $value }} - {{ $location }} </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" wire:click="confirm">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>