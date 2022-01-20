<div>
    <div class="row">
        <div class="col-12">
            <div class="row my-4">
                <div class="col-6">
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addcategory">
                        <i class="far fa-plus-square"></i> <span> Add Category</span></button>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addsubcategory">
                        <i class="far fa-plus-square"></i> <span> Add Sub-Category {{$subcat}}</span></button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <table id="example" class="display table border table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
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
                                <td><input class="form-control" wire:model.defer="categorys.{{$index}}.code"
                                        type="text"></td>
                                <td><input class="form-control" wire:model.defer="categorys.{{$index}}.desc"
                                        type="text"></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-success"
                                        wire:click="savecat({{$cat->id}}, {{$index}})"><i
                                            class="fas fa-save"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" wire:click="cancelcat({{$index}})"><i
                                            class="fas fa-window-close"></i></button>
                                </td>
                                @else
                                <td>{{$cat->code}}</td>
                                <td>{{$cat->desc}}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" wire:click="editcat({{$index}})"><i
                                            class="far fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"
                                        wire:click="deletecat('{{$cat->id}}')"><i class="far fa-trash-alt"></i></button>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table id="example" class="display table border table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th style="width:100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($subs) == 0)
                            <tr>
                                <td class="text-center" colspan="6">No data yet.</td>
                            </tr>
                            @else
                            @foreach ($subs as $index => $sub)
                            <tr>
                                @if ($statussub[$index] == 1)
                                <td><input class="form-control" wire:model.defer="subs.{{$index}}.code" type="text">
                                </td>
                                <td>
                                <select class="form-select" required wire:model.defer="subs.{{$index}}.catid"
                                        aria-label="Default select example">
                                        @foreach ($categorys as $cat)
                                        <option value="{{$cat->id}}">{{$cat->desc}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input class="form-control" wire:model.defer="subs.{{$index}}.desc" type="text">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-success"
                                        wire:click="savesub({{$sub->id}}, {{$index}})"><i
                                            class="fas fa-save"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" wire:click="cancelsub({{$index}})"><i
                                            class="fas fa-window-close"></i></button>
                                </td>
                                @else
                                <td>{{$sub->code}}</td>
                                <td>{{$sub->cat}}</td>
                                <td>{{$sub->desc}}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" wire:click="editsub({{$index}})"><i
                                            class="far fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"
                                        wire:click="deletesub({{$sub->id}})"><i class="far fa-trash-alt"></i></button>
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
                            <label class="form-label">Category ID</label>
                            <input type="text" required wire:model.defer="input0" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category Description</label>
                            <input type="text" required wire:model.defer="input1" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for add subcategory -->
    <div class="modal fade" id="addsubcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitsubcat">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" required wire:model.defer="subcat"
                                aria-label="Default select example">
                                <option>Select Category</option>
                                @foreach ($categorys as $cat)
                                <option value="{{$cat->id}}">{{$cat->desc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category ID</label>
                            <input type="text" required wire:model.defer="subcode" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Category Description</label>
                            <input type="text" required wire:model.defer="subdesc" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Sub Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for delete confirmation -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete {{ucwords($modaltitle)}}</h5>
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