<section id="Books" class="services section">

  <div class="container section-title" data-aos="fade-up">
    <h2>My Bookings</h2>


  <div class="container">
    <div class="col-12">
      <!-- Card -->
      <div class="card shadow-sm"></div>
      <form class="form-inline my-2 my-lg-0" onsubmit="return false;" id="searchbar">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      </form>

      <div class="table-responsive">
        <table class="table table-hover">
          <div class="card-body bg-light">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>Event</th>
                    <th>Contact</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- New column for Edit button -->
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($customerbookings)) : ?>
                    <?php foreach ($customerbookings as $booking) : ?>
                      <tr onclick="openModal('<?php echo $booking->CategoryID; ?>', '<?php echo $booking->contactNumber; ?>', '<?php echo $booking->date; ?>', '<?php echo $booking->time; ?>', '<?php echo $booking->bookingStatus; ?>')">
                        <td><?php echo $booking->CategoryName; ?></td>
                        <td><?php echo $booking->contactNumber; ?></td>
                        <td><?php echo $booking->date; ?></td>
                        <td>
                          <?php
                          $time24 = $booking->time;
                          $time12 = date("g:i A", strtotime($time24));
                          echo $time12;
                          ?>
                        </td>
                        <td onclick="event.stopPropagation();">
                          <div style="display: flex; align-items: center; gap: 10px;">
                            <div id="status">
                              <?php echo $booking->bookingStatus === '1' ? 'Approved' : 'Pending'; ?>
                            </div>
                          </div>
                        </td>
                        <td onclick="event.stopPropagation();">
    <!-- Button to Open Modal -->  
<!-- Trigger Button -->
<button 
    class="btn btn-primary" 
    data-event-id="<?php echo $booking->EventID; ?>"
    data-bs-toggle="modal" 
    data-bs-target="#editReservationModal" 
    onclick="getEventID(this)">
    Edit
</button>

<!-- Delete Button -->
<button 
    class="btn btn-danger" 
      data-event-id="<?php echo $booking->EventID; ?>"
    onclick="getEventIDForDelete(this)">
    Delete
</button>



</td>

                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="6">No bookings available.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Event:</strong> <span id="modalEvent"></span></p>
          <p><strong>Contact:</strong> <span id="modalContact"></span></p>
          <p><strong>Date:</strong> <span id="modalDate"></span></p>
          <p><strong>Time:</strong> <span id="modalTime"></span></p>
          <p><strong>Package:</strong> <span id="modalPackage"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
  function openModal(CategoryName, contact, date, time, packageName) {
    // Set the modal values
    document.getElementById("modalEvent").innerText = CategoryName;
    document.getElementById("modalContact").innerText = contact;
    document.getElementById("modalDate").innerText = date;
    document.getElementById("modalTime").innerText = time;
    document.getElementById("modalPackage").innerText = packageName;

    // Open the modal
    var myModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    myModal.show();
  }

  function editBooking(bookingID) {
    // Here, you can open a modal or navigate to an edit page
    // For now, let's just alert the booking ID
    alert("Edit booking with ID: " + bookingID);
    
    // Example: redirect to an edit page with booking ID in the URL
    // window.location.href = 'editBooking/' + bookingID;
  }
</script>

<script>
  document.querySelector('#searchbar input[type="search"]').addEventListener("keyup", function () {
    const searchValue = this.value.toLowerCase();
    const table = document.querySelector(".table tbody");
    const rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
      const cells = rows[i].getElementsByTagName("td");
      let match = false;

      for (let j = 0; j < cells.length; j++) {
        if (cells[j] && cells[j].innerText.toLowerCase().includes(searchValue)) {
          match = true;
          break;
        }
      }
      rows[i].style.display = match ? "" : "none";
    }
  });
</script>

<script>
  document.querySelectorAll('.toggleSwitch input').forEach(toggleSwitch => {
    const statusElement = toggleSwitch.closest('td').querySelector('#status');

    // Initialize the status text and color based on the initial checkbox state
    if (toggleSwitch.checked) {
      statusElement.textContent = 'Approved';
      statusElement.style.color = 'green';
    } else {
      statusElement.textContent = 'Pending';
      statusElement.style.color = 'orange';
    }

    // Update status dynamically when the toggle switch is changed
    toggleSwitch.addEventListener('change', function () {
      if (this.checked) {
        statusElement.textContent = 'Approved';
        statusElement.style.color = 'green';
      } else {
        statusElement.textContent = 'Pending';
        statusElement.style.color = 'orange';
      }
    });
  });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Select all Edit buttons
  const editButtons = document.querySelectorAll('.btn-edit-reservation');

  // Loop through each button and add event listener
  editButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Get the EventID from the data attribute
      const eventID = this.getAttribute('data-event-id');

      // Set the EventID value into the hidden input field inside the modal
      document.getElementById('EventID').value = EventID;
    });
  });
});
</script>

<script>
  document.querySelectorAll('.edit-event-btn').forEach(button => {
    button.addEventListener('click', function () {
        const eventID = this.getAttribute('data-event-id');

        // Fetch event details if necessary (or populate modal fields directly)
        fetch(`/getBookingDetails/${eventID}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('EventID').value = data.EventID;
                document.getElementById('CategoryID').value = data.CategoryID;
                document.getElementById('contactNumber').value = data.contactNumber;
                document.getElementById('date').value = data.date;
                document.getElementById('time').value = data.time;
                document.getElementById('packageID').value = data.packageID;
            })
            .catch(error => console.error('Error fetching booking details:', error));
    });
});
</script>

<script>
function getEventID(button) {
    const eventId = button.getAttribute("data-event-id");
    console.log("EventID:", $EventID);

    // Fetch booking details and populate the modal (if needed)
    fetch(getBookingDetail($EventID))
        .then((response) => {
            if (!response.ok) throw new Error(`HTTP Status ${response.status}`);
            return response.json();
        })
        .then((data) => {
            // Populate modal fields
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
        method:'DELETE',
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