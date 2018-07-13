<div class="card-box">
  <form action="{{ route('search_messages') }}" method="get">
    <div class="row">
      <div class="col-md-10">
        <input type="text" class="form-control" name="q" value="{{ (!empty($_GET['q']))? $_GET['q'] : '' }}" placeholder="Search messages">
      </div>
      <div class="col-md-2">
        <input type="submit" class="btn btn-info btn-block" value="Search">
      </div>
    </div>
  </form>
</div>
