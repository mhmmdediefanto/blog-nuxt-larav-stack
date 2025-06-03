import * as AuthService from "~/service/auth.service";

export default defineNuxtRouteMiddleware( async (to, from) => {
  const auth = useAuthStore();

  if (!auth.user) {
    try {
      const user = await AuthService.getUser();

      // console.log("Auth Middleware: User data fetched", user);

      if (user) {
        auth.user = { ...user }; // clone agar reactive
      } else {
       return navigateTo("/auth/login");
      }
    } catch (error) {
     return navigateTo("/auth/login");
    }
  }
});
