import { getBlogs } from "~/service/blog.service";

export  const useBlog = () => {
  const blogs = ref([]);
  const loading = ref(false);
  const error = ref(null);

  const fetchBlogs = async () => {
    try {
      const res = await getBlogs();
      
      blogs.value = res.blog;
    } catch (error) {
      console.log(error);
    }
  };

  onMounted(() => {
    fetchBlogs();
  });

  
  return {
    blogs,
    loading,
    error,
  };
};
