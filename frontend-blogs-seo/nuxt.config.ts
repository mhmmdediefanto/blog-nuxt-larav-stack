import tailwindcss from "@tailwindcss/vite";
import typography from "@tailwindcss/typography";


// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: true,
  compatibilityDate: "2025-05-15",
  devtools: { enabled: true },
  modules: ["@nuxt/ui", "@nuxt/image", "nuxt-toast"],
  css: ["@/assets/css/main.css"],
  vite: {
    plugins: [
      tailwindcss(),
    ],
  },


  runtimeConfig: {
    public: {
      apiBaseUrl: process.env.API_BASE_URL,
      apiBaseUrlImage: process.env.NUXT_PUBLIC_API_BASE_URL_IMAGE,
      siteUrl: process.env.NUXT_PUBLIC_SITE_URL,
    },
  },
  plugins: ["~/plugins/axios"],
});
