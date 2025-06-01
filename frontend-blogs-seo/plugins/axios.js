import axios from "axios";

export default defineNuxtPlugin (() => {
  const config = useRuntimeConfig();

  const instance = axios.create({
    baseURL: config.public.apiBaseUrl,
    withCredentials: true,
    headers: {
      Accept: "application/json",
    },
  });

  return {
    provide: {
      axios: instance,
    },
  };
});
