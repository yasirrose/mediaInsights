<script>
	import { useAppSidebarMenuStore } from '@/stores/app-sidebar-menu';
export default {
setup() {
    const { menuItems } = useAppSidebarMenuStore();

    return {
      menuItems,
    };
  },
}
</script>
<template>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">BREADCRUMB</a></li>
		<li class="breadcrumb-item active">HOME PAGE</li>
	</ul>
	<h1 class="page-header">
		Starter Page <small>page header description goes here...</small>
	</h1>
	<p>
		Start build your page here
	</p>
</template>