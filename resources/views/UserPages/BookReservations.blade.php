<div class="modal fade" 
     id="reservationModal" 
     tabindex="-1" 
     aria-labelledby="reservationModalLabel" 
     aria-hidden="true" 
     data-bs-backdrop="static" 
     data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Book a Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action = "Reserve" method="post">
                    <div class="row mb-3">
                        <div class="col">
                        <select id="CategoryID" name="CategoryID" class="form-select">
                            <option selected disabled>Select Event</option>
                            <option value="1">Wedding</option>
                            <option value="2">Birthday</option>
                            <option value="3">Debut</option>
                            <option value="4">Burial</option>
                           </select>
                        </div>

                        
                        <div class="col">
                        <input type="tel" 
                                class="form-control" 
                                id="contactNumber" 
                                name="contactNumber"
                                placeholder="Contact Number" 
                                required 
                                maxlength="11" 
                                pattern="^\d{11}$" 
                                title="Please enter exactly 11 digits."
                                inputmode="numeric" 
                                onkeypress="if (event.key < '0' || event.key > '9') event.preventDefault();">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="date" class="form-label">Select Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="col">
                            <label for="time" class="form-label">Select Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </div>
                    <div class="mb-3">
                    <div class="col-6">
                        <label for="packageID" class="form-label">Choose Package:</label>
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
                        </div> </div> 
                        </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-primary">Submit Reservation</button>
            </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
