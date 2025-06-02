import { useAxios } from "~/utils/useAxios";

export const register = async (data) => {
  const api = useAxios();
  const csrf = await api.get("/sanctum/csrf-cookie");
  const response = await api.post("/api/auth/register", data);
  return response.data;
};
