<div>
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-current="page">
                                Category Configuration</a>
                        </li>
                        @can('isDeveloper')
                        <li class="nav-item">
                            <a class="nav-link" href="/tabsetting">Location Setting</a>
                        </li>
                        @endcan
                    </ul>
                </div>
                <div class="card-body pt-4">
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
                                <i class="far fa-plus-square"></i> <span> Add Sub-Category</span></button>
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
                                        <th style="width:100px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categorys) == 0)
                                    <tr>
                                        <td class="text-center" colspan="6">No data yet.</td>
                                    </tr>
                                    @else
                                    @foreach ($categorys as $index => $cat)
                                    <tr>
                                        @if ($statuscat[$index] == 1)
                                        <td>{{$index + 1}}</td>
                                        <td><input class="form-control" wire:model.defer="categorys.{{$index}}.desc"
                                                type="text"></td>
                                        @can('isDeveloper')
                                        <td>
                                            <select class="form-select" required
                                                wire:model.defer="categorys.{{$index}}.location"
                                                aria-label="Default select example">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $loc)
                                                <option @if($cat->location == $loc->id) selected @else @endif
                                                    value="{{$loc->id}}">{{$loc->desc}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @endcan
                                        <td>
                                            <button class="btn btn-sm btn-outline-success"
                                                wire:click="savecat('{{$cat->id}}', {{$index}})"><i
                                                    class="fas fa-save"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                wire:click="cancelcat('{{$cat->id}}')"><i
                                                    class="fas fa-window-close"></i></button>
                                        </td>
                                        @else
                                        <td>{{$index + 1}}</td>
                                        <td>{{$cat->desc}}</td>
                                        @can('isDeveloper')
                                        <td>{{$cat->location}}</td>
                                        @endcan
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary"
                                                wire:click="editcat('{{$cat->id}}')"><i
                                                    class="far fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                wire:click="deletecat('{{$cat->id}}')"><i
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
                                <option value="">Select Location</option>
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
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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