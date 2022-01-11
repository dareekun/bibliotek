<div>
    <div class="row me-4">
        <div class="col-3">
            <div class="input-group mb-3">
                <input wire.model.defer placeholder="Search" class="form-control" type="text">
                <span class="input-group-text" id="basic-addon2">Search</span>
            </div>
        </div>
        <div class="col-9 text-end">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="far fa-plus-square"></i> <span> Add User</span></button>
        </div>
    </div>
    <div class="row mt-4 me-4">
        <div class="col-12">
            <table id="example" class="display table border table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th style="width:130px"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) == 0)
                    <tr>
                        <td class="text-center" colspan="6">No data yet.</td>
                    </tr>
                    @else 
                    @foreach ($users as $index => $usr)
                    <tr>
                        @if ($status[$index] == 1)
                        <td>
                            @can('isSadmin')
                            <input class="form-control" wire:model.defer="users.{{$index}}.nik" type="text">
                            @else
                            <input class="form-control" wire:model.defer="users.{{$index}}.nik" type="number">
                            @endcan
                        </td>
                        <td><input class="form-control" wire:model.defer="users.{{$index}}.name" type="text"></td>
                        <td><input class="form-control" wire:model.defer="users.{{$index}}.email" type="email"></td>
                        <td>
                            <select class="form-select" required wire.model.defer="users.{{$index}}.idpt"
                                aria-label="Default select example">
                                @foreach ($departments as $dpt)
                                <option @if($usr->idpt == $dpt->id) selected @else @endif value="{{$dpt->id}}">{{$dpt->department}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-select" wire:model.defer="users.{{$index}}.role" 
                                    aria-label="Default select example">
                                    <option value="sadmin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="user">User</option>
                                    <option value="pic">Pic</option>
                                </select>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-success"
                                wire:click="save({{$usr->id}}, {{$index}})"><i class="fas fa-save"></i></button>
                            <button class="btn btn-sm btn-outline-danger"
                                wire:click="cancel({{$index}})"><i class="fas fa-window-close"></i></button>
                        </td>
                        @else
                        <td>{{$usr->nik}}</td>
                        <td>{{$usr->name}}</td>
                        <td>{{$usr->email}}</td>
                        <td>{{$usr->department}}</td>
                        <td>{{ucwords($usr->role)}}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" wire:click="edit({{$index}})"><i class="far fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-primary" wire:click="changepass('{{$usr->id}}')"><i class="fas fa-key"></i></button>
                            <button class="btn btn-sm btn-outline-danger" wire:click="delete('{{$usr->id}}')"><i
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


    <!-- Modal -->
    <section class="section">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submit">
                            @can('isDeveloper')
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" required wire:model.defer="inputnik"
                                    class="form-control">
                            </div>
                            @else
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="number" required wire:model.defer="inputnik"
                                    class="form-control">
                            </div>
                            @endcan
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" required wire:model.defer="inputname"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" required wire:model.defer="inputemail"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Password</label>
                                <input type="password" required wire:model.defer="inputpass"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select" required wire:model.defer="inputdept"
                                    aria-label="Default select example">
                                    <option>Select Department</option>
                                    @foreach ($departments as $dpt)
                                    <option value="{{$dpt->id}}">{{$dpt->department}} - {{$dpt->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" required wire:model.defer="inputrole"
                                    aria-label="Default select example">
                                    <option>Select Role</option>
                                    <option value="sadmin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="user">User</option>
                                    <option value="pic">Pic</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for delete confirmation -->
        <div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this User?
                        <p>{{ $deletenik }} - {{ $deletename }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger" wire:click="confirm">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Change Password confirmation -->
        <div wire:ignore>
        <div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="confirmpass">
                            <div class="mb-3">
                                <label for="email" class="form-label">Password</label>
                                <input type="password" required wire:model.defer="inputpass1"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Password Confirm</label>
                                <input type="password" required wire:model.defer="inputpass2"
                                    class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" >Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
</div>