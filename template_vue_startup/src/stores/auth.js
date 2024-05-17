import { defineStore } from "pinia";

export const useAuthStore = defineStore({
  id: "auth",
  state: () => ({
    isAuthenticated: false,
    user: null
  }),
  actions: {
    login(token, roleId, userId) {
      this.isAuthenticated = true;
      this.user = { token, roleId, userId };
      console.log('store',this.user);
    },
    logout() {
      this.isAuthenticated = false;
      this.user = null;
    }
  }
});
