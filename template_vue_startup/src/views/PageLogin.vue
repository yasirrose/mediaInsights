<script>
import axios from 'axios';
import { useAppOptionStore } from '@/stores/app-option';
import { useRouter } from 'vue-router'; // Removed unnecessary import
import { useToast } from 'vue-toastification';
import { useAppSidebarMenuStore } from '@/stores/app-sidebar-menu';
import { useAuthStore } from "@/stores/auth";
const appOption = useAppOptionStore();
const sidebar = useAppSidebarMenuStore();
const toast = useToast();
const router = useRouter();
const authStore = useAuthStore();
// Check if logout success message has been stored in localStorage
const logoutMessage = localStorage.getItem('logoutMessage');
console.log("asdf"+ sidebar.useAppSidebarMenuStore);

if (logoutMessage === 'success') {
    // Show toast message here
    toast.success('Logout successful!');
    // Clear the logout message from localStorage
    localStorage.removeItem('logoutMessage');
}
export default {
    setup() {
    const { menuItems } = useAppSidebarMenuStore();

    return {
      menuItems,
    };
  },
    mounted() {
        appOption.appSidebarHide = true;
        appOption.appHeaderHide = true;
        appOption.appContentClass = 'p-0';
    },
    beforeUnmount() {
        appOption.appSidebarHide = false;
        appOption.appHeaderHide = false;
        appOption.appContentClass = '';
    },
    methods: {
        submitForm: function () {
            this.errors = {};
            if (!this.validateForm()) {
                return;
            }
            // Get form data
            const formData = new FormData();
            formData.append('email', this.email);
            formData.append('password', this.password);
            // localStorage.setItem('formData', JSON.stringify(this.form));
            // Make POST request to login API endpoint
            axios.post(`${this.$apiBaseUrl}/login`, formData)
                .then(response => {
                    console.log(response);
                    const token = response.data.token;
                    localStorage.setItem('token', token);
                    localStorage.setItem('role_id', response.data.authUser.role_id);
                    toast.success('Login successful!'); // Use toast from vue-toastification
                    console.log(token,  response.data.authUser.role_id, response.data.authUser.id);
                    authStore.login(token,  response.data.authUser.role_id, response.data.authUser.id);
                    this.$router.push('/');
                })
                .catch(error => {
                    // alert('erorr here', error);
                    if (error.response && error.response.status === 500) {
                        toast.error('Invalid credentials. Please check your email and password.');
                    } else if(error.response && error.response.status === 403) {
                        // console.log('the data i need is:', error.response);
                        const redirectURL = error.response.data.redirect;
                        const errorMessage = error.response.data.message;
                        const userData = error.response.data.user;
                        // console.log('User who wants to login:',userData.id);
                        localStorage.setItem('user_id' , userData.id)
                        toast.info(errorMessage);
                        this.$router.push(redirectURL);

                    } else {
                        toast.error('Login failed. Please try again later.');
                    }
                });
        },
        validateForm: function () {
            console.log('validateForm called');
            let form = { email: this.email, password: this.password }; // Using component data directly
            let errors = this.errors;

            if (!form.email) {
                errors.email = "Email field is required";
            } else if (!this.validateEmail(form.email)) {
                errors.email = "Invalid email address";
            }

            if (!form.password) {
                errors.password = "Password field is required";
            }

            return Object.keys(errors).length === 0; // Return true if there are no errors
        },
        validateEmail: function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
    },
    data() {
        return {
            email: '',
            password: '',
            errors: {}
        };
    }
}
</script>

<template>
    <!-- BEGIN login -->
    <div class="login">
        <!-- BEGIN login-content -->
        <div class="login-content">
            <form v-on:submit.prevent="submitForm()" method="POST" name="login_form">
                <h1 class="text-center">Sign In</h1>
                <div class="text-muted text-center mb-4">
                    For your protection, please verify your identity.
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control form-control-lg fs-15px" value=""
                        placeholder="username@address.com" v-model="email" />
                    <div class="text-danger">{{ errors.email }}</div>
                </div>
                <div class="mb-3">
                    <div class="d-flex">
                        <label class="form-label">Password</label>
                        <a href="#" class="ms-auto text-muted">Forgot password?</a>
                    </div>
                    <input type="password" class="form-control form-control-lg fs-15px" value=""
                        placeholder="Enter your password" v-model="password" />
                    <div class="text-danger">{{ errors.password }}</div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="customCheck1" />
                        <label class="form-check-label fw-500" for="customCheck1">Remember me</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-theme btn-lg d-block w-100 fw-500 mb-3">Sign In</button>
                <div class="text-center text-muted">
                    Don't have an account yet? <RouterLink to="/page/register">Sign up</RouterLink>.
                </div>
            </form>
        </div>
        <!-- END login-content -->
    </div>
    <!-- END login -->
</template>