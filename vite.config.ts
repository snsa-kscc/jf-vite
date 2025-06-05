import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import tailwindcss from "@tailwindcss/vite";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// https://vite.dev/config/
export default defineConfig({
  plugins: [react(), tailwindcss()],
  build: {
    rollupOptions: {
      input: {
        index: path.resolve(__dirname, "index.html"),
        stores: path.resolve(__dirname, "stores.html"),
        quiz: path.resolve(__dirname, "quiz.html"),
      },
      output: {
        // Prevent hashing in output filenames
        entryFileNames: "assets/[name].js",
        chunkFileNames: "assets/[name].js",
        assetFileNames: "assets/[name].[ext]",
      },
      // This is the key to prevent code splitting
      preserveEntrySignatures: false,
    },
    outDir: "dist", // Use a single CSS file
    cssCodeSplit: false,
    // Minify the output
    minify: true,
  },
});
