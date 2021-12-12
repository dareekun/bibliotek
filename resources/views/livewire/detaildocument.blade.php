<div>
    <div class="row">
        <div class="col-12">
            <div class="card border">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3"><b>0001</b></div>
                        <div class="col-9 text-end">
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#Modal1">
                                <i class="fas fa-file-upload"></i> <span> Update Document</span></button>
                            <button class="btn btn-sm btn-outline-primary">
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
                        <div class="col-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-2">Person In Notify</div>
                        <div class="col-3">
                            Person A
                            <br> Person B
                            <br> Person C
                            <br> Person D
                            <br> Person E
                        </div>
                        <div class="col-2">Remark</div>
                        <div class="col-3">Remarks Here</div>
                    </div>
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
                        <td><a href="/document/0001">0001</a></td>
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
                            <button class="btn btn-outline-warning"><i class="fas fa-history"></i> Update
                                Document</button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-danger"><i class="fas fa-exclamation-circle"></i> Deactive
                                Document</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>