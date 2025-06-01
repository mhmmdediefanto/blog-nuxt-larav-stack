<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
import { getBlogBySlug } from "~/service/blog.service";

definePageMeta({
  layout: "default",
});

const route = useRoute();
const slug = route.params.slug;

const {
  data: blog,
  pending,
  error,
} = await useAsyncData(`blog-${slug}`, () => {
  return getBlogBySlug(slug);
});

console.log(blog.value, "blog");
</script>
<template>
  <ContainerPage> </ContainerPage>
</template>

<style lang="scss" scoped></style>
