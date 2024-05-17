  <script>
  import axios from 'axios';
  import { useAppOptionStore } from '@/stores/app-option';

  export default {
    data() {
      return {
        showModal: false,
        editedUser: {},
        users: [] // Array to store user data
      };
    },
    created() {
      this.fetchUsers();
    },
    updated(){
      this.fetchUsers();
    },
    methods: {
      async fetchUsers() {
        try {
          const token = localStorage.getItem('token');
          const response = await axios.get(`${this.$apiBaseUrl}/users`, {
            headers: {
              'Authorization': `Bearer ${token}` // Replace <token> with the actual authentication token
            }
          });
          this.users = response.data.allUsers;
        } catch (error) {
          console.error(error);
        }
      },
      // Method to format date
      formatDate(dateString) {
        if (!dateString) return 'N/A'; // Return 'N/A' if date is not available
        const date = new Date(dateString); // Create a Date object from the date string
        return date.toLocaleDateString(); // Return the formatted date without time
      },
      async openModal(user) {
        // Fetch user data for editing
        try {
          const token = localStorage.getItem('token');
          const response = await axios.post(`${this.$apiBaseUrl}/editUser/${user.id}`, null, {
            headers: {
              'Authorization': `Bearer ${token}` // Replace <token> with the actual authentication token
            }
          });
          this.editedUser = response.data.user;
          this.showModal = true;
        } catch (error) {
          console.error('Error fetching user data:', error);
        }
      },
      async updateUser() {
        try {
          const token = localStorage.getItem('token');
          const response = await axios.post(
            `${this.$apiBaseUrl}/updateUser/${this.editedUser.id}`,
            this.editedUser,
            {
              headers: {
                Authorization: `Bearer ${token}`
              }
            }
          );
          console.log('User updated:', response.data.user);
          this.showModal = false;
          // Optionally, update the user data in the users array to reflect changes immediately
        } catch (error) {
          console.error('Error updating user:', error);
        }
      },
      async deleteUser(user) {
        try {
          const confirmDelete = confirm(`Are you sure you want to delete ${user.name}?`);
          if (confirmDelete) {
            const token = localStorage.getItem('token');
            // alert(token);
            const response = await axios.post(`${this.$apiBaseUrl}/deleteUser/${user.id}`, null, {
              headers: {
                'Authorization': `Bearer ${token}` // Replace <token> with the actual authentication token
              }
            });
          }
          // this.editedUser = response.data.user;
        } catch (error) {
          console.error('Error fetching user data:', error);
        }
      },
      async viewUser(user) {
        // Implement view user functionality here
        try {
          // Make API call to fetch user details for viewing
          // Example:
          // const response = await axios.get(`http://127.0.0.1:8000/api/users/${user.id}`);
          console.log('Viewing user:', user);
        } catch (error) {
          console.error('Error viewing user:', error);
        }
      }
    }
  };
</script>

  <style scoped>
  .container {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
  }

  h1 {
    color: black;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
  }

  .table {
    width: 80%;
    margin: 0 auto;
    background: white;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
  }

  th,
  td {
    padding: 10px;
  }

  th {
    background: #f2f2f2;
    color: #333;
  }

  tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
  }

  /* Styles for the modal */
  .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
  }

  .modal.is-active {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    max-width: 500px;
  }
</style>

  <template>
    <div id="stripedRows" class="mb-5">
      <h4>Users Page</h4>
      <card>
        <card-body>
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">DOB</th>
                <th scope="col">Status</th>
                <th scope="col">Trial End Date</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in users" :key="index">
                <!-- Display user data in each table cell -->
                <td>{{ index + 1 }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.dob ? user.dob : 'N/A' }}</td>
                <td v-if="user.subscriptions.length > 0">
                  <!-- Display subscription details if user has a subscription -->
                  {{ user.subscriptions[0].stripe_status }}
                </td>
                <td v-else>
                  <!-- Display 'No subscription' if user does not have a subscription -->
                  No subscription
                </td>
                <td v-if="user.subscriptions.length > 0">
                  <!-- Display trial end date if available -->
                  {{ formatDate(user.subscriptions[0].trial_ends_at) ? formatDate(user.subscriptions[0].trial_ends_at) :
                    'N/A' }}
                </td>
                <td v-else>
                  <!-- If user doesn't have a subscription, display 'N/A' for trial end date -->
                  N/A
                </td>
                <td>{{ user.role.description }}</td>
                <td>
                  <div class="d-flex justify-content-between">
                    <button @click="openModal(user)" class="btn btn-link">
                      <i class="fas fa-lg fa-fw fa-edit"></i> <!-- Edit icon -->
                    </button>
                    <button @click="deleteUser(user)" class="btn btn-link">
                      <i class="fas fa-lg fa-fw fa-trash-alt"></i> <!-- Delete icon -->
                    </button>
                    <button @click="viewUser(user)" class="btn btn-link">
                      <i class="fas fa-lg fa-fw fa-eye"></i> <!-- View icon -->
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </card-body>
        <highlightjs :code="code3" />
      </card>
    </div>


    <!-- BEGIN #modalEdit -->
    <div class="modal" id="modalEdit" :class="{ 'is-active': showModal }">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" @click="showModal = false"></button>
          </div>
          <form @submit.prevent="updateUser">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Name</label>
                  <input v-model="editedUser.name" type="text" class="form-control" placeholder="Name">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Email</label>
                  <input v-model="editedUser.email" type="email" class="form-control" placeholder="Email">
                </div>
              </div>
              <!-- Add more fields as needed -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" @click="showModal = false">Close</button>
              <button type="submit" class="btn btn-theme">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END #modalEdit -->
  </template>
