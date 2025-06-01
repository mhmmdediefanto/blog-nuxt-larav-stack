<script setup>
defineProps({
  sectionHeroBlog: Object,
});
</script>

<template>
  <div class="w-full flex gap-3 flex-wrap lg:flex-nowrap">
    <div class="w-full lg:w-[200px] overflow-hidden rounded-lg relative ">
      <NuxtLink :to="`/blog/${sectionHeroBlog.slug}`">
        <NuxtImg
          :src="useImageUrl(sectionHeroBlog.image)"
          class="w-full lg:w-[200px] hover:scale-125 object-contain transition-all duration-400 ease-in-out"
        />
      </NuxtLink>
      <div class="absolute top-1 right-1">
        <NuxtLink to="#">
          <p
            class="text-[10px] px-2 py-1 bg-primary text-slate-900 rounded-full"
          >
            {{ sectionHeroBlog.category.name }}
          </p>
        </NuxtLink>
      </div>
    </div>
    <div class="flex flex-col">
      <NuxtLink :to="`/blog/${sectionHeroBlog.slug}`">
        <h2
          class="font-bold hover:text-primary dark:text-white text-slate-800 transition-all ease-in-out duration-300"
        >
          {{ sectionHeroBlog.title }}
        </h2>
      </NuxtLink>
      <p class="text-sm text-slate-600 dark:text-gray-400">
        {{ sectionHeroBlog.excerpt }}
      </p>

      <p class="text-sm dark:text-slate-400 italic text-slate-600">
        {{ useFormatDate(sectionHeroBlog.created_at) }}
      </p>

      <div class="mt-1 flex justify-between items-center">
        <p
          class="text-sm text-slate-600 dark:text-slate-500 hover:text-green-500 cursor-pointer flex items-center gap-1"
        >
          <NuxtLink class="flex items-center gap-1">
            <UIcon name="mingcute:user-3-fill" class="text-primary w-4 h-4" />
            <p class="text-sm text-primary hover:text-green-500">
              {{ sectionHeroBlog.user.name }}
            </p>
          </NuxtLink>
        </p>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
