import { useAxios } from "~/utils/useAxios";

export const register = async (data) => {
  const api = useAxios();
  const csrf = await api.get("/sanctum/csrf-cookie");
  const response = await api.post("/api/auth/register", data);
  return response.data;
};

export const login = async (data) => {
  const api = useAxios();
  const csrf = await api.get("/sanctum/csrf-cookie");
  const response = await api.post("/api/auth/login", data);

  return response;
};

export const getUser = async () => {
  const api = useAxios();

  const response = await api.get("/api/user");

  // console.log("Auth Service: User data fetched", response.data);

  return response.data;
};

export const logout = async () => {
  const api = useAxios();
  const response = await api.post("/api/auth/logout");
  return response;
};
