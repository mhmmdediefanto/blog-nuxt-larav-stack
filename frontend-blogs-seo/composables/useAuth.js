import * as AuthService from "~/service/auth.service";

export const useAuth = () => {
  const loading = ref(false);
  const error = ref(null);
  const user = ref(null);

  const register = async (data) => {
    try {
      loading.value = true;
      const response = await AuthService.register(data);

      return response;
    } catch (error) {
      console.log(error);
    } finally {
      loading.value = false;
    }
  };

  return {
    loading,
    error,
    user,
    register,
  };
};
