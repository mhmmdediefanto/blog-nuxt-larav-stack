<script setup>
import Loader from "./Loader.vue";

defineProps({
  title: String,
  linkText: String,
  linkTo: String,
  schema: Object,
  state: Object,
  onSubmit: Function,
  showName: Boolean,
  loading: Boolean, // Tambahan ini
});

const emit = defineEmits(["submit"]);
const onSubmit = (event) => {
  emit("submit", event);
};
</script>

<template>
  <div
    class="w-full max-w-sm mx-auto shadow-md rounded-lg bg-slate-100 dark:text-white dark:bg-slate-800 p-6 lg:p-8"
  >
    <div class="space-y-4">
      <h1 class="text-xl font-bold text-center text-primary">{{ title }}</h1>

      <UForm
        :schema="schema"
        :state="state"
        class="space-y-4"
        @submit="onSubmit"
      >
        <UFormField v-if="showName" name="name" label="Full Name" size="lg">
          <UInput
            class="w-full"
            placeholder="Nama Lengkap"
            v-model="state.name"
          />
        </UFormField>

        <UFormField name="email" label="Email" required size="lg">
          <UInput
            class="w-full"
            placeholder="test@gmail.com"
            v-model="state.email"
          />
        </UFormField>

        <UFormField name="password" label="Password" required size="lg">
          <UInput
            class="w-full"
            type="password"
            placeholder="********"
            v-model="state.password"
          />
        </UFormField>

        <UButton type="submit" class="cursor-pointer" :disabled="loading">
          <template #default>
            <span v-if="!loading">Submit</span>
            <Loader v-else size="w-4 h-4" color="text-slate-800 " />
          </template>
        </UButton>
      </UForm>

      <div class="my-4 flex justify-center">
        <p class="text-sm text-slate-400">
          {{ showName ? "Sudah punya akun?" : "Belum punya akun?" }}
          <NuxtLink :to="linkTo" class="text-primary text-sm">{{
            linkText
          }}</NuxtLink>
        </p>
      </div>
    </div>

    <NuxtLink to="/" class="text-center text-[10px] text-primary hover:underline cursor-pointer"
      >Back to Home</NuxtLink
    >
  </div>
</template>
