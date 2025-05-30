<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
useSeoMeta({
  title: "Blog",
});
</script>
<template>
  <div class="min-h-[calc(100vh-90px)] w-full">
    <ContainerPage>
      <div class="grid grid-cols-1 lg:grid-cols-3 mt-14 gap-5">
        <div class="col-span-2 flex flex-col">
          <div
            class="w-full h-[400px] relative overflow-hidden bg-white rounded-lg"
          >
            <!-- Gambar -->
            <NuxtImg
              src="carousel/carousel-1.jpg"
              class="object-cover w-full h-full"
            />

            <!-- Overlay Text -->
            <div
              class="absolute inset-0 bg-black/40 flex flex-col justify-end p-6 text-white"
            >
              <span class="text-sm font-semibold uppercase text-yellow-300"
                >Kategori</span
              >
              <h2 class="text-2xl font-bold">Judul Gambar</h2>
              <p class="text-sm text-gray-200">
                Ini adalah subjudul atau deskripsi singkat.
              </p>
            </div>
          </div>
        </div>

        <div>
          <h2>halaman blog</h2>
        </div>
      </div>
    </ContainerPage>
  </div>
</template>

<style lang="scss" scoped></style>
