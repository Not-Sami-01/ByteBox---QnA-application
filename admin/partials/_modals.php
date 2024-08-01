<!-- Edit User Modal -->
<div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/forum/admin/partials/_editDeleteHandle.php" method="post" >
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label" >Id</label>
            <input type="number" name="newUserId" class="form-control" id="editUserId" >
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="newUsername" id="editUsername">
          </div>
          <div class="mb-3">
            <label class="form-label">New Password (Optional)</label>
            <input type="text" name="newPassword" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          id
          <input type="hidden" name="currUserId" id="currUserId">
          <input type="hidden" name="url" id="euUrl">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
  </div>
</div>
</div>



<!-- Edit Thread Modal -->
<div class="modal fade" id="EditThreadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Thread</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/forum/admin/partials/_editDeleteHandle.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Id</label>
            <input type="number" name="newThreadId" class="form-control" id="editThreadId">
          </div>
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="newThreadTitle" class="form-control" id="editThreadTitle">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea type="text" class="form-control" name="newThreadDescription" id="editThreadDescription"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="text" name="id" id="currThreadId">
          <input type="hidden" name="url" id="etUrl">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Edit Comment Modal -->
<div class="modal fade" id="EditCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Comment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/forum/admin/partials/_editDeleteHandle.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Comment id</label>
            <input type="number" name="newCommentId" class="form-control" id="editCommentId">
          </div>
          <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea type="text" name="newCommentContent" class="form-control" id="editCommentContent"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="currCommentId">
          <input type="hidden" name="url" id="ecUrl">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->


<div class="modal fade" id="DeleteEntry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Entry</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/forum/admin/partials/_editDeleteHandle.php" method="post">
        <div class="modal-body">
          Are you sure you?
        </div>
        <div class="modal-footer">
          <input type="hidden" name="delUrl" id="dUrl">
          <input type="hidden" name="delType" id="deleteType">
          <input type="hidden" name="delId" id="deleteId">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

