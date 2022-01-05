<div>
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8 text-end">
            @can('isUser')
            <a class="btn btn-outline-success" href="{{ route('newdocument') }}">
                <i class="far fa-plus-square"></i> <span> Add Document</span></a>
            @endcan
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <table id="example" class="display table border table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Pic</th>
                        <th>Category</th>
                        <th>Issue date</th>
                        <th>Expired date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $index => $dcm)
                    <tr>
                        <td><a href="{{ route('documenttype', $dcm->id) }}">{{strtoupper($dcm->locode.'/'.$dcm->catcode.'/'.date('Ymd', strtotime($dcm->created_at)).'/'.$dcm->no)}}</a></td>
                        <td>{{$dcm->pic}}</td>
                        <td>{{$dcm->category}}</td>
                        <td>{{$dcm->issuedate}}</td>
                        <td>{{$dcm->expireddate}}</td>
                        <td>
                        @if($dcm->statusdoc == 1) 
                        <i class="fas fa-check-circle text-success"></i>
                        @elseif($dcm->statusdoc == 2)
                        <i class="fas fa-check-circle text-warning"></i>
                        @elseif($dcm->statusdoc == 3)
                        <i class="fas fa-check-circle text-danger"></i>
                        @else
                        <i class="fas fa-check-circle text-secondary"></i>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>