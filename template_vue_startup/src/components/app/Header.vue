<script setup lang="ts">
import { slideToggle } from '@/composables/slideToggle.js';
import { useAppOptionStore } from '@/stores/app-option';
import { RouterLink, useRouter } from 'vue-router';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useToast } from 'vue-toastification';

const appOption = useAppOptionStore();
const toast = useToast();
const notificationData = [];
const isUserLoggedIn = ref(false); // Initialize as false by default
const userEmail = ref('');
const userName = ref('');

onMounted(async () => {
	await getUserData();
});
const getUserData = async () => {
	try {
		const token = localStorage.getItem('token');
		if (token) {
			// If token exists in localStorage, the user is logged in
			isUserLoggedIn.value = true;

			// Call the API to fetch user details only if the user is logged in
			const config = {
				headers: {
					Authorization: `Bearer ${token}`
				}
			};
			const response = await axios.post('http://127.0.0.1:8000/api/userDetails', {}, config);
			const userData = response.data;
			userName.value = userData.user.name; // Set the user's email to userEmail
		} else {
			// If token doesn't exist, the user is not logged in
			isUserLoggedIn.value = false;
		}
	} catch (error) {
		console.error(error);
	}
}
// Logout function
const logout = async () => {
	try {
		// Get the token from localStorage
		const token = localStorage.getItem('token');

		// Set the Authorization header with the token
		const config = {
			headers: {
				Authorization: `Bearer ${token}`
			}
		};

		// Make the logout request with the configured headers
		const response = await axios.get('http://127.0.0.1:8000/api/logout', config);

		if (response.status >= 200 && response.status < 300) {
			// Clear the authentication token from local storage
			localStorage.removeItem('token');
			localStorage.removeItem('role_id');
			localStorage.setItem('logoutMessage', 'success');
			window.location.href = '/page/login';
			// router.push('/page/login');
			toast.success('Logout successful!');
		} else {
			toast.error('Logout failed!');
			console.error('Logout failed:', response.statusText);
		}
	} catch (error) {
		toast.error('Logout failed!');
		console.error('Logout failed:', error);
	}
}

function toggleAppSidebarMinify() {
	if (!(appOption.appTopNav && appOption.appSidebarHide)) {
		appOption.appSidebarMinified = !appOption.appSidebarMinified;
	}
}
function toggleAppSidebarMobileToggled() {
	if (appOption.appTopNav && appOption.appSidebarHide) {
		slideToggle(document.querySelector('.app-top-nav'));
		window.scrollTo(0, 0);
	} else {
		appOption.appSidebarMobileToggled = !appOption.appSidebarMobileToggled;
	}
}
function toggleAppHeaderSearch(event) {
	event.preventDefault();

	appOption.appHeaderSearchToggled = !appOption.appHeaderSearchToggled;
}
function checkForm(event) {
	event.preventDefault();
	this.$router.push({ path: '/extra/search' })
}

</script>

<template>
	<div id="header" class="app-header">
		<!-- BEGIN mobile-toggler -->
		<div class="mobile-toggler">
			<button type="button" class="menu-toggler" v-on:click="toggleAppSidebarMobileToggled">
				<span class="bar"></span>
				<span class="bar"></span>
			</button>
		</div>
		<!-- END mobile-toggler -->

		<!-- BEGIN brand -->
		<div class="brand">
			<div class="desktop-toggler">
				<button type="button" class="menu-toggler" v-on:click="toggleAppSidebarMinify">
					<span class="bar"></span>
					<span class="bar"></span>
				</button>
			</div>

			<a href="#" class="brand-logo">
				<img src="/assets/img/logo.png" class="invert-dark" alt="" height="20" />
			</a>
		</div>
		<!-- END brand -->

		<!-- BEGIN menu -->
		<div class="menu">
			<form class="menu-search" name="header_search_form" v-on:submit="checkForm">
				<div class="menu-search-icon"><i class="fa fa-search"></i></div>
				<div class="menu-search-input">
					<input type="text" class="form-control" placeholder="Search menu...">
				</div>
			</form>
			<div class="menu-item dropdown">
				<a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
					<div class="menu-icon"><i class="fa fa-bell nav-icon"></i></div>
					<div class="menu-label">{{ notificationData.length }}</div>
				</a>
				<div class="dropdown-menu dropdown-menu-end dropdown-notification">
					<h6 class="dropdown-header text-body-emphasis mb-1">Notifications</h6>
					<template v-if="notificationData && notificationData.length > 0">
						<a href="#" class="dropdown-notification-item" v-for="(notification, index) in notificationData"
							v-bind:key="index">
							<div class="dropdown-notification-icon">
								<i v-if="notification.icon" v-bind:class="notification.icon"></i>
								<img v-if="notification.img" v-bind:src="notification.img" width="26">
							</div>
							<div class="dropdown-notification-info">
								<div class="title">{{ notification.title }}</div>
								<div class="time">{{ notification.time }}</div>
							</div>
							<div class="dropdown-notification-arrow">
								<i class="fa fa-chevron-right"></i>
							</div>
						</a>
					</template>
					<template v-else>
						<div class="dropdown-notification-item bg-white">
							No record found
						</div>
					</template>
					<div class="p-2 text-center mb-n1">
						<a href="#" class="text-body-emphasis text-opacity-50 text-decoration-none">See all</a>
					</div>
				</div>
			</div>
			<div class="menu-item dropdown">
				<a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
					<div class="menu-img online">
						<div
							class="d-flex align-items-center justify-content-center w-100 h-100 bg-gray-800 text-gray-300 rounded-circle overflow-hidden">
							<i class="fa fa-user fa-2x mb-n3"></i>
						</div>
					</div>
					<!-- <div class="menu-text">{{ userEmail }}</div> -->
					<div class="menu-text">{{ userName }}</div>
				</a>
				<div class="dropdown-menu dropdown-menu-end me-lg-3">
					<RouterLink to="/profile" class="dropdown-item d-flex align-items-center">Edit Profile <i
							class="fa fa-user-circle fa-fw ms-auto text-gray-400 fs-16px"></i></RouterLink>
					<RouterLink to="/email/inbox" class="dropdown-item d-flex align-items-center">Inbox <i
							class="fa fa-envelope fa-fw ms-auto text-gray-400 fs-16px"></i></RouterLink>
					<RouterLink to="/calendar" class="dropdown-item d-flex align-items-center">Calendar <i
							class="fa fa-calendar-alt fa-fw ms-auto text-gray-400 fs-16px"></i></RouterLink>
					<RouterLink to="/settings" class="dropdown-item d-flex align-items-center">Setting <i
							class="fa fa-wrench fa-fw ms-auto text-gray-400 fs-16px"></i></RouterLink>
					<div class="dropdown-divider"></div>
					<RouterLink @click="logout" to="/page/login" class="dropdown-item d-flex align-items-center">Log Out
						<i class="fa fa-toggle-off fa-fw ms-auto text-gray-400 fs-16px"></i>
					</RouterLink>
				</div>
			</div>
		</div>
		<!-- END menu -->
	</div>
</template>
