<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
import { getBlogBySlug } from "~/service/blog.service";

definePageMeta({
  layout: "default",
});
const route = useRoute();

const slug = route.params.slug;
const baseUrl = useRuntimeConfig().public.siteUrl;

const {
  data: blog,
  pending,
  error,
} = await useAsyncData(`blog-${slug}`, () => {
  return getBlogBySlug(slug);
});

const data = computed(() => blog.value.data ?? null);

useSeoMeta({
  title: data.value.title,
  ogTitle: data.value.title,
  description: data.value.excerpt,
  ogDescription: data.value.excerpt,
  ogImage: useImageUrl(data.value.image),
  ogUrl: `${baseUrl}${route.fullPath}`,
  ogType: "article", // jenis konten: article, website, product, dsb
  twitterCard: "summary_large_image",
  twitterTitle: data.value.title,
  twitterDescription: data.value.excerpt,
  twitterImage: useImageUrl(data.value.image),
});
</script>
<template>
  <ContainerPage>
    <div class="w-full flex justify-center items-center flex-col pt-10">
      <h1
        class="text-3xl lg:text-2xl font-bold dark:text-primary text-slate-900"
      >
        {{ data.title }}
      </h1>
      <div class="lg:w-2/3 w-full py-10 flex flex-col justify-center ">
        <div class="flex gap-5 flex-col border-b border-primary  pb-5 mb-5">
          <div class="w-full">
            <NuxtImg :src="useImageUrl(data.image)" class="w-full" />
          </div>
          <div class="flex flex-col gap-2">
            <h1
              class="text-xl lg:text-2xl font-bold dark:text-primary text-slate-900"
            >
              {{ data.title }}
            </h1>
            <div class="flex flex-wrap gap-3">
              <p class="flex items-center gap-1 text-slate-600 text-sm">
                <UIcon name="mingcute:book-fill" class="text-primary w-4 h-4" />
                {{ data.category?.name }}
              </p>
              <p class="flex items-center gap-1 text-slate-600 text-sm">
                <UIcon
                  name="mingcute:user-3-fill"
                  class="text-primary w-4 h-4"
                />
                {{ data.user?.name }}
              </p>
              <p class="flex items-center gap-1 text-slate-600 text-sm">
                <UIcon
                  name="mingcute:calendar-fill"
                  class="text-primary w-4 h-4"
                />
                {{ useFormatDate(data.created_at) }}
              </p>
            </div>
          </div>
        </div>
        <div
          class="prose dark:prose-invert max-w-none overflow-hidden"
          v-html="data.content"
        ></div>
      </div>
    </div>
  </ContainerPage>
</template>

<style lang="scss" scoped></style>
