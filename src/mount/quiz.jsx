import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import QuizPage from "../pages/QuizPage";

createRoot(document.getElementById("quiz-root")).render(
  <StrictMode>
    <QuizPage />
  </StrictMode>
);
