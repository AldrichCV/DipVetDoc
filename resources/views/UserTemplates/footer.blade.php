<footer id="footer" class="footer position-relative bg-dark text-white py-4">
   <div class="container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p><i class="fas fa-phone"></i> Phone: 0908 994 0255</p>
                <p><i class="fas fa-envelope"></i> Email: dipologvetdoctor@gmail.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Address: Highway Sta. Filomena, Dipolog City, Philippines</p>
            </div>
            <!-- Quick Links -->
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#services" class="text-white">Our Services</a></li>
                    <li><a href="#clinic" class="text-white">Our Clinic</a></li>
              
                    <li><a href="Contact" class="text-white">Contact</a></li>
                    <li><a href="#about" class="text-white">About Us</a></li>
                </ul>
            </div>
            <!-- Social Media -->
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; 2024 Dipolog Veterinary Doctor. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
function editBooking(button) {
    var eventId = button.getAttribute('data-event-id');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', `/getBookingDetails/${eventId}`, true); // Use lowercase 'eventId'

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);

                document.getElementById('EventID').value = data.EventID;
                document.getElementById('CategoryID').value = data.CategoryID;
                document.getElementById('contactNumber').value = data.contactNumber;
                document.getElementById('date').value = data.date;
                document.getElementById('time').value = data.time;
                document.getElementById('packageID').value = data.packageID;

                const editModal = new bootstrap.Modal(document.getElementById('editReservationModal'));
                editModal.show();
            } catch (e) {
                console.error('Error parsing response JSON:', e);
                alert('Failed to load booking details.');
            }
        } else {
            console.error('Failed to fetch booking details. HTTP Status:', xhr.status);
            alert('An error occurred while fetching booking details.');
        }
    };

    xhr.send();
}
</script>
