<!-- create modal  -->
<form action="./store.php" method="POST">
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="note">Note</label>
                        <textarea name="note" id="note" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>