<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReservationModalLabel">Edit Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBookingForm" action="UpdateBooking" method="POST">
                    <input type="hidden" id="EventID" name="EventID" value="EventID">

                    <!-- Event Category -->
                    <div class="mb-3">
                        <label for="CategoryID" class="form-label">Event Category</label>
                        <select id="CategoryID" name="CategoryID" class="form-select" required>
                            <option value="">Select Event</option>
                            <option value="1">Wedding</option>
                            <option value="2">Birthday</option>
                            <option value="3">Debut</option>
                            <option value="4">Burial</option>
                        </select>
                    </div>

                    <!-- Contact Number -->
                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact Number</label>
                        <input type="tel" id="contactNumber" name="contactNumber" class="form-control" required maxlength="11" pattern="\d{11}">
                    </div>

                    <!-- Date and Time -->
                    <div class="row g-3">
                        <div class="col">
                            <label for="date" class="form-label">Event Date</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="time" class="form-label">Event Time</label>
                            <input type="time" id="time" name="time" class="form-control" required>
                        </div>
                    </div>

                    <!-- Package Selection -->
                    <div class="mt-3">
                        <label for="packageID" class="form-label">Package</label>
                        <select id="packageID" name="packageID" class="form-select">
                            <option value="1">Photo Coverage Only</option>
                            <option value="2">Photo Coverage Only w/ Prints and Flashdrive</option>
                            <option value="3">Photo Coverage, Drone Photo Only With Prints & Flashdrive</option>
                            <option value="4">Video Coverage Only</option>
                            <option value="5">Video Coverage Only With Flashdrive</option>
                            <option value="6">Video Coverage Only, Drone Video With Flashdrive</option>
                            <option value="7">Photo Coverage & Video Coverage Only</option>
                            <option value="8">Photo Coverage, Video Coverage With Prints & Flashdrive</option>
                            <option value="9">Photo Coverage, Video Coverage, Drone Photo, Drone Video With Prints & Flashdrive</option>
                        </select>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                     

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function getEventID(button) {
    const EventID = button.getAttribute("data-event-id");
    console.log("EventID:", EventID);

    // Set the EventID into the hidden field in the form
    document.getElementById("EventID").value = EventID;

    // Fetch booking details and populate the modal (optional, based on the fetched data)
    fetch(`/getBookingDetails/${eventId}`)
        .then((response) => {
            if (!response.ok) throw new Error(`HTTP Status ${response.status}`);
            return response.json();
        })
        .then((data) => {
            // Populate modal fields with fetched data
            document.getElementById("CategoryID").value = data.CategoryID || "";
            document.getElementById("contactNumber").value = data.contactNumber || "";
            document.getElementById("date").value = data.date || "";
            document.getElementById("time").value = data.time || "";
            document.getElementById("packageID").value = data.packageID || "";
        })
        .catch((error) => {
            console.error("Error fetching booking details:", error);
            alert("Failed to load booking details. Please try again.");
        });
}

document.getElementById('editBookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('User/UpdateReservation', {
        method: 'POST',
        body: formData
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            alert('Booking updated successfully!');
            var editModal = bootstrap.Modal.getInstance(document.getElementById('editReservationModal'));
            editModal.hide();
            // Optionally, refresh the page or update the booking list
            location.reload();
        } else {
            alert('Failed to update booking.');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Error Failed to update booking.');
    });
});
</script>

<script>
    function getEventIDForDelete(button) {
    const eventId = button.getAttribute("data-event-id");
    console.log("EventID to delete:", eventId);

    // Confirm deletion with the user
    if (!confirm("Are you sure you want to delete this booking?")) {
        return; // Exit if the user cancels the action
    }

    // Send a DELETE request to the server
    fetch(`/User/DeleteReservation/${eventId}`, {
        method: 'DELETE',
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP Status ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                alert("Booking deleted successfully!");
                // Optionally, remove the deleted booking from the UI or refresh the page
                location.reload();
            } else {
                alert("Failed to delete booking.");
            }
        })
        .catch((error) => {
            console.error("Error deleting booking:", error);
            alert("An error occurred. Failed to delete booking.");
        });
}
</script>