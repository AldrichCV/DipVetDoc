<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

<div x-data="appointmentsComponent()" class="py-12 space-y-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="overflow-x-auto w-full mb-6">
                    <table class="w-full border border-gray-200 table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border text-left">Pet Name</th>
                                @if(auth()->user()->role === 'admin')
                                    <th class="px-4 py-2 border text-left">Owner</th>
                                @endif
                                <th class="px-4 py-2 border text-left">Schedule</th>
                                <th class="px-4 py-2 border text-left">Service</th>
                                <th class="px-4 py-2 border text-left">Status</th>
                                <th class="px-4 py-2 border text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $appointment->pet_name }}</td>
                                    @if(auth()->user()->role === 'admin')
                                        <td class="px-4 py-2 border">{{ $appointment->owner_name }}</td>
                                    @endif
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time)->format('F j, Y \a\t h:i A') }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $appointment->reason_name }}</td>
                                    <td class="px-4 py-2 border">{{ ucfirst($appointment->status) }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <button
                                            @click="editAppointment({{ json_encode($appointment) }})"
                                            class="text-blue-600 hover:underline">
                                            Edit
                                        </button>
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-2 text-center border">No appointments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div x-show="showModal" x-transition
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg" @click.away="showModal = false">
        <h2 class="text-lg font-semibold mb-4">Edit Appointment</h2>

        <form :action="`/appointments/${selectedAppointment.id}`" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 text-sm">Pet Name</label>
                <input type="text" name="pet_name" x-bind:value="selectedAppointment.pet_name"
                       class="w-full border px-3 py-2 rounded bg-gray-100 cursor-not-allowed" readonly>
            </div>

           
            <div 
            x-data="{
                appointmentDate: '',
                appointmentTime: '',
                minTime: '',
                maxTime: '',

                updateTimeRange() {
                    if (!this.appointmentDate) return;
                    const day = new Date(this.appointmentDate).getDay(); // 0=Sun, 6=Sat

                    if (day === 0) {
                        // Sunday: 9:00 AM - 4:30 PM (last slot 30 mins before 5:00 PM)
                        this.minTime = '09:00';
                        this.maxTime = '16:30';
                        this.appointmentTime = '09:00';
                    } else {
                        // Mon-Sat: 8:00 AM - 5:30 PM (last slot 30 mins before 6:00 PM)
                        this.minTime = '08:00';
                        this.maxTime = '17:30';
                        this.appointmentTime = '08:00';
                    }
                },

                validateTime(event) {
                    const time = event.target.value;

                    // Lunch break restriction
                    if (time >= '12:00' && time <= '12:59') {
                        this.appointmentTime = '13:00';
                        Swal.fire({
                            icon: 'warning',
                            title: 'Lunch Break',
                            text: 'Appointments cannot be scheduled between 12:00 PM and 12:59 PM.',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Before opening
                    if (time < this.minTime) {
                        this.appointmentTime = this.minTime;
                        Swal.fire({
                            icon: 'error',
                            title: 'Too Early',
                            text: `Opening time is ${this.formatTime(this.minTime)}.`,
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // After last slot
                    if (time > this.maxTime) {
                        this.appointmentTime = this.maxTime;
                        Swal.fire({
                            icon: 'error',
                            title: 'Too Late',
                            text: `Last available appointment is at ${this.formatTime(this.maxTime)}.`,
                            confirmButtonText: 'OK'
                        });
                        return;
                    }
                },

                formatTime(timeStr) {
                    let [hour, minute] = timeStr.split(':').map(Number);
                    const ampm = hour >= 12 ? 'PM' : 'AM';
                    hour = hour % 12 || 12;
                    return `${hour}:${minute.toString().padStart(2, '0')} ${ampm}`;
                }
            }" 
            x-init="minTime='08:00'; maxTime='17:30'; appointmentTime='08:00'">

                <!-- Appointment Date -->
                <div>
                    <label class="block text-sm font-medium mb-1">Appointment Date</label>
                    <input 
                        type="date" 
                        name="appointment_date" 
                        x-model="appointmentDate"
                        @change="updateTimeRange"
                        class="w-full border border-gray-300 rounded px-3 py-2" 
                        required
                        :min="new Date().toISOString().split('T')[0]"
                    >
                </div>

                <!-- Appointment Time -->
                <div>
                    <label class="block text-sm font-medium mb-1">Appointment Time</label>
                    <input 
                        type="time" 
                        name="appointment_time" 
                        x-model="appointmentTime"
                        :min="minTime"
                        :max="maxTime"
                        @input="validateTime($event)"
                        class="w-full border border-gray-300 rounded px-3 py-2" 
                        required
                    >
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm">Service</label>
                <select name="reason" x-model="selectedAppointment.reason"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Select --</option>
                    <option value="1">Check-up</option>
                    <option value="2">Deworming</option>
                    <option value="3">Home Service</option>
                    <option value="4">Laboratories</option>
                    <option value="5">Non-Surgical Procedures</option>
                    <option value="6">Surgical Procedures</option>
                    <option value="7">Therapies</option>
                    <option value="8">Tick & Flea Preventive</option>
                    <option value="9">Vaccinations</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Notes (Optional)</label>
                <textarea name="notes" rows="3" x-model="selectedAppointment.notes"
                          class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" @click="showModal = false"
                        class="px-4 py-2 border rounded text-gray-600">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function appointmentsComponent() {
        return {
            showModal: false,
            selectedAppointment: {},
            editAppointment(appointment) {
                this.selectedAppointment = appointment;
                this.showModal = true;
            }
        };
    }
</script>

@if(auth()->user()->role !== 'admin')
<div 
    x-data="{
        showNewAppointment: false,
        appointmentDate: '',
        appointmentTime: '',
        minTime: '',
        maxTime: '',
        updateTimeRange() {
            if (!this.appointmentDate) return;
            const date = new Date(this.appointmentDate);
            const day = date.getDay(); // 0 = Sunday, 1 = Monday, ... 6 = Saturday
            if (day === 0) { 
                this.minTime = '09:00';
                this.maxTime = '17:00';
            } else {
                this.minTime = '08:00';
                this.maxTime = '18:00';
            }
            if (this.appointmentTime && 
               (this.appointmentTime < this.minTime || this.appointmentTime > this.maxTime)) {
                this.appointmentTime = '';
            }
        },
        blockLunchHour(event) {
            if (this.appointmentTime >= '12:00' && this.appointmentTime <= '12:59') {
                alert('Appointments are not allowed from 12:00 PM to 12:59 PM.');
                this.appointmentTime = '';
                event.target.value = '';
            }
        }
    }" 
    class="max-w-7xl mx-auto sm:px-6 lg:px-12 pb-20"
>
    <!-- Toggle Button -->
    <div class="mb-4">
        <button 
            @click="showNewAppointment = !showNewAppointment"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <span x-show="!showNewAppointment">+ New Appointment</span>
            <span x-show="showNewAppointment">Hide Form</span>
        </button>
    </div>

    <!-- Form -->
    <div x-show="showNewAppointment" x-transition style="display: none;">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-lg font-semibold mb-4">New Appointment</h3>

                <form method="POST" action="{{ route('my_appointments.store') }}">
                    @csrf

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Pet Details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Pet Name</label>
                                <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
                            </div>
                          <div>
                            <label class="block text-sm font-medium mb-1">Species</label>
                            <select name="species" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">-- Select Species --</option>
                                <!-- Companion animals -->
                                <option value="Dog">Dog</option>
                                <option value="Cat">Cat</option>
                                <option value="Rabbit">Rabbit</option>
                                <option value="Guinea Pig">Guinea Pig</option>
                                <option value="Hamster">Hamster</option>
                                <option value="Ferret">Ferret</option>
                                <option value="Bird">Bird</option>
                                <option value="Reptile">Reptile</option>
                                <option value="Fish">Fish</option>
                                
                                <!-- Livestock / Large animals -->
                                <option value="Cattle">Cattle</option>
                                <option value="Horse">Horse</option>
                                <option value="Pig">Pig</option>
                                <option value="Goat">Goat</option>
                                <option value="Sheep">Sheep</option>
                                <option value="Chicken">Chicken</option>
                                <option value="Duck">Duck</option>
                                <option value="Turkey">Turkey</option>
                            </select>
                        </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Breed</label>
                                <input type="text" name="breed" class="w-full border border-gray-300 rounded px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Sex</label>
                                <select name="sex" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                    <option value="">-- Select --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Date of Birth</label>
                                <input 
                                    type="date" 
                                    name="date_of_birth" 
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    :max="new Date().toISOString().split('T')[0]"
                                >
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-t border-gray-300">

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Appointment Details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div 
    x-data="{
        appointmentDate: '',
        appointmentTime: '',
        minTime: '',
        maxTime: '',

        updateTimeRange() {
            if (!this.appointmentDate) return;
            const day = new Date(this.appointmentDate).getDay(); // 0=Sun, 6=Sat

            if (day === 0) {
                // Sunday: 9:00 AM - 4:30 PM (last slot 30 mins before 5:00 PM)
                this.minTime = '09:00';
                this.maxTime = '16:30';
                this.appointmentTime = '09:00';
            } else {
                // Mon-Sat: 8:00 AM - 5:30 PM (last slot 30 mins before 6:00 PM)
                this.minTime = '08:00';
                this.maxTime = '17:30';
                this.appointmentTime = '08:00';
            }
        },

        validateTime(event) {
            const time = event.target.value;

            // Lunch break restriction
            if (time >= '12:00' && time <= '12:59') {
                this.appointmentTime = '13:00';
                Swal.fire({
                    icon: 'warning',
                    title: 'Lunch Break',
                    text: 'Appointments cannot be scheduled between 12:00 PM and 12:59 PM.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Before opening
            if (time < this.minTime) {
                this.appointmentTime = this.minTime;
                Swal.fire({
                    icon: 'error',
                    title: 'Too Early',
                    text: `Opening time is ${this.formatTime(this.minTime)}.`,
                    confirmButtonText: 'OK'
                });
                return;
            }

            // After last slot
            if (time > this.maxTime) {
                this.appointmentTime = this.maxTime;
                Swal.fire({
                    icon: 'error',
                    title: 'Too Late',
                    text: `Last available appointment is at ${this.formatTime(this.maxTime)}.`,
                    confirmButtonText: 'OK'
                });
                return;
            }
        },

        formatTime(timeStr) {
            let [hour, minute] = timeStr.split(':').map(Number);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12 || 12;
            return `${hour}:${minute.toString().padStart(2, '0')} ${ampm}`;
        }
    }" 
    x-init="minTime='08:00'; maxTime='17:30'; appointmentTime='08:00'">

    <!-- Appointment Date -->
    <div>
        <label class="block text-sm font-medium mb-1">Appointment Date</label>
        <input 
            type="date" 
            name="appointment_date" 
            x-model="appointmentDate"
            @change="updateTimeRange"
            class="w-full border border-gray-300 rounded px-3 py-2" 
            required
            :min="new Date().toISOString().split('T')[0]"
        >
    </div>

    <!-- Appointment Time -->
    <div>
        <label class="block text-sm font-medium mb-1">Appointment Time</label>
        <input 
            type="time" 
            name="appointment_time" 
            x-model="appointmentTime"
            :min="minTime"
            :max="maxTime"
            @input="validateTime($event)"
            class="w-full border border-gray-300 rounded px-3 py-2" 
            required
        >
    </div>
</div>

                            
                            <div>
                                <label class="block text-sm font-medium mb-1">Service</label>
                                <select name="reason" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                    <option value="">-- Select --</option>
                                    <option value="1">Check-up</option>
                                    <option value="2">Deworming</option>
                                    <option value="3">Home Service</option>
                                    <option value="4">Laboratories</option>
                                    <option value="5">Non-Surgical Procedures</option>
                                    <option value="6">Surgical Procedures</option>
                                    <option value="7">Therapies</option>
                                    <option value="8">Tick & Flea Preventive</option>
                                    <option value="9">Vaccinations</option>
                                </select>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium mb-1">Notes (Optional)</label>
                                <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Add Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
</x-app-layout>
