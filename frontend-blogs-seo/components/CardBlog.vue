<script setup>
defineProps({
  blog: Object,
});
</script>
<template>
  <div class="w-full flex flex-col gap-3">
    <div class="relative cursor-pointer overflow-hidden rounded-lg">
      <NuxtLink :to="`/blog/${blog.slug}`">
        <NuxtImg
          src="carousel/carousel-3.jpg"
          class="w-full hover:scale-150 transition-all duration-300 ease-in-out"
        />
      </NuxtLink>
      <div class="absolute top-1 left-1">
        <p class="text-[10px] text-slate-900 px-2 py-1 bg-primary rounded-full">
          {{ blog.category.name }}
        </p>
      </div>
    </div>
    <div>
      <NuxtLink :to="`/blog/${blog.slug}`">
        <h1
          class="text-lg dark:text-white font-semibold cursor-pointer hover:text-primary transition-all ease-in-out duration-300"
        >
          {{ blog.title }}
        </h1>
      </NuxtLink>
      <p class="text-sm text-slate-500 my-2">{{ blog.excerpt }}</p>

      <p class="text-[11px] dark:text-slate-400 italic text-slate-600">
        22 Januari 2025
      </p>

      <div class="flex justify-between items-center">
        <p class="text-slate-600 dark:text-slate-500 flex items-center gap-1 cursor-pointer">
          <UIcon name="mingcute:user-3-fill" class="text-primary w-4 h-4" />
          <NuxtLink>
            <span class="text-[11px] text-primary ">Muhammad Ediefanto</span>
          </NuxtLink>
        </p>
      </div>
    </div>
  </div>
</template>
