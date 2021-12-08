    <x-slot name="header">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <div class="row align-middle">
                            <span class="col-sm-3 align-middle">
                                <h2>50</h2>
                            </span>
                            <span class="col-sm-9 align-middle">
                                <h2> Total</h2>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3 align-middle">
                                <h2>50</h2>
                            </div>
                            <div class="col-sm-9 align-middle">
                                <h2> Progress</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-sm-3 align-middle">
                                    <h2>50</h2>
                                </div>
                                <div class="col-sm-9 align-middle">
                                    <h2> Expired</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <section class="section mt-5">
        <div class="row">
            <div class="col-6 col-sm-12">
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-square-fill"></i> <span> Add
                        Document</span></button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <table id="example" class="display table border table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No Document</th>
                            <th>Pic</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>