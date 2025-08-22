<!-- Footer Section -->
<footer id="footer" class="bg-[#1E88E5] text-white py-12">
  <div class="container mx-auto px-6">
    <div class="flex flex-col md:flex-row md:justify-between gap-8">

      <!-- Contact Information -->
      <div class="md:w-1/3">
        <h5 class="text-lg font-semibold mb-4">Contact Us</h5>
        <p class="mb-2 flex items-center"><i class="fas fa-phone mr-2"></i> 0908 994 0255</p>
        <p class="mb-2 flex items-center"><i class="fas fa-envelope mr-2"></i> dipologvetdoctor@gmail.com</p>
        <p class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Highway Sta. Filomena, Dipolog City, Philippines</p>
      </div>

      <!-- Quick Links -->
      <div class="md:w-1/3">
        <h5 class="text-lg font-semibold mb-4">Quick Links</h5>
        <ul class="space-y-2">
          <li><a href="#services" class="hover:text-gray-200 transition-colors">Our Services</a></li>
          <li><a href="#clinic" class="hover:text-gray-200 transition-colors">Our Clinic</a></li>
          <li><a href="Contact" class="hover:text-gray-200 transition-colors">Contact</a></li>
          <li><a href="#about" class="hover:text-gray-200 transition-colors">About Us</a></li>
        </ul>
      </div>

      <!-- Social Media -->
      <div class="md:w-1/3">
        <h5 class="text-lg font-semibold mb-4">Follow Us</h5>
        <div class="flex space-x-4">
          <a href="#" class="hover:text-gray-200 transition-colors text-xl"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="hover:text-gray-200 transition-colors text-xl"><i class="fab fa-twitter"></i></a>
          <a href="#" class="hover:text-gray-200 transition-colors text-xl"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

    </div>

    <hr class="my-8 border-white/40">

    <div class="text-center text-white/90">
      <p>&copy; 2024 Dipolog Veterinary Doctor. All rights reserved.</p>
    </div>
  </div>
</footer>

<!-- Scroll Top Button -->
<a href="#" id="scroll-top" class="fixed bottom-6 right-6 w-12 h-12 flex items-center justify-center bg-white text-[#1E88E5] rounded-full shadow-lg hover:bg-gray-200 transition">
  <i class="bi bi-arrow-up-short text-2xl"></i>
</a>

<!-- Scripts -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
function editBooking(button) {
    var eventId = button.getAttribute('data-event-id');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', `/getBookingDetails/${eventId}`, true);

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
