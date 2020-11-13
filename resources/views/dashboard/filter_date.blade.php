  <div class="collapse" id="collapseExample">
    <div class="card">
      <div class="card-header">
          <h3 class=""><i class="ni ni-calendar-grid-58"></i> &nbsp Filter date</h3>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <label for="exampleInputtext1">Category &nbsp : &nbsp </label>

            @if($filter_date->kategori == 'today')
            <a href="{{url('/backend/dashboard/date/today')}}" class="btn btn-primary btn-sm">Today</a>
            @else
            <a href="{{url('/backend/dashboard/date/today')}}" class="btn btn-secondary btn-sm">Today</a>
            @endif

            @if($filter_date->kategori == 'month')
            <a href="{{url('/backend/dashboard/date/month')}}" class="btn btn-primary btn-sm">This month</a>
            @else
            <a href="{{url('/backend/dashboard/date/month')}}" class="btn btn-secondary btn-sm">This month</a>
            @endif

            @if($filter_date->kategori == 'year')
            <a href="{{url('/backend/dashboard/date/year')}}" class="btn btn-primary btn-sm">This year</a>
            @else
            <a href="{{url('/backend/dashboard/date/year')}}" class="btn btn-secondary btn-sm">This year</a>
            @endif

            &nbsp | &nbsp &nbsp

            @if($filter_date->kategori == 'all')
            <a href="{{url('/backend/dashboard/date/all')}}" class="btn btn-primary btn-sm">Big Data</a>
            @else
            <a href="{{url('/backend/dashboard/date/all')}}" class="btn btn-warning btn-sm">Big Data</a>
            @endif
          </div>
        </div>


        <br>


        @if($filter_date->kategori != 'today')
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputtext1">Start date</label>
              <input class="form-control date date_min" type="text" name="mulaisewa[]" id="mulaisewa" placeholder="mm / dd / yyyy" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputtext1">End date</label>
              <input class="form-control date date_max" type="text" name="mulaisewa[]" id="mulaisewa" placeholder="mm / dd / yyyy" required>
            </div>
          </div>
        </div>
        @else
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputtext1">Start date</label>
              <input class="form-control date date_min" type="text" name="mulaisewa[]" id="mulaisewa" placeholder="mm / dd / yyyy" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputtext1">End date</label>
              <input class="form-control date date_max" type="text" name="mulaisewa[]" id="mulaisewa" placeholder="mm / dd / yyyy" disabled>
            </div>
          </div>
        </div>
        @endif
        
      </div>
      <div class="card-footer">
        <a class="btn btn-danger float-right pl-5 pr-5" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Cancel</a>
      </div>
  </div>
</div>