<div>
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="/setting" aria-current="page">
                                Category Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="/tabsetting">Location Setting</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body pt-4">
                    <div class="row my-4">
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
                                        <th>ID</th>
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
                                        <td><input class="form-control" wire:model.defer="locations.{{$index}}.code"
                                                type="text"></td>
                                        <td><input class="form-control" wire:model.defer="locations.{{$index}}.desc"
                                                type="text"></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-success"
                                                wire:click="saveloc({{$loc->id}}, {{$index}})"><i
                                                    class="fas fa-save"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                wire:click="cancelloc({{$index}})"><i
                                                    class="fas fa-window-close"></i></button>
                                        </td>
                                        @else
                                        <td>{{$loc->code}}</td>
                                        <td>{{$loc->desc}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                wire:click="editloc({{$index}})"><i
                                                    class="far fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                wire:click="deleteloc({{$loc->id}})"><i
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

    <!-- Modal for add location -->
    <div class="modal fade" id="addlocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="submitloc">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Location ID</label>
                            <input type="text" required wire:model.defer="inputcode" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location Description</label>
                            <input type="text" required wire:model.defer="inputloc" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Location</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>