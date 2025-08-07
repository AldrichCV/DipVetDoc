<body>
<div class="container">
    <div class="form-container">
        <h2>Pet Client Information</h2>
        <form action="SubmitPetClientInfo" method="POST" id="petClientInfoForm">

            

            <!-- Pet Information Section -->
            <div class="form-section">
                <h3>Pet Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="petName">Pet Name</label>
                        <input type="text" id="petName" name="petName" class="form-control" placeholder="Enter pet's name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="petType">Pet Type</label>
                        <select id="petType" name="petType" class="form-control" required>
                            <option value="" disabled selected>Select pet type</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="bird">Bird</option>
                            <option value="rabbit">Rabbit</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="breed">Breed</label>
                        <input type="text" id="breed" name="breed" class="form-control" placeholder="Enter pet's breed">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" class="form-control" min="0" step="1" placeholder="Enter pet's age" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="weight">Weight (kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" min="0" step="0.1" placeholder="Enter weight" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color">Color/Markings</label>
                        <input type="text" id="color" name="color" class="form-control" placeholder="Enter color/markings">
                    </div>
                </div>
                <div class="form-group">
                    <label>Any Special Needs or Medical Conditions?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="specialNeedsYes" name="specialNeeds" value="yes" required>
                        <label class="form-check-label" for="specialNeedsYes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="specialNeedsNo" name="specialNeeds" value="no" required>
                        <label class="form-check-label" for="specialNeedsNo">No</label>
                    </div>
                    <textarea id="specialNeedsDetails" name="specialNeedsDetails" class="form-control mt-2" rows="3" placeholder="If YES, please specify"></textarea>
                </div>
            </div>

            <!-- Requested Services Section -->
            <div class="form-section">
                <h3>Requested Services</h3>
                <div class="form-group">
                    <label for="serviceType">Select Service Type</label>
                    <select id="serviceType" name="serviceType" class="form-control" required>
                        <option value="" disabled selected>Select a service</option>
                        <option value="grooming">Grooming</option>
                        <option value="miniHotel">Mini Hotel for Pets</option>
                        <option value="vaccination">Vaccination and Deworming</option>
                        <option value="consultation">Consultation</option>
                        <option value="homeService">Home Service</option>
                        <option value="diagnostic">Diagnostic Laboratory</option>
                        <option value="surgery">Major & Minor Surgery</option>
                        <option value="dentalCleaning">Dental Cleaning</option>
                        <option value="hospitalization">Hospitalization</option>
                        <option value="laserTherapy">Laser Therapy</option>
                    </select>
                </div>
            </div>

            <!-- Emergency Contact Section -->
            <div class="form-section">
                <h3>Emergency Contact Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="emergencyName">Emergency Contact Name</label>
                        <input type="text" id="emergencyName" name="emergencyName" class="form-control" placeholder="Enter emergency contact name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="emergencyPhone">Emergency Contact Phone Number</label>
                        <input type="tel" id="emergencyPhone" name="emergencyPhone" class="form-control" placeholder="Enter emergency phone number" required pattern="[0-9]{10,15}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="relationship">Relationship to Pet Owner</label>
                    <input type="text" id="relationship" name="relationship" class="form-control" placeholder="Enter relationship to pet owner" required>
                </div>
            </div>

            <!-- Additional Notes Section -->
            <div class="form-group">
                <label for="additionalNotes">Additional Notes</label>
                <textarea id="additionalNotes" name="additionalNotes" class="form-control" rows="4" placeholder="Enter any additional notes"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">Submit Information</button>
        </form>
    </div>
</div>

<style>
        body {
            background-color: #f9f9f9;
        }
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 800px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0056b3;
        }
        .btn-primary {
            background-color: #3ABEF9;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section h3 {
            margin-bottom: 15px;
            color: #3ABEF9;
        }
    </style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
