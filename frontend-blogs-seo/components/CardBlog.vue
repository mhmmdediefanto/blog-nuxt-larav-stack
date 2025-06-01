<script setup>
defineProps({
  blog: Object,
});
</script>
<template>
  <div class="w-full flex flex-col gap-3">
    <div class="relative cursor-pointer overflow-hidden rounded-lg">
      <NuxtImg
        src="carousel/carousel-3.jpg"
        class="w-full hover:scale-150 transition-all duration-300 ease-in-out"
      />
      <div class="absolute top-1 left-1">
        <p class="text-[10px] text-slate-900 px-2 py-1 bg-primary rounded-full">
          {{ blog.category.name }}
        </p>
      </div>
    </div>
    <div>
      <h1>{{ blog.title }}</h1>
      <p>Ini adalah subjudul atau deskripsi singkat.</p>

      <p class="text-sm dark:text-slate-400 italic text-slate-600">
        22 Januari 2025
      </p>

      <div class="mt-1 flex justify-between items-center">
        <p class="text-sm text-slate-600 dark:text-slate-500">
          Author:
          <span class="text-sm text-primary">Muhammad Ediefanto</span>
        </p>
      </div>
    </div>
  </div>
</template>
