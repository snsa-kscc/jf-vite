import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import StoresPage from "../pages/StoresPage";

createRoot(document.getElementById("stores-root")).render(
  <StrictMode>
    <StoresPage />
  </StrictMode>
);
