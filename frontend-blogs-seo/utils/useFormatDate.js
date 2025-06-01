export default function useFormatDate(date) {
  return new Date(date).toLocaleString("id-ID", {
    month: "long",
    day: "numeric",
    year: "numeric",
  });
}
