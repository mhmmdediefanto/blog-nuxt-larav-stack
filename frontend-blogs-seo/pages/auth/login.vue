<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
import AuthForm from "~/components/AuthForm.vue";

definePageMeta({ layout: "auth-layout" });

useSeoMeta({
  title: "Login | Nuxt 3",
});

// Validasi dan state login
const schema = ref(); // schema login
const state = ref({ email: "", password: "" });

function onSubmit(event) {
//  alert(event);
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
            title="Login"
            :schema="schema"
            :state="state"
            :onSubmit="onSubmit"
            :showName="false"
            linkText="Register"
            linkTo="/auth/register"
          />
        </div>
      </div>
    </ContainerPage>
  </div>
</template>

<style lang="scss" scoped></style>
