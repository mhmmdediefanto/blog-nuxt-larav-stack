<template>
  <div class="w-full sticky top-0 z-50 backdrop-blur bg-white/60 dark:bg-slate-900/50 border-b border-gray-200 dark:border-gray-700">
    <ContainerPage>
      <div class="w-full flex justify-between dark:bg-slate-900/50 items-center h-[60px] backdrop-blur">
        <div class="flex items-center gap-3">
          <NuxtImg src="/logo/NuxtJS.svg" width="50" />
          <span class="dark:text-slate-200 font-bold text-lg">Nuxt 3</span>
        </div>
        <nav class="">
          <ul class="flex items-center gap-3">
            <li
              v-for="item in navigation"
              :key="item.name"
              class="text-sm font-semibold leading-6 text-gray-900"
            >
              <NuxtLink
                :to="item.to"
                :class="[
                  item.current
                    ? 'dark:text-green-600'
                    : 'text-gray-400 dark:hover:text-slate-50 hover:text-slate-900',
                  'px-3 py-2 rounded-md cursor-pointer font-semibold',
                ]"
                :aria-current="item.current ? 'page' : undefined"
                >{{ item.name }}</NuxtLink
              >
            </li>
          </ul>
        </nav>
        <div class="">
          <ThemeToggle />
        </div>
      </div>
    </ContainerPage>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useRouter, useRoute } from "vue-router";

import ContainerPage from "../ContainerPage.vue";
import ThemeToggle from "../ThemeToggle.vue";

const route = useRoute();

const navigation = computed(() => [
  { name: "Home", to: "/", current: route.path === "/" },
  { name: "About", to: "/about", current: route.path === "/about" },
  { name: "Blog", to: "/blog", current: route.path === "/blog" },
]);
</script>

<style lang="scss"></style>
