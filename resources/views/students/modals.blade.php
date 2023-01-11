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

<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="studentEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="studentEditModalLabel">Edit Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div id="ajaxEdit" data-ajax-action-url="{{route('students.updateAjax')}}" > 
              @csrf

            <input type="hidden" id="student_id" name="student_id" value="">

              <label for="name">Name</label>
              <input type="text" id="edit_student_name" name="edit_student_name" class="form-control" placeholder="Name">

              <label for="surname">Surname</label>
              <input type="text" id="edit_student_surname" name="edit_student_surname" class="form-control" placeholder="Surname">

              <label for="email">Email</label>
              <input type="text" id="edit_student_email" name="edit_student_email" class="form-control" placeholder="Email">

              <label for="avg_grade">Average grade</label>
              <input type="text" id="edit_student_avg_grade" name="edit_student_avg_grade" class="form-control" placeholder="Average grade">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="editStudent" type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>