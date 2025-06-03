<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
import AuthForm from "~/components/AuthForm.vue";
import { z } from "zod";

definePageMeta({ layout: "auth-layout" });
useSeoMeta({
  title: "Register | Nuxt 3",
});
const auth = useAuthStore();

// Validasi dan state register
const schema = z.object({
  name: z.string().min(1, "Nama Wajib Di isi"),
  email: z.string().email("Format Email Tidak Valid"),
  password: z.string().min(6, "Password Minimal 6 Karakter"),
}); // schema register
const state = reactive({ name: "", email: "", password: "" });

const toast = useToast();

async function onSubmit(event) {
  event.preventDefault();

  try {
    const res = await auth.register(event.data);

    if (!res) {
      toast.add({
        title: "Register Gagal",
        description: auth.error || "Terjadi kesalahan",
        color: "red",
        duration: 3000,
        icon: "i-heroicons-x-circle",
      });
      return;
    }

    // Jika sukses
    toast.add({
      title: "Sukses",
      description: "Registrasi berhasil",
      color: "green",
      duration: 3000,
      icon: "i-heroicons-check-circle",
    });
  } catch (err) {

    toast.add({
      title: "Terjadi kesalahan",
      description:
        err?.response?.data?.message || err.message || "Unknown error",
      color: "red",
      duration: 3000,
    });
  } finally {
    state.name = "";
    state.email = "";
    state.password = "";
  }
}
</script>

<template>
  <div class="w-full min-h-screen mx-auto">
    <ContainerPage>
      <div class="w-full grid grid-cols-1 lg:grid-cols-2">
        <div
          class="w-full flex items-center justify-center min-h-screen hidden lg:block"
        >
          <NuxtImg src="/images/auth/login.svg" />
        </div>
        <div class="w-full flex items-center justify-center min-h-screen">
          <AuthForm
            title="Register"
            :schema="schema"
            :state="state"
            :onSubmit="onSubmit"
            showName
            linkText="Login"
            linkTo="/auth/login"
            :loading="auth.loading"
          />
        </div>
      </div>
    </ContainerPage>
  </div>
</template>
