import { useAxios } from "~/utils/useAxios";

export async function getBlogs() {
  const axios = useAxios();
  const response = await axios.get("/api/blogs");
  // console.log(response);

  return response.data;
}

export async function getBlogBySlug(slug) {
  const aixios = useAxios();
  const response = await aixios.get(`/api/blogs/detail/${slug}`);
  return response.data;
}
