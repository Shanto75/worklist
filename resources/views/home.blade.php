<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>WorkList</title>
</head>

<body class="w-100 h-100 bg-dark ">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('/')}}"> <span class="text-success">Work</span><span class="text-warning">List</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="m-2 collapse navbar-collapse text-center justify-content-end" id="navbarSupportedContent">
                <a class="btn btn-dark nav-link text-warning" data-bs-toggle="modal" data-bs-target="#addModal">Add New List</a>
            </div>
        </div>
    </nav>

    <div class="container overflow-auto">
        @if (session()->has('message'))    
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h6 class="text-center"><strong>{{ session()->get('message') }}</strong></h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="py-5 text-center text-white">My Work List</h1>
        <button class="btn btn-warning float-end mb-4" data-bs-toggle="modal" data-bs-target="#addModal">Add New List</button>
        <table class="table border table-dark text-white table-responsive text-wrap">
            <thead class="table-warning">
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Details</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($lists as $list)    
              <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->title}}</td>
                <td>{{$list->details}}</td>
                <td>{{ date('d/m/y h:i A', strtotime($list->time)) }}</td>
                <td>
                  <span class="badge bg-success {{$list->status ? 'bg-success' : 'bg-danger'}}">{{$list->status ? 'Done' : 'Pending'}}</span>
                </td>
                <td>
                  <a href="{{url('/statusDone/'.$list->id)}}" class="btn btn-sm btn-success bi bi-check2-square"></a>
                  <a href="{{url('/statusPending/'.$list->id)}}" class="btn btn-sm btn-warning bi bi-x-square"></a>
                  <button class="update btn btn-sm btn-primary bi bi-pencil-square"></button>
                  <a href="{{url('/deleteList/'.$list->id)}}" class="btn btn-sm btn-danger bi bi-trash"></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          {{$lists->links()}}
    </div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-4 bg-dark">
      
      <div class="float-end">
        <button type="button" class="btn-close btn-close-white float-end" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <h4 class="text-center py-3 text-white">Add New Work Details</h4>
      <div class="modal-body">
        <form action="{{url('/addlist')}}" method="post">
          @csrf
          <input type="hidden" name="id" id="id">
          <div class="form-floating mb-3">
            <input type="text" name="title" class="form-control" id="title" placeholder="Work Title" required>
            <label for="title">Work Title</label>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="details" placeholder="Work Details" id="details" style="height: 200px" required></textarea>
            <label for="details">Work Details</label>
          </div>
          <div class="mb-3">
            <label class="text-white" for="floatingInput">Date and Time</label>
            <input type="datetime-local" name="time" class="form-control" id="time" placeholder="Date and Time" required>
          </div>
          <div class="py-4">
            <button type="submit" class="btn btn-primary py-2 px-4">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>

  updates = document.getElementsByClassName('update');
  Array.from(updates).forEach((element) => {
      element.addEventListener("click", (e) => {
          tr = e.target.parentNode.parentNode;

          id.value = tr.getElementsByTagName("td")[0].innerText;
          title.value = tr.getElementsByTagName("td")[1].innerText;
          details.value = tr.getElementsByTagName("td")[2].innerText;
          time.value = tr.getElementsByTagName("td")[3].innerText;

          $('#addModal').modal('toggle');
      })
  })
</script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>