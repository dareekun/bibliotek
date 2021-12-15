<div>
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    Setting Configuration
                </div>
                <div class="card-body pt-4">
                    <div class="row">
                        <div class="col-5">
                            <label for="reminder" class="form-label">Remind Me Every</label>
                            <div class="input-group mb-3">
                                <input type="number" name="reminder" id="reminder" class="form-control">
                                <span class="input-group-text" id="basic-addon2">days</span>
                                <button class="btn btn-outline-success" wire:click="update">update</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-6">
                            <button class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#addcategory">
                                <i class="far fa-plus-square"></i> <span> Add Category</span></button>
                        </div>
                        @can('isDeveloper')
                        <div class="col-6">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#addlocation">
                                <i class="far fa-plus-square"></i> <span> Add Location</span></button>
                        </div>
                        @endcan
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <table id="example" class="display table border table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category</th>
                                        @can('isDeveloper')
                                        <th>Location</th>
                                        @endcan
                                        <th style="width:130px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorys as $index => $cat)
                                    <tr>
                                        @if ($cat->status == 1)
                                        <td>{{$index + 1}}</td>
                                        <td><input class="form-control" wire:model.defer="categorys.{{$index}}.desc"
                                                type="text"></td>
                                        @can('isDeveloper')
                                        <td><input class="form-control" wire:model.defer="categorys.{{$index}}.location"
                                                type="text"></td>
                                        @endcan
                                        <td>
                                            <button class="btn btn-sm w-100 btn-outline-success"
                                                wire:click="savecat('{{$cat->id}}', {{$index}})"><i
                                                    class="fas fa-save"></i> Save</button>
                                        </td>
                                        @else
                                        <td>{{$index + 1}}</td>
                                        <td>{{$cat->desc}}</td>
                                        @can('isDeveloper')
                                        <td>{{$cat->location}}</td>
                                        @endcan
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                wire:click="editcat('{{$cat->id}}')"><i class="far fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                wire:click="deletecat('{{$cat->id}}')"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @can('isDeveloper')
                        <div class="col-6">
                            <table id="example" class="display table border table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Location</th>
                                        <th style="width:130px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $index => $loc)
                                    <tr>
                                        @if ($loc->status == 1)
                                        <td>{{$index + 1}}</td>
                                        <td><input class="form-control" wire:model.defer="locations.{{$index}}.desc"
                                                type="text"></td>
                                        <td>
                                            <button class="btn btn-sm w-100 btn-outline-success"
                                                wire:click="saveloc('{{$loc->id}}', {{$index}})"><i
                                                    class="fas fa-save"></i> Save</button>
                                        </td>
                                        @else
                                        <td>{{$index + 1}}</td>
                                        <td>{{$loc->desc}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                wire:click="editloc('{{$loc->id}}')"><i class="far fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                wire:click="deleteloc('{{$loc->id}}')"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for add category -->
    <div class="modal fade" id="addcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitcat">
                        <div class="mb-3">
                            <label class="form-label">Category Description</label>
                            <input type="text" required wire:model.defer="input1" class="form-control">
                        </div>
                        @can('isDeveloper')
                        <div class="mb-3">
                            <label class="form-label">Category Location</label>
                            <select class="form-select" required wire:model.defer="input2"
                                aria-label="Default select example">
                                <option selected>Select Location</option>
                                @foreach ($locations as $loc)
                                <option value="{{$loc->id}}">{{$loc->desc}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endcan
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @can('isDeveloper')
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
    @endcan

    <!-- Modal for delete confirmation -->
    <div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete {{ucwords($modaltittle)}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ $tulisan }}
                        <p>{{ $referdesc }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger" wire:click="confirm">Yes</button>
                    </div>
                </div>
            </div>
        </div>


</div>