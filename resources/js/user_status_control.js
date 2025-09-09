export const userStatusControl = (initialUsers = []) => ({
    selectedUser: null,
    modalOpen: false,

    // Search/filter state
    searchTerm: '',
    selectedRole: '',
    selectedStatus: '',
    filteredUsers: initialUsers || [],

    // Methods
    filterUsers() {
        this.filteredUsers = initialUsers.filter(user => {
            const matchesSearch =
                user.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                user.email.toLowerCase().includes(this.searchTerm.toLowerCase());

            const matchesRole =
                this.selectedRole === '' || user.role === this.selectedRole;

            const matchesStatus =
                this.selectedStatus === '' || (user.status || 'N/A') === this.selectedStatus;

            return matchesSearch && matchesRole && matchesStatus;
        });
    },

    async deactivateUser(userId) {
    try {
        const response = await fetch(`/api/users/${userId}/deactivate`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: "inactive" })
        });

        const contentType = response.headers.get('content-type');
        let data;

        if (contentType && contentType.includes('application/json')) {
            data = await response.json();
        } else {
            const text = await response.text(); // fallback for HTML errors
            throw new Error(`Unexpected response from server (HTTP ${response.status}):\n${text}`);
        }

        if (!response.ok) {
            // If server returns JSON error message
            const msg = data.message || JSON.stringify(data);
            throw new Error(`Server returned error (HTTP ${response.status}):\n${msg}`);
        }

        // Close modal
        this.$dispatch('close-modal', 'user-status-modal');

        // Update local UI
        const userIndex = this.filteredUsers.findIndex(u => u.id === userId);
        if (userIndex !== -1) this.filteredUsers[userIndex].status = 'inactive';
        if (this.selectedUser && this.selectedUser.id === userId) this.selectedUser.status = 'inactive';

        Swal.fire({
            title: 'User Deactivated!',
            text: 'The user has been successfully deactivated.',
            icon: 'success',
            confirmButtonColor: '#3085d6'
        });

    } catch (error) {
        console.error("Deactivation error:", error);
        Swal.fire({
            title: 'Deactivation Failed!',
            html: `<strong>Error Details:</strong><br>
                   <pre style="text-align:left; white-space: pre-wrap;">${error.message}</pre>`,
            icon: 'error',
            confirmButtonColor: '#d33'
        });
        
        this.$dispatch('close-modal', 'user-status-modal');
    }
},

    async activateUser(userId) {
         try {
        const response = await fetch(`/api/users/${userId}/activate`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: "active" })
        });

        const contentType = response.headers.get('content-type');
        let data;

        if (contentType && contentType.includes('application/json')) {
            data = await response.json();
        } else {
            const text = await response.text(); // fallback for HTML errors
            throw new Error(`Unexpected response from server (HTTP ${response.status}):\n${text}`);
        }

        if (!response.ok) {
            // If server returns JSON error message
            const msg = data.message || JSON.stringify(data);
            throw new Error(`Server returned error (HTTP ${response.status}):\n${msg}`);
        }

        // Close modal
        this.$dispatch('close-modal', 'user-status-modal');

        // Update local UI
        const userIndex = this.filteredUsers.findIndex(u => u.id === userId);
        if (userIndex !== -1) this.filteredUsers[userIndex].status = 'active';
        if (this.selectedUser && this.selectedUser.id === userId) this.selectedUser.status = 'active';

        Swal.fire({
            title: 'User Activated!',
            text: 'The user has been successfully activated.',
            icon: 'success',
            confirmButtonColor: '#3085d6'
        });

    } catch (error) {
        console.error("Reactivation error:", error);
        Swal.fire({
            title: 'Reactivation Failed!',
            html: `<strong>Error Details:</strong><br>
                   <pre style="text-align:left; white-space: pre-wrap;">${error.message}</pre>`,
            icon: 'error',
            confirmButtonColor: '#d33'
        });
        
        this.$dispatch('close-modal', 'user-status-modal');
    }
    }
});
