<script>
import { useAppOptionStore } from '@/stores/app-option';
import { Icon } from '@iconify/vue';
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
	components: {
		Icon: Icon
	},
	data() {
		return {
			formData: {}, // Initialize an empty object to store form data
		};
	},
	methods: {
		handleCheckout(planId) {
			const storedUserId = localStorage.getItem('user_id');
			console.log('stored user id after login:', storedUserId);
			// Construct the request body
			const requestBody = {
				userId: storedUserId,
			};
			axios.post(`${this.$apiBaseUrl}/checkout/${planId}`, requestBody)
				.then(response => {
					// Handle success
					if (response.data.status == 200) {
						const checkoutUrl = response.data.checkoutUrl;

						// Redirect to the checkout URL
						window.location.href = checkoutUrl;

					} else {
						console.error('Error processing payment:', response.data.message);
						alert('Error processing payment');
					}
				})
				.catch(error => {
					console.error('Error processing payment:', error);
					alert('Error processing payment');
				});
		},
	}
}
</script>
<style>
.row.gx-4.py-5 {
	margin: 30px;
}
</style>
<template>

	<!-- <h1 class="page-header mb-4">Pricing Page <small>header small text goes here...</small></h1> -->
	<h1 class="page-header mb-4">Pricing Page</h1>

	<div class="row gx-4 py-5" data-bs-theme="dark">
		<div class="col-xl-4 col-md-6 py-3 py-xl-5">
			<card class="border-0 rounded-4 h-100">
				<card-body class="fs-14px p-30px d-flex flex-column">
					<div class="d-flex align-items-center">
						<div class="flex-1">
							<div class="h5 font-monospace">Monthly Plan</div>
							<div class="display-6 fw-bold mb-0">$15 <small
									class="h5 text-body text-opacity-50">/month*</small></div>
						</div>
						<div>
							<Icon class="iconify display-4 text-gray-500 rounded-3"
								icon="solar:map-arrow-up-bold-duotone" />
						</div>
					</div>
					<hr class="my-4" />
					<div class="mb-5 text-body text-opacity-75 flex-1">
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Storage:</span> <b
									class="text-body">20 GB</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Bandwidth:</span> <b
									class="text-body">200 GB</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Domain Names:</span> <b
									class="text-body">2</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">SSL Certificate:</span> <b
									class="text-body"> Free</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Email Accounts:</span> <b
									class="text-body"> 10</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">24/7 Support:</span> <b
									class="text-body"> Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-times fa-lg text-body text-opacity-25"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Backup:</span> <b
									class="text-body"> Daily</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-times fa-lg text-body text-opacity-25"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Uptime Guarantee:</span> <b
									class="text-body"> 99.9%</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-times fa-lg text-body text-opacity-25"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">FTP Access:</span> <b
									class="text-body"> Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-times fa-lg text-body text-opacity-25"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Control Panel:</span> <b
									class="text-body"> cPanel</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-times fa-lg text-body text-opacity-25"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Free Domain:</span> <b
									class="text-body"> No</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-times fa-lg text-body text-opacity-25"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Firewall:</span> <b
									class="text-body"> No</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-times fa-lg text-body text-opacity-25"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">45-Day Money-Back
									Guarantee</span></div>
						</div>
					</div>
					<div class="mx-n2">
						<button class="btn btn-default btn-lg w-100 font-monospace"
							@click="handleCheckout('price_1PAx71Hlhw9UYvTNyZvqUdLs')">
							Get Started <i class="fa fa-arrow-right"></i>
						</button>
					</div>
				</card-body>
			</card>
		</div>
		<div class="col-xl-4 col-md-6 py-3 py-xl-0">
			<card class="border-0 rounded-4 shadow-lg bg-gradient-blue-indigo text-white h-100">
				<card-body class="fs-15px p-30px h-100 d-flex flex-column">
					<div class="d-flex align-items-center">
						<div class="flex-1">
							<div class="h5 font-monospace">Yearly Plan</div>
							<div class="display-6 fw-bold mb-0">$99 <small
									class="h5 text-body text-opacity-50">/year*</small></div>
						</div>
						<div>
							<Icon class="iconify display-3 text-black text-opacity-50 rounded-3"
								icon="solar:cup-first-bold-duotone" />
						</div>
					</div>
					<hr class="my-4" />
					<div class="mb-5 text-body flex-1">
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Storage:</span> <b
									class="text-white">50 GB</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Bandwidth:</span> <b
									class="text-white">500 GB</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Domain Names:</span> <b
									class="text-white">Unlimited</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">SSL Certificate:</span> <b
									class="text-white">Free</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Email Accounts:</span> <b
									class="text-white">Unlimited</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">24/7 Support:</span> <b
									class="text-white">Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Backup:</span> <b
									class="text-white">Daily</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Uptime Guarantee:</span> <b
									class="text-white">99.9%</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">FTP Access:</span> <b
									class="text-white">Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Control Panel:</span> <b
									class="text-white">cPanel</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Free Domain:</span> <b
									class="text-white">No</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Firewall:</span> <b
									class="text-white">Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">E-commerce Support</span></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-white text-opacity-50 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">45-Day Money-Back
									Guarantee</span></div>
						</div>
					</div>
					<button class="btn btn-default btn-lg w-100 font-monospace"
						@click="handleCheckout('price_1PAx71Hlhw9UYvTNAKFRmlBR')">
						Get Started <i class="fa fa-arrow-right"></i>
					</button>
				</card-body>
			</card>
		</div>
		<div class="col-xl-4 col-md-6 py-3 py-xl-5">
			<card class="border-0 rounded-4 h-100">
				<card-body class="fs-14px p-30px d-flex flex-column">
					<div class="d-flex align-items-center">
						<div class="flex-1">
							<div class="h5 font-monospace">Lifetime Plan</div>
							<div class="display-6 fw-bold mb-0">$174.99 <small
									class="h5 text-body text-opacity-50">Lifetime*</small></div>
						</div>
						<div>
							<Icon class="iconify display-4 text-gray-500 rounded-3"
								icon="solar:buildings-bold-duotone" />
						</div>
					</div>
					<hr class="my-4" />
					<div class="mb-5 text-body text-opacity-75 flex-1">
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Storage:</span> <b
									class="text-body">1 TB</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Bandwidth:</span> <b
									class="text-body">20 TB</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Domain Names:</span> <b
									class="text-body">Unlimited</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">SSL Certificate:</span> <b
									class="text-body">Free</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Email Accounts:</span> <b
									class="text-body">Unlimited</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check fa-lg text-gray-500"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">24/7 Support:</span> <b
									class="text-body">Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Backup:</span> <b
									class="text-body"> Daily</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Uptime Guarantee:</span> <b
									class="text-body">99.9%</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">FTP Access:</span> <b
									class="text-body">Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Control Panel:</span> <b
									class="text-body">cPanel</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Free Domain:</span> <b
									class="text-body">Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">Firewall:</span> <b
									class="text-body">Yes</b></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">E-commerce Support</span></div>
						</div>
						<div class="d-flex align-items-center mb-1">
							<i class="fa fa-check text-gray-500 fa-lg"></i>
							<div class="flex-1 ps-3"><span class="font-monospace small">45-Day Money-Back
									Guarantee</span></div>
						</div>
					</div>
					<div class="mx-n2">
						<button class="btn btn-default btn-lg w-100 font-monospace"
							@click="handleCheckout('price_1PAx71Hlhw9UYvTNtRHlsNSi')">
							Get Started <i class="fa fa-arrow-right"></i>
						</button>
					</div>

				</card-body>
			</card>
		</div>
	</div>
</template>