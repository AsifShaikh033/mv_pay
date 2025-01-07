
// When the delete button is clicked, pass the user ID to the modal
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var userId = button.data('id'); // Extract info from data-* attributes

    // Set the hidden input field with the user ID
    $('#user_id').val(userId);
});
