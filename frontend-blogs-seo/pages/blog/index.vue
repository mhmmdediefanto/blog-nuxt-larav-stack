<script setup>
import CardBlog from "~/components/CardBlog.vue";
import ContainerPage from "~/components/ContainerPage.vue";
import SectionHero from "~/components/SectionHero.vue";
import { getBlogs } from "~/service/blog.service";
useSeoMeta({
  title: "Blog",
});

const { data, pending, error } = await useAsyncData("blog", () => getBlogs());

// console.log(data.value.blog.data.length, "data");

const heroBlog = computed(() => data.value?.blog?.data[0] ?? null);

// console.log(heroBlog.value, "heroBlog");

const sectionHeroBlog = computed(() => {
  return data.value?.blog?.data.slice(1, 4) ?? null;
});

const blogs = computed(() => {
  return data.value?.blog?.data.slice(4) ?? null;
});

// console.log(sectionHeroBlog.value, "sectionHeroBlog");
</script>
<template>
  <div class="min-h-[calc(100vh-90px)] w-full pb-10">
    <ContainerPage>
      <!-- hero artikel -->
      <div
        class="grid grid-cols-1 lg:grid-cols-3 mt-14 lg:gap-5"
        v-if="heroBlog"
      >
        <div class="col-span-2 flex flex-col mb-5 lg:mb-0">
          <div
            class="w-full h-[450px] relative overflow-hidden bg-white rounded-lg cursor-pointer group"
          >
            <!-- Gambar (dibungkus div untuk efek zoom) -->
            <div class="w-full h-full overflow-hidden">
              <NuxtImg
                :src="useImageUrl(heroBlog.image)"
                class="object-cover w-full h-full transform transition-transform duration-500 ease-in-out group-hover:scale-150"
              />
            </div>

            <!-- Overlay Text -->
            <NuxtLink :to="`/blog/${heroBlog.slug}`">
              <div
                class="absolute bottom-1 left-0 flex flex-col gap-2 w-full px-4 py-2"
              >
                <NuxtLink
                  :to="`/blog/category/${heroBlog.slug}`"
                  class="text-sm font-semibold capitalize trasnition-all duration-300 ease-in-out text-slate-800 hover:text-white hover:bg-green-500 bg-primary px-3 py-1 rounded-full w-fit"
                  >{{ heroBlog.category.name }}</NuxtLink
                >
                <NuxtLink
                  :to="`/blog/${heroBlog.slug}`"
                  class="text-2xl font-bold text-slate-600 dark:text-slate-500 hover:text-primary transtition-all duration-300 ease-in-out"
                >
                  {{ heroBlog.title }}
                </NuxtLink>
                <p class="text-sm text-gray-200">
                  {{ heroBlog.excerpt }}
                </p>
              </div>
            </NuxtLink>
          </div>
        </div>

        <!-- section artikel -->
        <div class="col-span-1 flex flex-col w-full gap-4">
          <SectionHero
            v-for="sectionHeroBlog in sectionHeroBlog"
            :section-hero-blog="sectionHeroBlog"
            :key="sectionHeroBlog.id"
          />
        </div>
      </div>

      <!-- card artikel -->
      <div class="w-full grid grid-cols-1 lg:grid-cols-4 gap-5 mt-9">
        <CardBlog v-for="blog in blogs" :key="blog.id" :blog="blog" />
      </div>
    </ContainerPage>
  </div>
</template>

<style lang="scss" scoped></style>
