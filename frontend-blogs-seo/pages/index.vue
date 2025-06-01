<template>
  <div class="w-full min-h-[calc(100vh-90px)] flex-1 flex items-center">
    <ContainerPage>
      <h1 class="text-center mt-4">
        <span
          v-for="(item, i) in leadingsText"
          :key="i"
          :style="`--content: '${item.text}'; --start-color: ${
            item.startColor
          }; --end-color: ${item.endColor}; --animation-name: anim-fg-${i + 1}`"
          class="animated-text-bg drop-shadow-xl text-6xl sm:text-8xl md:text-8xl lg:text-8xl 2xl:text-8xl block font-black uppercase"
        >
          <span class="animated-text-fg">{{ item.text }}</span>
        </span>
      </h1>
      <p class="text-center mt-4 text-sm text-slate-400">
        Portal News Blog ini hadir untuk menemani harimu dengan berita aktual,
        konten informatif, dan wawasan dari berbagai bidang.
      </p>
      <div class="flex justify-center items-center gap-3 mt-4">
        <UButton class="flex items-center cursor-pointer bg-primary ">
          <NuxtLink :to="`/blog`" class="flex items-center">Mulai Membaca
          <UIcon name="mingcute:book-fill"  /></NuxtLink>
        </UButton>
        <UButton class="cursor-pointer flex items-center">
         <NuxtLink :to="`/auth/register`">
           Daftarkan Diri Anda <UIcon name="i-heroicons-arrow-right" />
         </NuxtLink>
        </UButton>
      </div>
    </ContainerPage>
  </div>
</template>

<script setup>
import ContainerPage from "~/components/ContainerPage.vue";
const leadingsText = computed(() => [
  {
    text: "Selamat Datang",
    startColor: "#007CF0",
    endColor: "#00DFD8",
    delay: 0,
  },
  {
    text: "Kembali di Webiste",
    startColor: "#7928CA",
    endColor: "#FF0080",
    delay: 2,
  },
  {
    text: "Portal News Blog",
    startColor: "#FF4D4D",
    endColor: "#F9CB28",
    delay: 4,
  },
]);
</script>

<style lang="scss">
:root {
  --padding: 0.05em;
}

@keyframes anim-fg-1 {
  0%,
  16.667%,
  100% {
    opacity: 1;
  }
  33.333%,
  83.333% {
    opacity: 0;
  }
}
@keyframes anim-fg-2 {
  0%,
  16.667%,
  66.667%,
  100% {
    opacity: 0;
  }
  33.333%,
  50% {
    opacity: 1;
  }
}
@keyframes anim-fg-3 {
  0%,
  50%,
  100% {
    opacity: 0;
  }
  66.667%,
  83.333% {
    opacity: 1;
  }
}
.animated-text-bg {
  position: relative;
  display: block;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  content: var(--content);
  display: block;
  width: 100%;
  color: theme("colors.slate.800");
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 0;
  padding-left: var(--padding);
  padding-right: var(--padding);
  &:before {
    content: var(--content);
    position: absolute;
    display: block;
    width: 100%;
    color: theme("colors.slate.800");
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 0;
    padding-left: var(--padding);
    padding-right: var(--padding);
  }
}
.animated-text-fg {
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  padding-left: var(--padding);
  padding-right: var(--padding);
  background-image: linear-gradient(
    90deg,
    var(--start-color),
    var(--end-color)
  );
  position: relative;
  opacity: 0;
  z-index: 1;
  animation: var(--animation-name) 8s infinite;
}
html.dark {
  .animated-text-bg {
    color: theme("colors.gray.100");
    &:before {
      color: theme("colors.gray.100");
    }
  }
}
</style>
