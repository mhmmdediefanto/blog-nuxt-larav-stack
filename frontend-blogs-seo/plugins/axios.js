import axios from "axios";
import Cookies from "js-cookie";

export default defineNuxtPlugin(() => {
  const config = useRuntimeConfig();

  const instance = axios.create({
    baseURL: config.public.apiBaseUrl,
    withCredentials: true,
    headers: {
      Accept: "application/json",
    },
  });
  // Tambahkan interceptor untuk otomatis menyisipkan XSRF token
  instance.interceptors.request.use((config) => {
    const xsrfToken = Cookies.get("XSRF-TOKEN");
    if (xsrfToken) {
      config.headers["X-XSRF-TOKEN"] = xsrfToken;
    }
    return config;
  });

  return {
    provide: {
      axios: instance,
    },
  };
});
