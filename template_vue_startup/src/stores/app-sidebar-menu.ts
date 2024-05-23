import { defineStore } from "pinia";
// import { useAuthStore } from "@/stores/auth.js";
export const useAppSidebarMenuStore = defineStore({
  id: "appSidebarMenu",
  state: () => {
    const isAdmin = localStorage.getItem('role_id') === '1'; // Check if user is admin
    // const authStore = useAuthStore(); 
    // const isAdmin = authStore.user ? authStore.user.roleId : null;
    // console.log(authStore.user);
    // console.log(isAdmin);
    // Define menu items
    const menuItems = [
      {
        text: 'Navigation',
        is_header: true
      },
      {
        url: '/',
        icon: 'fa fa-home',
        text: 'Home'
      },
      {
        url: '/page/podcasts-search',
        icon: 'fa fa-podcast',
        text: 'Podcast Search'
      },
      {
        url: '/page/my-podcast',
        icon: 'fa fa-podcast',
        text: 'My Podcast'
      },
      {
        url: '/page/podcast-episodes',
        icon: 'fa fa-play-circle',
        text: 'Episodes'
      }
    ];

    // Include "Users Page" menu item only if user is admin
    if (isAdmin) {
      menuItems.push({
        url: '/page/users',
        icon: 'fa fa-person',
        text: 'Users Page'
      });
    }

    return menuItems;
  }
});
