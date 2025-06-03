import { defineStore } from "pinia";
import * as AuthService from "~/service/auth.service";

export const useAuthStore = defineStore("auth", () => {
  const user = ref(null);
  const loading = ref(false);
  const error = ref("");

  const login = async (data) => {
    loading.value = true;
    error.value = "";
    try {
      const res = await AuthService.login(data);
      user.value = res.user;

      return res;
    } catch (err) {
      if (err.response?.status === 401) {
        error.value = "Email atau password salah";
      } else {
        error.value = "Terjadi kesalahan saat login";
      }

      return null;
    } finally {
      loading.value = false;
    }
  };

  const register = async (data) => {
    loading.value = true;
    error.value = "";
    try {
      const res = await AuthService.register(data);
      return res;
    } catch (err) {
      if (err.response?.status === 422) {
        const errors = err.response.data.errors;
        // Ambil satu pesan error (contoh: dari email)
        const firstError =
          Object.values(errors)?.[0]?.[0] || "Data tidak valid";
        error.value = firstError;
      } else if (err.response?.status === 500) {
        error.value = "Terjadi kesalahan pada server";
      } else {
        error.value = "Terjadi kesalahan saat registrasi";
      }
      return null;
    } finally {
      loading.value = false;
    }
  };

  const logout = async () => {
    loading.value = true;
    error.value = "";
    try {
      await AuthService.logout();
      user.value = null; // Clear user data on logout
    } catch (err) {
      error.value = "Terjadi kesalahan saat logout";
    } finally {
      loading.value = false;
    }
  };

  return {
    logout,
    user,
    loading,
    error,
    login,
    register,
  };
});
