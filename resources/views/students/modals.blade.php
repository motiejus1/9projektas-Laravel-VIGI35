<div class="modal fade" id="studentCreateModal" tabindex="-1" aria-labelledby="studentCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="studentCreateModalLabel">Create Student</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="ajaxCreate" data-ajax-action-url="{{route('students.storeAjax')}}" > 
                @csrf
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">

                <label for="surname">Surname</label>
                <input type="text" id="surname" name="surname" class="form-control" placeholder="Surname">

                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email">

                <label for="avg_grade">Average grade</label>
                <input type="text" id="avg_grade" name="avg_grade" class="form-control" placeholder="Average grade">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="createStudent" type="button" class="btn btn-primary">Create</button>
        </div>
      </div>
    </div>
</div>