<div>
    <div class="row mt-4">
        <div class="col-7">
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-2">
            <div class="row border-start border-5 border-success mb-2">
                <p class="lead"><a href="{{ route('documenttype', 'valid') }}"class="text-decoration-none text-dark">Valid Document</a> </p>
                <h3 class="rcData">{{$valid}}</h3>
            </div>
            <div class="row border-start border-5 border-danger mb-2">
                <p class="lead"><a href="{{ route('documenttype', 'pending') }}"class="text-decoration-none text-dark">Pending Document</a> </p>
                <h3 class="rcData">{{$pending}}</h3>
            </div>
            <div class="row border-start border-5 border-warning mb-2">
                <p class="lead"><a href="{{ route('documenttype', 'ongoing') }}"class="text-decoration-none text-dark">Ongoing Document</a> </p>
                <h3 class="rcData">{{$ongoing}}</h3>
            </div>
            <div class="row border-start border-5 border-info mb-2">
                <p class="lead"><a href="{{ route('documenttype', 'wating') }}"class="text-decoration-none text-dark">Waiting Document</a> </p>
                <h3 class="rcData">{{$wating}}</h3>
            </div>
            <div class="row border-start border-5 border-secondary mb-2">
                <p class="lead"><a href="{{ route('documenttype', 'deactive') }}"class="text-decoration-none text-dark">Deactive Document</a> </p>
                <h3 class="rcData">{{$deactive}}</h3>
            </div>
            <div class="row text-white rounded bg-primary mb-2">
                <p class="lead">Total Document</p>
                <h3>{{$valid + $pending + $ongoing + $wating + $deactive}}</h3>
            </div>
        </div>
    </div>
</div>