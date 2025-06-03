<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
import AuthForm from "~/components/AuthForm.vue";
import { z } from "zod";

definePageMeta({ layout: "auth-layout" });

useSeoMeta({
  title: "Login | Nuxt 3",
});

const auth = useAuthStore();

// Validasi dan state login
const schema = z.object({
  email: z.string().email("Format Email Tidak Valid"),
  password: z.string().min(6, "Password Minimal 6 Karakter"),
});
const state = ref({ email: "", password: "" });

const toast = useToast();
const onSubmit = async (event) => {
  event.preventDefault();

  const res = await auth.login(event.data);

  if (!res) {
    console.log("Login gagal, munculkan toast");
    toast.add({
      title: "Login Gagal",
      description: auth.error || "Terjadi kesalahan",
      color: "red",
      duration: 3000,
      icon: "i-heroicons-x-circle",
    });

    state.value.email = "";
    state.value.password = "";
    return;
  }

  state.value.email = "";
  state.value.password = "";

  navigateTo("/dashboard");
};
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
            title="Login"
            :schema="schema"
            :state="state"
            :onSubmit="onSubmit"
            :showName="false"
            linkText="Register"
            linkTo="/auth/register"
            :loading="auth.loading"
          />
        </div>
      </div>
    </ContainerPage>
  </div>
</template>

<style lang="scss" scoped></style>
