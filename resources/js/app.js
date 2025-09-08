import './bootstrap';
import Alpine from 'alpinejs';
import { userStatusControl } from './user_status_control';

window.Alpine = Alpine;

// Register your Alpine component globally
Alpine.data('userStatusControl', userStatusControl);

// Start Alpine
Alpine.start();
