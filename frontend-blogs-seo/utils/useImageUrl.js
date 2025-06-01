export const useImageUrl = (path) => {
  const config = useRuntimeConfig();
  const baseUrl = config.public.apiBaseUrlImage || "http://localhost:8000"; // fallback

  if (!path) return "";

  // Pastikan path tidak double slash
  return `${baseUrl}/${path.replace(/^\/+/, "")}`;
};
