<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
import AuthForm from "~/components/AuthForm.vue";
import { z } from "zod";

definePageMeta({ layout: "auth-layout" });
useSeoMeta({
  title: "Register | Nuxt 3",
});

const { register, loading, error } = useAuth();

// Validasi dan state register
const schema = z.object({
  name: z.string().min(1, "Nama Wajib Di isi"),
  email: z.string().email("Format Email Tidak Valid"),
  password: z.string().min(6, "Password Minimal 6 Karakter"),
}); // schema register
const state = reactive({ name: "", email: "", password: "" });
const toast = useToast(); // toast notification

async function onSubmit(event) {
  event.preventDefault();

  await register(event.data);

  state.name = "";
  state.email = "";
  state.password = "";

  toast.success({
    title: "Success!",
    message: "Your action was completed successfully.",
  });
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
          />
        </div>
      </div>
    </ContainerPage>
  </div>
</template>
