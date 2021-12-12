<div>
    <div class="row me-4">
        <div class="col-3">
            <div class="input-group mb-3">
                <input wire.model.defer="search"  placeholder="Search" class="form-control" type="text">
                <span class="input-group-text" id="basic-addon2">Search</span>
            </div>
        </div>
        <div class="col-9 text-end">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="far fa-plus-square"></i> <span> Add Department</span></button>
        </div>
    </div>
    <div class="row mt-4 me-4">
        <div class="col-12">
            <table id="example" class="display table border table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Department Name</th>
                        @can('isDeveloper')
                        <th>Location</th>
                        @endcan
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $index => $dpt)
                    <tr>
                        @if ($dpt->status == 1)
                        <td><input class="form-control" wire:model.defer="departments.{{$index}}.code" type="text"></td>
                        <td><input class="form-control" wire:model.defer="departments.{{$index}}.department" type="text"></td>
                        @can('isDeveloper')
                        <td><input class="form-control" wire:model.defer="departments.{{$index}}.location" type="text"></td>
                        @endcan
                        <td>
                            <button class="btn btn-small btn-outline-success"
                                wire:click="save('{{$dpt->id}}', {{$index}})"><i class="fas fa-save"></i> Save</button>
                        </td>
                        @else
                        <td>{{$dpt->code}}</td>
                        <td>{{$dpt->department}}</td>
                        @can('isDeveloper')
                        <td>{{$dpt->location}}</td>
                        @endcan
                        <td>
                            <button class="btn btn-small btn-outline-primary" wire:click="edit('{{$dpt->id}}')"><i class="far fa-edit"></i></button>
                            <button class="btn btn-small btn-outline-danger" wire:click="delete('{{$dpt->id}}')"><i
                                    class="far fa-trash-alt"></i></button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <section class="section">
        <!-- Modal for add department -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submit">
                            <div class="mb-3">
                                <label class="form-label">ID Department</label>
                                <input type="text" required wire:model.defer="inputcode" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Department Name</label>
                                <input type="text" required wire:model.defer="inputname" class="form-control">
                            </div>
                            @can('isDeveloper')
                            <div class="mb-3">
                                <label class="form-label">Department Location</label>
                                <input type="text" required wire:model.defer="inputloc" class="form-control">
                            </div>
                            @endcan
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Department</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for delete confirmation -->
        <div class="modal fade" id="deletedpt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this departnment?
                        <p>{{ $deletecode }} - {{ $deletedpt }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger" wire:click="confirm">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>