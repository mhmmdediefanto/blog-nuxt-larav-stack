export const useAxios = () => {
  const { $axios } = useNuxtApp();
  return $axios;
};
