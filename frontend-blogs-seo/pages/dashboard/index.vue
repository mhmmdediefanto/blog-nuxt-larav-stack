<template>
  <div>
    halaman dashboard

    <div class="text-center">
      <h1 class="text-2xl font-bold">Welcome to the Dashboard</h1>
      <p class="mt-4">
        This is your admin dashboard where you can manage your application.
      </p>
    </div>
    <div class="mt-8">
      <p class="text-lg">User: {{ auth.user?.name }}</p>
      <p class="text-sm text-gray-600">Email: {{ auth.user?.email }}</p>
    </div>
  </div>

  <UButton class="mt-4" color="primary" @click="handleLogout"> logout </UButton>
</template>

<script setup>

definePageMeta({
  layout: "admin-layout",
  middleware: ["auth"],
});

const auth = useAuthStore();

const handleLogout = async () => {
  await auth.logout();

   // Redirect to the login page after logout
  useRouter().push("/");

};
</script>

<style lang="scss" scoped></style>
