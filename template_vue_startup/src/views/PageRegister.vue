<script>
import { useAppOptionStore } from '@/stores/app-option';
import { useRouter, RouterLink } from 'vue-router';
import axios from 'axios';

const appOption = useAppOptionStore();

export default {
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
	data() {
		return {
			form: {
				name: '',
				email: '',
				password: '',
				confirm_password: '',
				country: '',
				gender: '',
				dob: {
					month: '',
					day: '',
					year: ''
				}
			},
			months: [
				'Month',
				'January', 'February', 'March', 'April', 'May', 'June',
				'July', 'August', 'September', 'October', 'November', 'December'
			],
			days: Array.from({ length: 31 }, (_, index) => index + 1),
			years: Array.from({ length: 100 }, (_, index) => new Date().getFullYear() - index),
			selectedMonth: '',
			selectedDay: '',
			selectedYear: '',
			errors: {
				name: '',
				email: '',
				// ...
			},
			terms_and_conditions: '',
			countries: '',
			genders: ''
		}
	},
	watch: {
		selectedMonth() {
			this.updateDays();
		}
	},
	methods: {
		submitForm: function () {
			console.log('submitForm called');
			this.errors = {};
			if (!this.validateForm()) {
				return;
			}
			// Format date of birth
			const dob = `${this.selectedYear}-${this.padZero(this.months.indexOf(this.selectedMonth) + 1)}-${this.padZero(this.selectedDay)}`;

			// Update the form object with formatted date of birth
			this.form.dob = dob;

			// localStorage.setItem('formData', JSON.stringify(this.form));

			axios.post(`${this.$apiBaseUrl}/signup`, this.form)
				.then(response => {
					// console.log("Need user data:", response.data);
					var user_id = response.data.data.id;
                    localStorage.setItem('user_id', user_id);
					// Redirect to pricing plans page
					this.$router.push('/page/pricing');
					// this.$router.push('/page/login');
				})
				.catch(error => {
					console.error(error);
				});
		},
		padZero: function (value) {
			return String(value).padStart(2, '0');
		},
		validateForm: function () {
			console.log('validateForm called');
			let form = this.form;
			let errors = this.errors;

			if (!form.name) {
				errors.name = "Name field is required";
			} else if (form.name.length < 2) {
				errors.name = "Name must be at least 2 characters long";
			} else if (form.name.length > 50) {
				errors.name = "Name must be at most 50 characters long";
			}

			if (!form.email) {
				errors.email = "Email field is required";
			} else if (!this.validateEmail(form.email)) {
				errors.email = "Invalid email address";
			}

			if (!form.password) {
				errors.password = "Password field is required";
			} else if (form.password.length < 8) {
				errors.password = "Password must be at least 8 characters long";
			} else if (!/[A-Z]/.test(form.password)) {
				errors.password = "Password must contain at least one uppercase letter";
			} else if (!/[a-z]/.test(form.password)) {
				errors.password = "Password must contain at least one lowercase letter";
			} else if (!/[0-9]/.test(form.password)) {
				errors.password = "Password must contain at least one number";
			}

			if (!form.confirm_password) {
				errors.confirm_password = "Confirm password field is required";
			} else if (form.confirm_password !== form.password) {
				errors.confirm_password = "Passwords do not match";
			}

			if (!form.country) {
				errors.country = "Country field is required";
			}

			if (!form.gender) {
				errors.gender = "Gender field is required";
			}

			if (!form.dob) {
				errors.dob = "Date of birth field is required";
			}
			// else if (!this.validateDate(form.dob)) {
			// 	errors.dob = "Invalid date of birth";
			// }

			return Object.keys(errors).length === 0;
		},
		validateEmail: function (email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		},
		updateDays() {
			const monthIndex = this.months.indexOf(this.selectedMonth);
			const daysInMonth = new Date(this.selectedYear, monthIndex, 0).getDate();
			this.days = Array.from({ length: daysInMonth }, (_, index) => index + 1);
			if (this.selectedDay > daysInMonth) {
				this.selectedDay = '';
			}
		}
	}
}
</script>

<template>
	<!-- BEGIN register -->
	<div class="register">
		<!-- BEGIN register-content -->
		<div class="register-content">
			<form v-on:submit.prevent="submitForm()" method="POST" name="register_form">
				<h1 class="text-center">Sign Up</h1>
				<p class="text-muted text-center">One Admin ID is all you need to access all the Admin services.</p>
				<div class="mb-3">
					<label class="form-label">Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control form-control-lg fs-15px" placeholder="e.g John Smith"
						value="" v-model="form.name" />
					<div v-show="errors.name" class="text-danger">{{ errors.name }}</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Email Address <span class="text-danger">*</span></label>
					<input type="email" class="form-control form-control-lg fs-15px" placeholder="username@address.com"
						value="" v-model="form.email" />
					<div v-show="errors.email" class="text-danger">{{ errors.email }}</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Password <span class="text-danger">*</span></label>
					<input type="password" class="form-control form-control-lg fs-15px" value=""
						v-model="form.password" />
					<div v-show="errors.password" class="text-danger">{{ errors.password }}</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Confirm Password <span class="text-danger">*</span></label>
					<input type="password" class="form-control form-control-lg fs-15px" value=""
						v-model="form.confirm_password" />
					<div v-show="errors.confirm_password" class="text-danger">{{ errors.confirm_password }}</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Country <span class="text-danger">*</span></label>
					<select class="form-control form-control-lg fs-15px" v-model="form.country">
						<option>United States</option>
					</select>
					<div v-show="errors.country" class="text-danger">{{ errors.country }}</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Gender <span class="text-danger">*</span></label>
					<select class="form-control form-control-lg fs-15px" v-model="form.gender">
						<option value="">-- Select an option --</option>
						<option value="1">Male</option>
						<option value="0">Female</option>
					</select>
					<div v-show="errors.gender" class="text-danger">{{ errors.gender }}</div>
				</div>
				<div class="mb-3">
					<label class="form-label">Date of Birth <span class="text-danger">*</span></label>
					<div class="row">
						<div class="col-6">
							<select class="form-select form-select-lg fs-15px" v-model="selectedMonth">
								<option v-for="(month, index) in months" :key="index">{{ month }}</option>
							</select>
						</div>
						<div class="col-3">
							<select class="form-select form-select-lg fs-15px" v-model="selectedDay">
								<option v-for="day in days" :key="day">{{ day }}</option>
							</select>
						</div>
						<div class="col-3">
							<select class="form-select form-select-lg fs-15px" v-model="selectedYear">
								<option v-for="year in years" :key="year">{{ year }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="mb-3">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="customCheck1"
							v-model="terms_and_conditions" />
						<label class="form-check-label fw-500" for="customCheck1">I have read and agree to the <a
								href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</label>
					</div>
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-theme btn-lg fs-15px fw-500 d-block w-100">Sign Up</button>
				</div>
				<div class="text-muted text-center">
					Already have an Admin ID? <a href="/page/login">Sign In</a>
				</div>
			</form>
		</div>
		<!-- END register-content -->
	</div>
	<!-- END register -->
</template>
