<x-slot name="header">
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10"><b>0001</b></div>
                        <div class="col-2 text-end">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fas fa-pencil-alt"></i> <span> Edit Data</span></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">Start Date</div>
                        <div class="col-3">13 December 2021</div>
                        <div class="col-2">End Date</div>
                        <div class="col-3">13 December 2021</div>
                    </div>
                    <div class="row">
                        <div class="col-2">Reminder Days</div>
                        <div class="col-3">13 Days Before</div>
                        <div class="col-2">Remainder Days</div>
                        <div class="col-3">13 Days Remain</div>
                    </div>
                    <div class="row">
                        <div class="col-2">Person In Charge</div>
                    </div>
                    <div class="row">
                        <div class="col-2">Person In Notify</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-slot>
<section class="section">
    <div class="row">
        <div class="col-6 col-sm-12">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-file-upload"></i> <span> Update Document</span></button>
        </div>
    </div>
    <div class="row mt-4">
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
                        <td><a href="/document/0001">0001</a></td>
                        <td>Tiger Nixon</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td><i class="fas fa-check-circle text-primary"></i></td>
                    </tr>
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
                        <label for="attachment" class="form-label">Attachment</label>
                        <input type="file" required name="attachment" id="attachment" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Person in Charge</label>
                        <input type="email" required name="attachment" id="attachment" class="form-control">
                    </div>
                    <label for="person" class="form-label">Person in Notify</label>
                    <div class="input-group mb-3">
                        <input type="email" required name="person" id="person" aria-describedby="basic-addon2"
                            class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"><i class="fas fa-user-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-success">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</section>